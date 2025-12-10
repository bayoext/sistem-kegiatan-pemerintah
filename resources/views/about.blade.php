<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tentang Kami - Sistem Manajemen Kegiatan Pemerintah</title>

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
                    <a href="{{ route('programs.public') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                        Program
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 font-medium text-primary-600">
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
                <a href="{{ route('programs.public') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                    Program
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md bg-primary-50 text-primary-600">
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
    <div class="bg-gradient-to-r from-primary-600 to-purple-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-6">Tentang Kami</h1>
            <p class="text-xl opacity-90">
                Sistem Manajemen Kegiatan Pemerintah yang transparan dan akuntabel
            </p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Visi & Misi</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-semibold text-primary-600 mb-4">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi platform terdepan dalam pengelolaan program dan kegiatan pemerintah yang transparan, 
                        efisien, dan akuntabel untuk meningkatkan kesejahteraan masyarakat.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold text-primary-600 mb-4">Misi</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li>• Menyediakan sistem manajemen yang terintegrasi</li>
                        <li>• Meningkatkan transparansi dan akuntabilitas</li>
                        <li>• Memfasilitasi partisipasi masyarakat</li>
                        <li>• Mengoptimalkan penggunaan sumber daya</li>
                    </ul>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Fitur Utama</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Program</h3>
                    <p class="text-gray-600 text-sm">Kelola program dan kegiatan dengan mudah dan terstruktur</p>
                </div>

                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan & Analitik</h3>
                    <p class="text-gray-600 text-sm">Dapatkan insight mendalam dengan laporan yang komprehensif</p>
                </div>

                <div class="text-center p-6 bg-gray-50 rounded-lg">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kolaborasi Tim</h3>
                    <p class="text-gray-600 text-sm">Bekerja sama dengan tim secara efektif dan terkoordinasi</p>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Komitmen Kami</h2>
            
            <div class="prose max-w-none text-gray-700">
                <p class="mb-4">
                    Kami berkomitmen untuk menyediakan platform yang tidak hanya memudahkan pengelolaan program pemerintah, 
                    tetapi juga meningkatkan transparansi dan akuntabilitas dalam setiap kegiatan yang dilaksanakan.
                </p>
                
                <p class="mb-4">
                    Dengan teknologi terdepan dan antarmuka yang user-friendly, kami memastikan bahwa setiap stakeholder 
                    dapat mengakses informasi yang mereka butuhkan dengan mudah dan cepat.
                </p>
                
                <p>
                    Transparansi bukan hanya slogan bagi kami, tetapi merupakan fondasi dalam setiap fitur dan layanan 
                    yang kami kembangkan untuk mendukung tata kelola pemerintahan yang baik.
                </p>
            </div>
        </div>
    </div>

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