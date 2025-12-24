<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Tipe -->
                        <div class="mb-4">
                            <x-input-label for="tipe" :value="__('Tipe Transaksi')" />
                            <select id="tipe" name="tipe" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="Pemasukan" {{ old('tipe') == 'Pemasukan' ? 'selected' : '' }}>Pemasukan (Income)</option>
                                <option value="Pengeluaran" {{ old('tipe') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran (Expense)</option>
                            </select>
                            <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
                        </div>

                        <!-- Kategori (Optional) -->
                        <div class="mb-4">
                            <x-input-label for="kategori_transaksi_id" :value="__('Kategori (Opsional)')" />
                            <select id="kategori_transaksi_id" name="kategori_transaksi_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('kategori_transaksi_id') == $category->id ? 'selected' : '' }} data-nominal="{{ $category->nominal_default }}">
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kategori_transaksi_id')" class="mt-2" />
                        </div>

                        <!-- Warga (Optional, for Payer) -->
                        <div class="mb-4" id="warga-container" style="display: none;">
                            <x-input-label for="warga_id" :value="__('Warga (Pembayar)')" />
                            <select id="warga_id" name="warga_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- Pilih Warga --</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                                        {{ $warga->nama_lengkap }} (RT {{ $warga->rt }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('warga_id')" class="mt-2" />
                        </div>

                        <!-- Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="jumlah" :value="__('Jumlah (Rp)')" />
                                <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" :value="old('jumlah')" required min="0" />
                                <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_transaksi" :value="__('Tanggal Transaksi')" />
                                <x-text-input id="tanggal_transaksi" class="block mt-1 w-full" type="date" name="tanggal_transaksi" :value="old('tanggal_transaksi', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('tanggal_transaksi')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="bukti_foto" :value="__('Bukti Foto (Opsional)')" />
                            <input id="bukti_foto" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="bukti_foto">
                            <x-input-error :messages="$errors->get('bukti_foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('transaksi.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ __('Batal') }}</a>
                            <x-primary-button>
                                {{ __('Simpan Transaksi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipeSelect = document.getElementById('tipe');
            const wargaContainer = document.getElementById('warga-container');
            const kategoriSelect = document.getElementById('kategori_transaksi_id');
            const jumlahInput = document.getElementById('jumlah');

            function toggleWarga() {
                if (tipeSelect.value === 'Pemasukan') {
                    wargaContainer.style.display = 'block';
                } else {
                    wargaContainer.style.display = 'none';
                }
            }

            tipeSelect.addEventListener('change', toggleWarga);
            toggleWarga(); // Run on load

            kategoriSelect.addEventListener('change', function() {
                const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
                const nominal = selectedOption.getAttribute('data-nominal');

                if (nominal) {
                    jumlahInput.value = nominal;
                }
            });
        });
    </script>
</x-app-layout>
