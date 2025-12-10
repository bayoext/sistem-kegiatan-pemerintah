@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pengguna</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap pengguna sistem</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('users.edit', $user) }}" class="btn-secondary flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('users.index') }}" class="btn-primary flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- User Profile Card -->
        <div class="card-primary">
            <!-- Profile Header -->
            <div class="flex items-center space-x-6 mb-8">
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 rounded-full bg-primary-100 flex items-center justify-center">
                        <span class="text-primary-600 font-bold text-2xl">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->position ?? 'Tidak ada jabatan' }}</p>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="px-3 py-1 text-sm rounded-full 
                            @if($user->role === 'superadmin') bg-purple-100 text-purple-800
                            @elseif($user->role === 'admin') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $user->role_display }}
                        </span>
                        <span class="px-3 py-1 text-sm rounded-full 
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- User Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                        Informasi Personal
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <p class="text-gray-900">{{ $user->phone ?: '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Email</label>
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Work Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">
                        Informasi Pekerjaan
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <p class="text-gray-900">{{ $user->position ?: '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                            <p class="text-gray-900">{{ $user->department ?: '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role Sistem</label>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($user->role === 'superadmin') bg-purple-100 text-purple-800
                                @elseif($user->role === 'admin') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $user->role_display }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Akun</label>
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Aktivitas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Daftar</label>
                        <p class="text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Login</label>
                        <p class="text-gray-900">
                            {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : 'Belum pernah login' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Terakhir Diupdate</label>
                        <p class="text-gray-900">{{ $user->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                <div class="flex space-x-3">
                    <a href="{{ route('users.edit', $user) }}" class="btn-secondary flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Pengguna
                    </a>
                </div>
                
                @if($user->id !== auth()->id())
                <form method="POST" action="{{ route('users.destroy', $user) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')" 
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Pengguna
                    </button>
                </form>
                @else
                <p class="text-sm text-gray-500 italic">Tidak dapat menghapus akun sendiri</p>
                @endif
            </div>
        </div>
    </div>
@endsection