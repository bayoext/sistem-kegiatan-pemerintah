<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-users');
    }

    /**
     * Menampilkan daftar pengguna
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        
        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role, function ($query, $role) {
                return $query->where('role', $role);
            })
            ->latest()
            ->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah pengguna
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Menyimpan pengguna baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:superadmin,admin,user'],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'position' => $request->position,
            'department' => $request->department,
            'is_active' => true,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengguna
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form edit pengguna
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:superadmin,admin,user'],
            'phone' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'position' => $request->position,
            'department' => $request->department,
            'is_active' => $request->is_active ?? $user->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna
     */
    public function destroy(User $user)
    {
        // Tidak boleh menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Mengaktifkan/nonaktifkan pengguna
     */
    public function toggleStatus(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('users.index')
            ->with('success', "Pengguna berhasil $status.");
    }
}