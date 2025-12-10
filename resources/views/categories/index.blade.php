@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kategori</h1>
                <p class="text-gray-600 mt-2">Atur program Anda dengan kategori</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Kategori Baru
            </a>
        </div>

        <!-- Search -->
        <div class="card-primary">
            <div class="relative">
                <input type="text" placeholder="Cari kategori..."
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500 w-full">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
            <div class="card-primary hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center"
                             style="background-color: {{ $category->color }}20;">
                            <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $category->programs_count ?? 0 }} program</p>
                        </div>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-1 hover:bg-gray-100 rounded">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                            <a href="{{ route('categories.show', $category) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat</a>
                            <a href="{{ route('categories.edit', $category) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                        onclick="return confirm('Apakah Anda yakin?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $category->description ?? 'Tidak ada deskripsi' }}
                </p>

                <div class="pt-4 border-t border-gray-100">
                    <a href="{{ route('categories.show', $category) }}"
                       class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full card-primary text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kategori</h3>
                <p class="text-gray-500 mb-4">Mulai dengan membuat kategori pertama Anda</p>
                <a href="{{ route('categories.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Kategori
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
        <div class="card-primary">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
@endsection
