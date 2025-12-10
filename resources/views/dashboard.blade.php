@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-2">Selamat datang kembali, {{ Auth::user()->name }}!</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('programs.create') }}" class="btn-primary flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Program Baru
                </a>
                <a href="{{ route('categories.create') }}" class="btn-secondary flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Kategori Baru
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Programs -->
            <div class="card-primary">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Program</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_programs'] }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-primary-100">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="card-primary">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Kategori</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_categories'] }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-secondary-100">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Berjalan Programs -->
            <div class="card-primary">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Berjalan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['Berjalan_programs'] }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Selesai Programs -->
            <div class="card-primary">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Selesai</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['Selesai_programs'] }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-gray-100">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Programs -->
            <div class="card-primary">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Program Terbaru</h2>
                    <a href="{{ route('programs.index') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">Lihat Semua</a>
                </div>

                <div class="space-y-4">
                    @forelse($recent_programs as $program)
                    <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-medium text-gray-900 truncate">
                                    <a href="{{ route('programs.show', $program) }}" class="hover:text-primary-600">
                                        {{ $program->title }}
                                    </a>
                                </h3>
                                <span class="px-2 py-1 text-xs rounded-full {{ $program->status_color }}">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $program->start_date->format('M d, Y') }} - {{ $program->end_date->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <p>Belum ada program. Buat program pertama Anda!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Status Distribution -->
            <div class="card-primary">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Status Program</h2>

                <div class="space-y-4">
                    @foreach(['Perencanaan', 'Berjalan', 'Selesai', 'Dibatalkan'] as $status)
                    @if(isset($programs_by_status[$status]))
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 capitalize">
                                @if($status == 'Perencanaan') Perencanaan
                                @elseif($status == 'Berjalan') Berjalan
                                @elseif($status == 'Selesai') Selesai
                                @else Dibatalkan @endif
                            </span>
                            <span class="text-sm font-medium text-gray-900">{{ $programs_by_status[$status] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full
                                @if($status == 'Perencanaan') bg-blue-500
                                @elseif($status == 'Berjalan') bg-green-500
                                @elseif($status == 'Selesai') bg-gray-500
                                @else bg-red-500 @endif"
                                style="width: {{ ($programs_by_status[$status] / $stats['total_programs']) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
