<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProgramController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $category = $request->input('category');

        $programs = Program::where('user_id', Auth::id())
            ->with('categories')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('categories.id', $category);
                });
            })
            ->latest()
            ->paginate(9)
            ->appends($request->query());

        $categories = Category::where('user_id', Auth::id())->get();

        return view('programs.index', compact('programs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('programs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Perencanaan,Berjalan,Selesai,Dibatalkan',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);

        $program = Program::create($validated);

        // Sync categories
        if ($request->has('categories')) {
            $program->categories()->sync($request->categories);
        }

        return redirect()->route('programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $this->authorize('view', $program);

        $program->load('categories');
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $this->authorize('update', $program);

        $categories = Category::where('user_id', Auth::id())->get();
        $selectedCategories = $program->categories->pluck('id')->toArray();

        return view('programs.edit', compact('program', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $this->authorize('update', $program);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Perencanaan,Berjalan,Selesai,Dibatalkan',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($program->thumbnail) {
                \Storage::disk('public')->delete($program->thumbnail);
            }

            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);

        $program->update($validated);

        // Sync categories
        $program->categories()->sync($request->categories ?? []);

        return redirect()->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $this->authorize('delete', $program);

        // Delete thumbnail if exists
        if ($program->thumbnail) {
            \Storage::disk('public')->delete($program->thumbnail);
        }

        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    public function publicIndex(Request $request)
{
    $search = $request->input('search');
    $status = $request->input('status');
    $category = $request->input('category');
    
    $programs = Program::public()
        ->with('categories', 'user')
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($category, function ($query, $category) {
            return $query->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category);
            });
        })
        ->latest()
        ->paginate(12);
    
    $categories = Category::whereHas('programs', function($query) {
        $query->where('is_public', true);
    })->get();
    
    $totalPrograms = Program::public()->count();
    
    return view('programs.public-index', compact('programs', 'categories', 'totalPrograms'));
}

/**
 * Menampilkan detail program publik
 */
public function publicShow(Program $program)
{
    if (!$program->is_public) {
        abort(404);
    }
    
    $program->incrementViews();
    $program->load('categories', 'user');
    
    // Ambil program terkait
    $relatedPrograms = Program::public()
        ->where('id', '!=', $program->id)
        ->whereHas('categories', function($query) use ($program) {
            $query->whereIn('categories.id', $program->categories->pluck('id'));
        })
        ->latest()
        ->take(3)
        ->get();
    
    return view('programs.public-show', compact('program', 'relatedPrograms'));
}

}
