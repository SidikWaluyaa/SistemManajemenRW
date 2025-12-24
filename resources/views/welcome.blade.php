<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="custom-scrollbar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portal RW 10') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-black text-white overflow-x-hidden">
    <div class="relative min-h-screen flex flex-col">
        
        <!-- Sticky Glassmorphism Navbar -->
        <header class="glass fixed top-0 left-0 right-0 z-50 border-b border-red-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3 slide-in-left">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center font-bold text-white shadow-lg red-glow">
                            RW
                        </div>
                        <div>
                            <span class="text-xl font-bold gradient-text">RW 10</span>
                            <p class="text-xs text-gray-400 hidden sm:block">Sistem Informasi Manajemen</p>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex items-center space-x-2 sm:space-x-4 slide-in-right">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-semibold text-white hover:text-red-500 transition-colors duration-300">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Login Petugas
                                    </span>
                                </a>
                            @endauth
                        @endif
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section with Animated Gradient -->
        <main class="flex-grow">
            <section class="animated-gradient relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 left-10 w-72 h-72 bg-red-600/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-800/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                </div>
                
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 text-center">
                    <!-- Hero Content -->
                    <div class="fade-in">
                        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight text-white">
                            Sistem Informasi
                            <span class="block mt-2 gradient-text">Manajemen RW 10</span>
                        </h1>
                        
                        <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed px-4">
                            Platform terpadu untuk Sekretariat, Bendahara, dan Pengurus RT. Kelola data warga, keuangan, dan administrasi surat dengan akurat, aman, dan efisien.
                        </p>
                        
                        @guest
                            <div class="flex flex-col sm:flex-row justify-center gap-4 px-4">
                                <a href="{{ route('login') }}" class="btn-primary inline-block">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        Akses Dashboard
                                    </span>
                                </a>
                            </div>
                        @endguest
                    </div>
                    
                    <!-- Scroll Indicator -->
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="relative bg-gradient-to-b from-black via-gray-900 to-black py-16 sm:py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-12 sm:mb-16 fade-in">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">
                            Utilitas <span class="gradient-text">Manajemen</span>
                        </h2>
                        <p class="text-gray-400 text-base sm:text-lg max-w-2xl mx-auto">
                            Tools administrasi digital untuk operasional RW yang lebih efektif
                        </p>
                    </div>
                    
                    <!-- Features Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        
                        <!-- Feature Card 1 -->
                        <div class="card-hover group relative bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center mb-4 sm:mb-6 text-3xl sm:text-4xl shadow-lg red-glow group-hover:scale-110 transition-transform duration-300">
                                    �
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-red-500 transition-colors duration-300">
                                    Database Kependudukan
                                </h3>
                                <p class="text-gray-400 text-sm sm:text-base leading-relaxed">
                                    Sentralisasi data warga dan KK per RT. Monitoring mutasi, status domisili, dan update data demografi real-time.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Feature Card 2 -->
                        <div class="card-hover group relative bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center mb-4 sm:mb-6 text-3xl sm:text-4xl shadow-lg red-glow group-hover:scale-110 transition-transform duration-300">
                                    �
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-red-500 transition-colors duration-300">
                                    Manajemen Keuangan
                                </h3>
                                <p class="text-gray-400 text-sm sm:text-base leading-relaxed">
                                    Pencatatan kas masuk/keluar, iuran bulanan warga, dan pembuatan laporan keuangan otomatis yang akuntabel.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Feature Card 3 -->
                        <div class="card-hover group relative bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 overflow-hidden md:col-span-2 lg:col-span-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center mb-4 sm:mb-6 text-3xl sm:text-4xl shadow-lg red-glow group-hover:scale-110 transition-transform duration-300">
                                    �️
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-red-500 transition-colors duration-300">
                                    Digitalisasi Surat
                                </h3>
                                <p class="text-gray-400 text-sm sm:text-base leading-relaxed">
                                    Penerbitan surat pengantar, kearsipan dokumen RW, dan manajemen surat menyurat secara digital.
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="relative bg-black py-16 sm:py-20 border-y border-red-900/20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
                        
                        <!-- Stat 1 -->
                        <div class="text-center fade-in">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">RT 01-10</div>
                            <div class="text-gray-400 text-sm sm:text-base">Area Monitoring</div>
                        </div>
                        
                        <!-- Stat 2 -->
                        <div class="text-center fade-in" style="animation-delay: 0.1s;">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">Real-time</div>
                            <div class="text-gray-400 text-sm sm:text-base">Data Update</div>
                        </div>
                        
                        <!-- Stat 3 -->
                        <div class="text-center fade-in" style="animation-delay: 0.2s;">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">Arsip</div>
                            <div class="text-gray-400 text-sm sm:text-base">Surat & Dokumen</div>
                        </div>
                        
                        <!-- Stat 4 -->
                        <div class="text-center fade-in" style="animation-delay: 0.3s;">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">Akuntabel</div>
                            <div class="text-gray-400 text-sm sm:text-base">Laporan Keuangan</div>
                        </div>
                        
                    </div>
                </div>
            </section>
            
            <!-- System Workflow Section -->
            <section class="relative bg-gradient-to-b from-black via-gray-900 to-black py-16 sm:py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-12 sm:mb-16 fade-in">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">
                            Alur Kerja <span class="gradient-text">Sistem</span>
                        </h2>
                        <p class="text-gray-400 text-base sm:text-lg max-w-2xl mx-auto">
                            Proses manajemen data terintegrasi untuk efisiensi administrasi
                        </p>
                    </div>
                    
                    <!-- Timeline -->
                    <div class="relative">
                        <!-- Vertical Line (hidden on mobile) -->
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-red-600 via-red-700 to-red-800"></div>
                        
                        <div class="space-y-8 sm:space-y-12">
                            
                            <!-- Step 1 -->
                            <div class="relative fade-in">
                                <div class="md:flex md:items-center">
                                    <div class="md:w-1/2 md:pr-12 mb-4 md:mb-0 md:text-right">
                                        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-red-900/30">
                                            <div class="flex items-center md:justify-end mb-3">
                                                <span class="text-5xl font-bold gradient-text mr-3">01</span>
                                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-white mb-2">Input Data</h3>
                                            <p class="text-gray-400 text-sm">Ketua RT/Pengurus menginput data warga, mutasi, atau transaksi keuangan.</p>
                                        </div>
                                    </div>
                                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-red-600 rounded-full border-4 border-black"></div>
                                    <div class="md:w-1/2 md:pl-12"></div>
                                </div>
                            </div>
                            
                            <!-- Step 2 -->
                            <div class="relative fade-in" style="animation-delay: 0.1s;">
                                <div class="md:flex md:items-center">
                                    <div class="md:w-1/2 md:pr-12"></div>
                                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-red-600 rounded-full border-4 border-black"></div>
                                    <div class="md:w-1/2 md:pl-12">
                                        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-red-900/30">
                                            <div class="flex items-center mb-3">
                                                <span class="text-5xl font-bold gradient-text mr-3">02</span>
                                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-white mb-2">Verifikasi</h3>
                                            <p class="text-gray-400 text-sm">Sekretaris/Bendahara memverifikasi validitas data masukan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Step 3 -->
                            <div class="relative fade-in" style="animation-delay: 0.2s;">
                                <div class="md:flex md:items-center">
                                    <div class="md:w-1/2 md:pr-12 mb-4 md:mb-0 md:text-right">
                                        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-red-900/30">
                                            <div class="flex items-center md:justify-end mb-3">
                                                <span class="text-5xl font-bold gradient-text mr-3">03</span>
                                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-white mb-2">Pusat Data</h3>
                                            <p class="text-gray-400 text-sm">Data tersimpan aman di database pusat RW 10.</p>
                                        </div>
                                    </div>
                                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-red-600 rounded-full border-4 border-black"></div>
                                    <div class="md:w-1/2 md:pl-12"></div>
                                </div>
                            </div>
                            
                            <!-- Step 4 -->
                            <div class="relative fade-in" style="animation-delay: 0.3s;">
                                <div class="md:flex md:items-center">
                                    <div class="md:w-1/2 md:pr-12"></div>
                                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-red-600 rounded-full border-4 border-black"></div>
                                    <div class="md:w-1/2 md:pl-12">
                                        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-red-900/30">
                                            <div class="flex items-center mb-3">
                                                <span class="text-5xl font-bold gradient-text mr-3">04</span>
                                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold text-white mb-2">Laporan & Output</h3>
                                            <p class="text-gray-400 text-sm">Output berupa laporan keuangan, surat pengantar, dan statistik kependudukan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="relative bg-black py-16 sm:py-24 border-t border-red-900/20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-12 sm:mb-16 fade-in">
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">
                            Hubungi <span class="gradient-text">Kami</span>
                        </h2>
                        <p class="text-gray-400 text-base sm:text-lg max-w-2xl mx-auto">
                            Ada pertanyaan? Tim kami siap membantu Anda
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        
                        <!-- Contact Card 1 -->
                        <div class="card-hover bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Telepon</h3>
                            <p class="text-gray-400 text-sm mb-3">Hubungi kami langsung</p>
                            <a href="tel:+6281234567890" class="text-red-500 hover:text-red-400 font-semibold transition-colors">
                                +62 812-3456-7890
                            </a>
                        </div>
                        
                        <!-- Contact Card 2 -->
                        <div class="card-hover bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Email</h3>
                            <p class="text-gray-400 text-sm mb-3">Kirim pesan email</p>
                            <a href="mailto:admin@rw10.com" class="text-red-500 hover:text-red-400 font-semibold transition-colors">
                                admin@rw10.com
                            </a>
                        </div>
                        
                        <!-- Contact Card 3 -->
                        <div class="card-hover bg-gradient-to-br from-gray-900 to-black p-6 sm:p-8 rounded-2xl border border-red-900/30 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-lg red-glow">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Jam Pelayanan</h3>
                            <p class="text-gray-400 text-sm mb-3">Senin - Jumat</p>
                            <p class="text-red-500 font-semibold">
                                08:00 - 16:00 WIB
                            </p>
                        </div>
                        
                    </div>
                    
                    <!-- Office Address -->
                    <div class="mt-12 text-center fade-in">
                        <div class="inline-flex items-center gap-2 text-gray-400">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">Kantor RW 10, Jl. Contoh No. 123, Jakarta</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="relative bg-black border-t border-red-900/20 py-8 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex justify-center items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center font-bold text-white text-sm shadow-lg">
                            RW
                        </div>
                        <span class="text-lg font-bold gradient-text">RW 10</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-2">
                        &copy; {{ date('Y') }} Pengurus RW 10. All rights reserved.
                    </p>
                    <p class="text-gray-500 text-xs">
                        Developed with ❤️ for Warga RW 10
                    </p>
                </div>
            </div>
        </footer>
        
    </div>
</body>
</html>
