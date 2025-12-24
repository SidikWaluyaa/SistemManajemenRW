<!-- Sidebar -->
<aside x-data="{ open: false }" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-red-600 via-red-700 to-gray-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col" :class="{ '-translate-x-full': !open, 'translate-x-0': open }">
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-20 border-b border-white/10 px-4 mb-2" data-aos="fade-down" data-aos-duration="1000">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-rw10-v2.jpg') }}?v={{ time() }}" alt="RW 10 Logo" class="w-16 h-16 object-contain bg-white/10 rounded-lg p-1">
            <div class="text-white">
                <div class="text-xl font-bold">RW 10</div>
                <div class="text-xs text-red-200">Kec. Regol</div>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="100">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('warga.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('warga.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="font-medium">Data Warga</span>
        </a>

        <a href="{{ route('kk.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('kk.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="250">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium">Kartu Keluarga</span>
        </a>

        <a href="{{ route('transaksi.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('transaksi.*') || request()->routeIs('kategori.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="300">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Keuangan</span>
        </a>

        <a href="{{ route('surat.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('surat.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="350">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="font-medium">Layanan Surat</span>
        </a>

        <a href="{{ route('tagihan.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('tagihan.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="400">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span class="font-medium">Tagihan & Tunggakan</span>
        </a>

        <div class="pt-4 mt-4 border-t border-white/10" data-aos="fade-up" data-aos-delay="450">
            <div class="px-4 mb-2">
                <span class="text-xs font-semibold text-red-200 uppercase tracking-wider">Bantuan Sosial</span>
            </div>
            
            <a href="{{ route('bansos.penerima.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('bansos.penerima.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="font-medium">Data Penyaluran</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('bansos.program.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('bansos.program.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="font-medium">Master Program</span>
            </a>
            @endif
        </div>

        <div class="pt-4 mt-4 border-t border-white/10" data-aos="fade-up" data-aos-delay="500">
            <div class="px-4 mb-2">
                <span class="text-xs font-semibold text-red-200 uppercase tracking-wider">Inventaris & Aset</span>
            </div>
            
            <a href="{{ route('inventory.loans.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('inventory.loans.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium">Data Peminjaman</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('inventory.assets.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('inventory.assets.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="font-medium">Data Aset</span>
            </a>
            @endif
        </div>

        <a href="{{ route('mutasi.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('mutasi.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}" data-aos="fade-right" data-aos-delay="550">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            <span class="font-medium">Mutasi Warga</span>
        </a>

        @if(auth()->user()->role === 'admin')
            <div class="pt-4 mt-4 border-t border-white/10" data-aos="fade-up" data-aos-delay="600">
                <div class="px-4 mb-2">
                    <span class="text-xs font-semibold text-red-200 uppercase tracking-wider">Admin</span>
                </div>
                <a href="{{ route('kategori.index') }}" class="flex items-center px-4 py-3 text-white rounded-lg transition-all duration-200 {{ request()->routeIs('kategori.*') ? 'bg-red-500/30 shadow-lg' : 'hover:bg-red-500/20' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="font-medium">Kategori Transaksi</span>
                </a>
            </div>
        @endif
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-red-500/30 bg-gray-900/50" data-aos="zoom-in-up" data-aos-delay="700">
        <div class="flex items-center space-x-3 px-4 py-3 bg-black/40 rounded-lg mb-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white font-bold shadow-lg shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-red-200">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'RT ' . auth()->user()->rt }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all duration-200 shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="font-medium">Keluar Aplikasi</span>
            </button>
        </form>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm" x-cloak></div>

<!-- Mobile Menu Button -->
<button @click="open = !open" class="fixed top-4 left-4 z-50 lg:hidden p-2 bg-red-600 text-white rounded-lg shadow-lg hover:bg-red-700 transition-colors">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
</button>
