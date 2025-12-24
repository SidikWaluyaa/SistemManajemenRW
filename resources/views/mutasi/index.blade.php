<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Data Mutasi Warga') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-emerald-700 dark:text-emerald-300 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 mb-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100">Riwayat Mutasi Warga</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Data warga yang pindah atau meninggal</p>
                    </div>
                    <a href="{{ route('mutasi.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-rose-600 to-rose-700 text-white text-sm font-semibold rounded-xl hover:from-rose-700 hover:to-rose-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Catat Mutasi Baru
                    </a>
                </div>
            </div>

            <!-- Mobile Cards View -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">
                @forelse($mutasis as $mutasi)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border-l-4 {{ $mutasi->jenis_mutasi === 'Pindah' ? 'border-amber-500' : 'border-gray-500' }}">
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $mutasi->jenis_mutasi === 'Pindah' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $mutasi->jenis_mutasi }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $mutasi->tanggal_mutasi->format('d M Y') }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-900 dark:text-gray-100">{{ $mutasi->warga->nama_lengkap }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">NIK: {{ $mutasi->warga->nik }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">RT {{ $mutasi->warga->rt }}</p>
                                </div>
                            </div>
                            
                            <div class="py-3 border-t border-gray-100 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Keterangan</p>
                                <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">{{ $mutasi->keterangan }}</p>
                            </div>

                            <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="POST" class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700" onsubmit="return confirm('Hapus data mutasi ini? Status warga akan dikembalikan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 text-sm font-semibold rounded-lg hover:bg-rose-100 dark:hover:bg-rose-900/30 transition-all">
                                    Batalkan / Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada mutasi</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada data mutasi warga yang tercatat</p>
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Warga</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Jenis Mutasi</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Keterangan</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($mutasis as $mutasi)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $mutasi->tanggal_mutasi->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $mutasi->warga->nama_lengkap }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">NIK: {{ $mutasi->warga->nik }} (RT {{ $mutasi->warga->rt }})</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mutasi->jenis_mutasi === 'Pindah' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $mutasi->jenis_mutasi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate" title="{{ $mutasi->keterangan }}">{{ $mutasi->keterangan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data mutasi ini? Status warga akan dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 transition-colors" title="Batalkan/Hapus">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada mutasi</h3>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada data mutasi warga yang tercatat</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($mutasis->hasPages())
                <div class="mt-6">
                    {{ $mutasis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
