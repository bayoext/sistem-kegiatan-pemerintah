@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center"
                     style="background-color: {{ $category->color }}20;">
                    <svg class="w-8 h-8" style="color: {{ $category->color }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $category->programs->count() }} program dalam kategori ini</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('categories.edit', $category) }}" class="btn-primary">
                    Edit Kategori
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            onclick="return confirm('Apakah Anda yakin?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Category Details -->
        <div class="card-primary">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Kategori</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                    <p class="text-gray-900 mt-1">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Warna</label>
                    <div class="flex items-center space-x-2 mt-1">
                        <div class="w-6 h-6 rounded" style="background-color: {{ $category->color }}"></div>
                        <span class="text-gray-900">{{ $category->color }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programs in this Category -->
        <div class="card-primary">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Program</h2>

            @if($category->programs->count() > 0)
                <div class="space-y-4">
                    @foreach($category->programs as $program)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $program->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($program->description, 100) }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $program->status_color }}">
                                        {{ ucfirst($program->status) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $program->start_date->format('M d') }} - {{ $program->end_date->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('programs.show', $program) }}"
                               class="text-primary-600 hover:text-primary-800 text-sm font-medium ml-4">
                                Lihat →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada program</h3>
                    <p class="text-gray-500 mb-4">Kategori ini belum memiliki program yang ditugaskan</p>
                    <a href="{{ route('programs.create') }}" class="btn-primary inline-flex items-center">
                        Buat Program
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
