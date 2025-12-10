<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_programs' => Program::where('user_id', $user->id)->count(),
            'total_categories' => Category::where('user_id', $user->id)->count(),
            'Berjalan_programs' => Program::where('user_id', $user->id)
                ->where('status', 'Berjalan')
                ->count(),
            'Selesai_programs' => Program::where('user_id', $user->id)
                ->where('status', 'Selesai')
                ->count(),
        ];

        $recent_programs = Program::where('user_id', $user->id)
            ->with('categories')
            ->latest()
            ->take(5)
            ->get();

        $programs_by_status = Program::where('user_id', $user->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('dashboard', compact('stats', 'recent_programs', 'programs_by_status'));
    }
}
