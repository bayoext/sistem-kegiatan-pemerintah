<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $program->title }} - Sistem Manajemen Kegiatan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased" x-data="{ open: false }">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Sistem Kegiatan Pemerintah</h1>
                            <p class="text-xs text-gray-500">Pusat Informasi Program & Kegiatan</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                        Beranda
                    </a>
                    <a href="{{ route('programs.public') }}" class="text-gray-700 hover:text-primary-600 font-medium text-primary-600">
                        Program
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                        Tentang
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                        Kontak
                    </a>
                    
                    <!-- Auth Links -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-primary-600 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-700 hover:text-primary-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                    Beranda
                </a>
                <a href="{{ route('programs.public') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md bg-primary-50 text-primary-600">
                    Program
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                    Tentang
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                    Kontak
                </a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-primary-600 hover:text-primary-800 hover:bg-primary-50 rounded-md">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('programs.public') }}" class="ml-1 text-gray-500 hover:text-primary-600 md:ml-2">
                                Program
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-700 md:ml-2">{{ $program->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Program Image -->
                    @if($program->thumbnail)
                    <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                         alt="{{ $program->title }}" 
                         class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg mb-6">
                    @else
                    <div class="w-full h-64 md:h-96 bg-gradient-to-r from-primary-500 to-purple-600 rounded-lg shadow-lg mb-6 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    @endif

                    <!-- Program Title & Status -->
                    <div class="flex justify-between items-start mb-4">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $program->title }}</h1>
                        <span class="px-3 py-1 text-sm rounded-full {{ $program->status_color }}">
                            {{ ucfirst($program->status) }}
                        </span>
                    </div>

                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($program->categories as $category)
                        <span class="px-3 py-1 text-sm rounded-full" 
                              style="background-color: {{ $category->color }}20; color: {{ $category->color }}">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>

                    <!-- Program Description -->
                    <div class="prose max-w-none mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi Program</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($program->description)) !!}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Program Info Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Program</h3>
                        
                        <div class="space-y-4">
                            <!-- Start Date -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Mulai</p>
                                    <p class="font-medium">{{ $program->start_date->format('d M Y') }}</p>
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Selesai</p>
                                    <p class="font-medium">{{ $program->end_date->format('d M Y') }}</p>
                                </div>
                            </div>

                            <!-- Budget -->
                            @if($program->budget)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Anggaran</p>
                                    <p class="font-medium">{{ $program->formatted_budget }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Location -->
                            @if($program->location)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Lokasi</p>
                                    <p class="font-medium">{{ $program->location }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Views -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Dilihat</p>
                                    <p class="font-medium">{{ number_format($program->views) }} kali</p>
                                </div>
                            </div>

                            <!-- Created By -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Dibuat oleh</p>
                                    <p class="font-medium">{{ $program->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Share Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Program</h3>
                        <div class="flex space-x-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-center hover:bg-blue-700 transition-colors">
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($program->title) }}" 
                               target="_blank"
                               class="flex-1 bg-sky-500 text-white px-4 py-2 rounded-lg text-center hover:bg-sky-600 transition-colors">
                                Twitter
                            </a>
                            <button onclick="copyToClipboard('{{ request()->url() }}')"
                                    class="flex-1 bg-gray-600 text-white px-4 py-2 rounded-lg text-center hover:bg-gray-700 transition-colors">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Programs -->
    @if($relatedPrograms->count() > 0)
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Program Terkait</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedPrograms as $relatedProgram)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    @if($relatedProgram->thumbnail)
                    <img src="{{ asset('storage/' . $relatedProgram->thumbnail) }}" 
                         alt="{{ $relatedProgram->title }}" 
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-r from-primary-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg text-gray-900 line-clamp-1">{{ $relatedProgram->title }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full {{ $relatedProgram->status_color }}">
                                {{ ucfirst($relatedProgram->status) }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($relatedProgram->description, 120) }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                {{ $relatedProgram->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('programs.public.show', $relatedProgram) }}" 
                               class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link berhasil disalin!');
    });
}
</script>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Sistem Kegiatan Pemerintah</h3>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Platform terpadu untuk manajemen program dan kegiatan pemerintah yang transparan dan akuntabel.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('programs.public') }}" class="text-gray-400 hover:text-white transition-colors">Program</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            info@kegiatan-pemerintah.go.id
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            (021) 1234-5678
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Jakarta Pusat, DKI Jakarta
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Sistem Manajemen Kegiatan Pemerintah. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>