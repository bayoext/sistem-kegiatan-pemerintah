@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Edit Kategori</h1>
            <p class="text-gray-600 mt-2">Perbarui detail kategori</p>
        </div>

        <div class="card-primary">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori *
                        </label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                               class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" rows="4"
                                  class="w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna *
                        </label>
                        <div class="flex items-center space-x-4">
                            <input type="color" name="color" value="{{ old('color', $category->color) }}"
                                   class="h-10 w-20 border-gray-300 rounded cursor-pointer">
                            <span class="text-sm text-gray-500">Pilih warna untuk kategori ini</span>
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="btn-primary">
                            Perbarui Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
