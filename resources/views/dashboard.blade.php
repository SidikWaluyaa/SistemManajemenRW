<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-red-600 to-gray-900 rounded-2xl shadow-xl p-6 sm:p-8 mb-6 sm:mb-8 text-white">
                <div class="flex flex-col sm:flex-row items-center justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h1 class="text-2xl sm:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-indigo-100 text-sm sm:text-base">Sistem Manajemen RW 10 - {{ Auth::user()->role === 'admin' ? 'Administrator' : 'RT ' . Auth::user()->rt }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 sm:px-6 py-3 sm:py-4">
                            <div class="text-xs sm:text-sm text-indigo-100">Tanggal Hari Ini</div>
                            <div class="text-lg sm:text-xl font-bold">{{ now()->translatedFormat('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Data Warga Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-blue-600/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Warga</span>
                            </div>
                            <div class="mb-2">
                                <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Warga</div>
                                <div class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $totalWarga }}</div>
                            </div>
                            <a href="{{ route('warga.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-semibold group-hover:translate-x-1 transition-transform">
                                Lihat Detail 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Data KK Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/10 to-gray-900/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-gradient-to-br from-red-600 to-gray-900 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Keluarga</span>
                            </div>
                            <div class="mb-2">
                                <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total KK</div>
                                <div class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $totalKK }}</div>
                            </div>
                            <a href="{{ route('kk.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 text-sm font-semibold group-hover:translate-x-1 transition-transform">
                                Lihat Detail 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Keuangan Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden sm:col-span-2 lg:col-span-1">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Kas</span>
                            </div>
                            <div class="mb-3">
                                <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Saldo Kas</div>
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                            </div>
                            <div class="flex items-center justify-between text-xs sm:text-sm mb-3">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Pemasukan:</span>
                                    <span class="font-semibold text-emerald-600 ml-1">Rp {{ number_format($pemasukan, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs sm:text-sm mb-3">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-rose-500 rounded-full mr-2"></div>
                                    <span class="text-gray-600 dark:text-gray-400">Pengeluaran:</span>
                                    <span class="font-semibold text-rose-600 ml-1">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('transaksi.index') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 text-sm font-semibold group-hover:translate-x-1 transition-transform">
                                Lihat Detail 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Statistik Keuangan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Grafik pemasukan dan pengeluaran tahun ini</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex space-x-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-emerald-500 rounded mr-2"></div>
                            <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Pemasukan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-rose-500 rounded mr-2"></div>
                            <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Pengeluaran</span>
                        </div>
                    </div>
                </div>
                <div class="relative h-64 sm:h-80">
                    <canvas id="financialChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('financialChart').getContext('2d');
        const financialChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: @json($incomeData),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($expenseData),
                        backgroundColor: 'rgba(244, 63, 94, 0.8)',
                        borderColor: 'rgba(244, 63, 94, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        borderRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
