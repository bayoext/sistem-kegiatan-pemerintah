@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $program->title }}</h1>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $program->status_color }}">
                            {{ ucfirst($program->status) }}
                        </span>
                        <span class="text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $program->start_date->format('M d, Y') }} - {{ $program->end_date->format('M d, Y') }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('programs.edit', $program) }}"
                       class="px-4 py-2 border border-primary-500 text-primary-600 rounded-lg hover:bg-primary-50 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('programs.destroy', $program) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 border border-red-500 text-red-600 rounded-lg hover:bg-red-50 transition-colors"
                                onclick="return confirm('Apakah Anda yakin?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="card-primary">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $program->description }}</p>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card-primary">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Kategori</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($program->categories as $category)
                        <a href="{{ route('categories.show', $category) }}"
                           class="px-4 py-2 rounded-lg flex items-center hover:shadow transition-shadow"
                           style="background-color: {{ $category->color }}20; color: {{ $category->color }};">
                            <div class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $category->color }}"></div>
                            {{ $category->name }}
                        </a>
                        @endforeach

                        @if($program->categories->isEmpty())
                            <p class="text-gray-500">Tidak ada kategori yang ditugaskan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Program Details -->
                <div class="card-primary">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Detail Program</h2>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="font-medium text-gray-900">{{ $program->location ?: 'Tidak ditentukan' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Anggaran</p>
                            <p class="font-medium text-gray-900">{{ $program->formatted_budget }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Durasi</p>
                            <p class="font-medium text-gray-900">
                                {{ $program->start_date->diffInDays($program->end_date) + 1 }} hari
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Dibuat</p>
                            <p class="font-medium text-gray-900">
                                {{ $program->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail -->
                @if($program->thumbnail)
                <div class="card-primary">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Thumbnail</h2>
                    <img src="{{ asset('storage/' . $program->thumbnail) }}"
                         alt="{{ $program->title }}"
                         class="w-full h-48 object-cover rounded-lg">
                </div>
                @endif

                <!-- Actions -->
                <div class="card-primary">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h2>
                    <div class="space-y-3">
                        <a href="{{ route('programs.edit', $program) }}"
                           class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span>Edit Program</span>
                        </a>

                        <form action="{{ route('programs.destroy', $program) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center w-full p-3 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition-colors"
                                    onclick="return confirm('Apakah Anda yakin?')">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Hapus Program</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection