<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Keuangan Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 hide-print">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('transaksi.laporan') }}" class="flex items-end space-x-4">
                        <div>
                            <x-input-label for="month" :value="__('Bulan')" />
                            <select id="month" name="month" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for($m=1; $m<=12; $m++)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <x-input-label for="year" :value="__('Tahun')" />
                            <select id="year" name="year" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for($y=date('Y'); $y>=date('Y')-5; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <x-primary-button type="submit">
                            {{ __('Filter') }}
                        </x-primary-button>
                        <button type="button" onclick="window.print()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-auto">
                            Cetak Laporan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Report Content (Printable) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg print-area">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold uppercase">Laporan Keuangan</h1>
                        <h2 class="text-lg">Periode: {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }}</h2>
                        <p class="text-sm text-gray-500">RW 10 Kelurahan Cigereleng, Kecamatan Regol, Kota Bandung</p>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mb-6">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Keterangan</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pemasukan</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($transaction->tanggal_transaksi)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $transaction->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $transaction->keterangan }}</td>
                                    <td class="px-4 py-2 text-sm text-right text-green-600">
                                        {{ $transaction->tipe == 'Pemasukan' ? 'Rp ' . number_format($transaction->jumlah, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-right text-red-600">
                                        {{ $transaction->tipe == 'Pengeluaran' ? 'Rp ' . number_format($transaction->jumlah, 0, ',', '.') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-sm text-gray-500">Tidak ada transaksi pada periode ini.</td>
                                </tr>
                            @endforelse
                            <!-- Summary Row -->
                            <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                                <td colspan="3" class="px-4 py-2 text-right">Total</td>
                                <td class="px-4 py-2 text-right text-green-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-right text-red-700">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-gray-200 dark:bg-gray-600 font-bold text-lg">
                                <td colspan="3" class="px-4 py-3 text-right">Saldo Akhir</td>
                                <td colspan="2" class="px-4 py-3 text-center {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-red-700' }}">
                                    Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-8 flex justify-end">
                        <div class="text-center">
                            <p class="mb-16">Bandung, {{ date('d F Y') }}</p>
                            <p class="font-bold underline">H. Ketua RW 10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .hide-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
