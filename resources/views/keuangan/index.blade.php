<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6">
                <!-- Saldo Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-500/10 to-purple-600/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-2">
                                <div class="p-2 bg-gradient-to-br from-red-600 to-gray-900 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Saldo Kas</div>
                            <div class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Pemasukan Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-2">
                                <div class="p-2 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Pemasukan</div>
                            <div class="text-2xl sm:text-3xl font-bold text-emerald-600 mt-1">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Pengeluaran Card -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="p-6 relative">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-rose-500/10 to-rose-600/10 rounded-full -mr-16 -mt-16"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-2">
                                <div class="p-2 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Pengeluaran</div>
                            <div class="text-2xl sm:text-3xl font-bold text-rose-600 mt-1">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Daftar Transaksi</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Riwayat pemasukan dan pengeluaran</p>
                        </div>
                        <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                            <a href="{{ route('transaksi.laporan') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-gray-900 text-white text-sm font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Laporan
                            </a>
                            <a href="{{ route('transaksi.export') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Export
                            </a>
                            <a href="{{ route('transaksi.create') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-sm font-semibold rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Catat
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="grid grid-cols-1 gap-4 lg:hidden">
                        @forelse($transactions as $transaction)
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border-l-4 {{ $transaction->tipe == 'Pemasukan' ? 'border-emerald-500' : 'border-rose-500' }}">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $transaction->tipe == 'Pemasukan' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                                {{ $transaction->tipe }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $transaction->tanggal_transaksi instanceof \Carbon\Carbon ? $transaction->tanggal_transaksi->format('d M Y') : date('d M Y', strtotime($transaction->tanggal_transaksi)) }}
                                            </span>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $transaction->kategori->nama_kategori ?? '-' }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Illuminate\Support\Str::limit($transaction->keterangan, 50) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold {{ $transaction->tipe == 'Pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                                            Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    @if($transaction->bukti_foto)
                                        <a href="{{ asset('storage/' . $transaction->bukti_foto) }}" target="_blank" class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Bukti
                                        </a>
                                    @endif
                                    <a href="{{ route('transaksi.edit', $transaction->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-1.5 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-xs font-medium rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/30">
                                        Edit
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $transaction->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-1.5 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 text-xs font-medium rounded-lg hover:bg-rose-100 dark:hover:bg-rose-900/30">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada transaksi</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Mulai catat transaksi keuangan Anda</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Bukti</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $transaction->tanggal_transaksi instanceof \Carbon\Carbon ? $transaction->tanggal_transaksi->format('d M Y') : date('d M Y', strtotime($transaction->tanggal_transaksi)) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaction->tipe == 'Pemasukan' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $transaction->tipe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $transaction->kategori->nama_kategori ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        <div class="max-w-xs truncate" title="{{ $transaction->keterangan }}">
                                            {{ $transaction->keterangan ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($transaction->bukti_foto)
                                            <a href="{{ asset('storage/' . $transaction->bukti_foto) }}" target="_blank" class="text-red-600 hover:text-red-900 underline">Lihat</a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $transaction->tipe == 'Pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('transaksi.edit', $transaction->id) }}" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('transaksi.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada transaksi</h3>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Mulai catat transaksi keuangan Anda</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($transactions->hasPages())
                        <div class="mt-6">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
