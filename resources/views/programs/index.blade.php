@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Program</h1>
                <p class="text-gray-600 mt-2">Kelola program Anda dan lacak kemajuan</p>
            </div>
            <a href="{{ route('programs.create') }}" class="btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Program Baru
            </a>
        </div>

        <!-- Filters -->
        <div class="card-primary">
            <form method="GET" action="{{ route('programs.index') }}" class="flex flex-col md:flex-row md:items-end justify-between space-y-4 md:space-y-0">
                <div class="flex flex-wrap gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="Perencanaan" {{ request('status') == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                            <option value="Berjalan" {{ request('status') == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" class="border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    @if(request()->hasAny(['status', 'category', 'search']))
                    <div class="flex items-end">
                        <a href="{{ route('programs.index') }}" 
                           class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Reset Filter
                        </a>
                    </div>
                    @endif
                </div>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500 w-full md:w-64">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <button type="submit" class="absolute right-2 top-1.5 p-1 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Results Info -->
        @if(request()->hasAny(['status', 'category', 'search']))
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="text-blue-800 font-medium">
                        Menampilkan {{ $programs->total() }} program
                        @if(request('search'))
                            untuk pencarian "{{ request('search') }}"
                        @endif
                        @if(request('status'))
                            dengan status "{{ ucfirst(request('status')) }}"
                        @endif
                        @if(request('category'))
                            @php $selectedCategory = $categories->find(request('category')) @endphp
                            @if($selectedCategory)
                                dalam kategori "{{ $selectedCategory->name }}"
                            @endif
                        @endif
                    </span>
                </div>
                <a href="{{ route('programs.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Hapus Filter
                </a>
            </div>
        </div>
        @endif

        <!-- Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($programs as $program)
            <div class="card-primary hover:shadow-xl transition-shadow duration-300">
                <!-- Program Header -->
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $program->title }}</h3>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $program->status_color }}">
                                {{ $program->status_label }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $program->formatted_budget }}
                            </span>
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
                            <a href="{{ route('programs.show', $program) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat</a>
                            <a href="{{ route('programs.edit', $program) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <form action="{{ route('programs.destroy', $program) }}" method="POST">
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

                <!-- Description -->
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ Str::limit($program->description, 100) }}
                </p>

                <!-- Categories -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($program->categories as $category)
                    <span class="px-2 py-1 text-xs rounded-full"
                          style="background-color: {{ $category->color }}20; color: {{ $category->color }}">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $program->start_date->format('M d') }} - {{ $program->end_date->format('M d') }}
                        </div>
                    </div>
                    <a href="{{ route('programs.show', $program) }}"
                       class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full card-primary text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada program</h3>
                <p class="text-gray-500 mb-4">Mulai dengan membuat program pertama Anda</p>
                <a href="{{ route('programs.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Program
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($programs->hasPages())
        <div class="card-primary">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
@endsection
