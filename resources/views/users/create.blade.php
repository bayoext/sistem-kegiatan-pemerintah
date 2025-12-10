@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h4 class="text-xl font-semibold text-gray-900">Tambah User Baru</h4>
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                ← Kembali
            </a>
        </div>

        <div class="p-6">
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input id="name" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required autofocus>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input id="email" type="email" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                                <input id="password" type="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                                       name="password" 
                                       required>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                                <input id="password_confirmation" type="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent" 
                                       name="password_confirmation" 
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input id="phone" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('phone') border-red-500 @enderror" 
                                       name="phone" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                                <select id="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('role') border-red-500 @enderror" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                <input id="position" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('position') border-red-500 @enderror" 
                                       name="position" 
                                       value="{{ old('position') }}">
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                                <input id="department" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('department') border-red-500 @enderror" 
                                       name="department" 
                                       value="{{ old('department') }}">
                                @error('department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" 
                                       type="checkbox" 
                                       id="is_active" name="is_active" value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="ml-2 block text-sm text-gray-700" for="is_active">
                                    User Aktif
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition-colors">
                                 Simpan User
                            </button>
                            
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                                 Batal
                            </a>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection