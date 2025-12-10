<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Kegiatan Pemerintah</title>
    @vite(['resources/css/app.css'])
    <style>
        .login-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left side - Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl gradient-bg mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Selamat Datang</h2>
                    <p class="text-gray-600 mt-2">Silakan login ke akun Anda</p>
                </div>

                <!-- Form -->
                <div class="card-glass rounded-2xl shadow-xl p-8 border border-gray-200">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="pl-10 block w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       placeholder="email@example.com"
                                       value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-500">
                                    Lupa password?
                                </a>
                                @endif
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="pl-10 block w-full border-gray-300 rounded-lg focus:border-primary-500 focus:ring-primary-500"
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <p class="text-center text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                Daftar sekarang
                            </a>
                        </p>
                        <p class="text-center text-sm text-gray-600 mt-2">
                            <a href="{{ route('home') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                ← Kembali ke beranda
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} Sistem Manajemen Kegiatan Pemerintah
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Image/Info -->
        <div class="hidden lg:block relative w-0 flex-1">
            <div class="absolute inset-0 login-bg">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative h-full flex items-center justify-center p-12">
                    <div class="max-w-xl text-white">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold mb-4">Sistem Manajemen Kegiatan Pemerintah</h3>
                            <p class="text-lg opacity-90">
                                Platform terpadu untuk mengelola, memantau, dan melaporkan seluruh program dan kegiatan pemerintah secara transparan dan akuntabel.
                            </p>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-lg font-semibold">Transparansi</h4>
                                    <p class="opacity-90">Seluruh kegiatan dapat dipantau secara real-time</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-lg font-semibold">Efisiensi</h4>
                                    <p class="opacity-90">Proses pengelolaan program lebih cepat dan terstruktur</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-lg font-semibold">Kolaborasi</h4>
                                    <p class="opacity-90">Kerja sama antar unit kerja lebih mudah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>