<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Portal RW 10') }} - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="antialiased bg-black text-white overflow-hidden">
    <div class="relative min-h-screen flex items-center justify-center">
        
        <!-- Animated Background Effects -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-gray-900 via-black to-red-950"></div>
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-red-600/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-red-900/20 rounded-full blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <!-- Login Container -->
        <div class="relative z-10 w-full max-w-md px-6">
            
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center justify-center p-3 mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
                    <span class="text-3xl font-bold text-white tracking-widest">RW</span>
                </a>
                <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang</h2>
                <p class="text-gray-400 text-sm">Masuk ke Sistem Manajemen RW 10</p>
            </div>

            <!-- Login Card -->
            <div class="glass-card rounded-2xl p-8 shadow-2xl">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                                class="w-full pl-10 pr-4 py-3 bg-black/40 border border-gray-700 rounded-xl focus:ring-2 focus:ring-red-600 focus:border-transparent text-white placeholder-gray-500 transition-all duration-200"
                                placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pl-10 pr-4 py-3 bg-black/40 border border-gray-700 rounded-xl focus:ring-2 focus:ring-red-600 focus:border-transparent text-white placeholder-gray-500 transition-all duration-200"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded bg-black/40 border-gray-700 text-red-600 shadow-sm focus:ring-red-600 focus:ring-offset-gray-900" name="remember">
                            <span class="ms-2 text-gray-400 selection:bg-none">Ingat saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="text-red-500 hover:text-red-400 font-medium transition-colors" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-red-600 to-red-800 hover:from-red-700 hover:to-red-900 text-white font-bold rounded-xl shadow-lg transform hover:scale-[1.02] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                        Masuk Sekarang
                    </button>
                    
                    <div class="text-center mt-6">
                         <a href="/" class="text-sm text-gray-500 hover:text-white transition-colors">
                            &larr; Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8 text-xs text-gray-600">
                &copy; {{ date('Y') }} Sistem Manajemen RW 10. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
