<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Manajemen Tagihan & Tunggakan') }}
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
            
            @if(session('error'))
                <div class="mb-6 bg-rose-50 dark:bg-rose-900/20 border-l-4 border-rose-500 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-rose-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-rose-700 dark:text-rose-300 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Filter & Generate Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('tagihan.index') }}" class="w-full lg:flex-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Bulan</label>
                                <select name="bulan" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun</label>
                                <select name="tahun" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                    @foreach(range(date('Y')-2, date('Y')+1) as $y)
                                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                                    <option value="">Semua Status</option>
                                    <option value="Belum Lunas" {{ $status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="Lunas" {{ $status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit" class="w-full px-5 py-2.5 bg-gray-700 hover:bg-gray-800 text-white text-sm font-medium rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Generate Button -->
                    <div class="w-full lg:w-auto">
                        <button type="button" onclick="document.getElementById('generateModal').classList.remove('hidden')" class="w-full inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-gray-900 text-white text-sm font-semibold rounded-xl hover:from-red-700 hover:to-black transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Generate Tagihan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Cards View -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">
                @forelse($tagihans as $tagihan)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border-l-4 {{ $tagihan->status === 'Lunas' ? 'border-emerald-500' : 'border-rose-500' }}">
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $tagihan->status === 'Lunas' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ $tagihan->status }}
                                    </span>
                                    <h4 class="text-base font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $tagihan->kartuKeluarga->nomor_kk }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $tagihan->kartuKeluarga->wargas->where('status_hubungan_dalam_keluarga', 'Kepala Keluarga')->first()->nama_lengkap ?? 'Tanpa KK' }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div class="py-3 border-t border-gray-100 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tagihan->kategoriTransaksi->nama_kategori }}</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 mt-1">{{ DateTime::createFromFormat('!m', $tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}</p>
                            </div>

                            @if($tagihan->status === 'Belum Lunas')
                                <form action="{{ route('tagihan.bayar', $tagihan->id) }}" method="POST" class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700" onsubmit="return confirm('Konfirmasi pembayaran?');">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 text-sm font-semibold rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/30 transition-all">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Bayar Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Tidak ada tagihan</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada tagihan untuk periode ini</p>
                        <button type="button" onclick="document.getElementById('generateModal').classList.remove('hidden')" class="mt-4 text-red-600 hover:text-red-900 font-medium">
                            Generate Tagihan Baru
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">KK / Kepala Keluarga</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($tagihans as $tagihan)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $tagihan->kartuKeluarga->nomor_kk }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $tagihan->kartuKeluarga->wargas->where('status_hubungan_dalam_keluarga', 'Kepala Keluarga')->first()->nama_lengkap ?? 'Tanpa KK' }}
                                            (RT {{ $tagihan->kartuKeluarga->rt }})
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $tagihan->kategoriTransaksi->nama_kategori }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ DateTime::createFromFormat('!m', $tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tagihan->status === 'Lunas' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $tagihan->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($tagihan->status === 'Belum Lunas')
                                            <form action="{{ route('tagihan.bayar', $tagihan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Konfirmasi pembayaran?');">
                                                @csrf
                                                <button type="submit" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300 font-semibold transition-colors">Bayar</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Lunas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Tidak ada tagihan</h3>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            Belum ada tagihan untuk periode ini. 
                                            <button type="button" onclick="document.getElementById('generateModal').classList.remove('hidden')" class="text-red-600 hover:underline">
                                                Generate Tagihan?
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Generate Modal -->
    <div id="generateModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('generateModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-6 pt-6 pb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100" id="modal-title">
                        Generate Tagihan Bulanan
                    </h3>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <p>Sistem akan membuat tagihan untuk SEMUA Kartu Keluarga aktif di RT Anda.</p>
                    </div>
                    <form action="{{ route('tagihan.generate') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori Iuran</label>
                            <select name="kategori_transaksi_id" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }} (Rp {{ number_format($cat->nominal_default, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bulan</label>
                                <select name="bulan" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun</label>
                                <input type="number" name="tahun" value="{{ date('Y') }}" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button type="button" onclick="document.getElementById('generateModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-600 to-gray-900 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
                                Proses Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
