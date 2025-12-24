<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Peminjaman Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('inventory.loans.store') }}">
                        @csrf

                        <!-- Warga Peminjam -->
                        <div class="mb-4">
                            <x-input-label for="warga_id" :value="__('Nama Peminjam (Warga)')" />
                            <select id="warga_id" name="warga_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($wargas as $w)
                                    <option value="{{ $w->id }}" {{ old('warga_id') == $w->id ? 'selected' : '' }}>
                                        {{ $w->nama_lengkap }} (RT {{ $w->rt }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('warga_id')" class="mt-2" />
                        </div>

                        <!-- Barang -->
                        <div class="mb-4">
                            <x-input-label for="asset_id" :value="__('Barang yang Dipinjam')" />
                            <select id="asset_id" name="asset_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                        {{ $asset->nama_barang }} (Tersedia: {{ $asset->jumlah }}) - Kondisi: {{ $asset->kondisi }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('asset_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Tanggal Pinjam -->
                            <div class="mb-4">
                                <x-input-label for="tanggal_pinjam" :value="__('Tanggal Pinjam')" />
                                <x-text-input id="tanggal_pinjam" class="block mt-1 w-full" type="date" name="tanggal_pinjam" :value="old('tanggal_pinjam', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
                            </div>

                            <!-- Rencana Kembali -->
                            <div class="mb-4">
                                <x-input-label for="tanggal_kembali" :value="__('Rencana Kembali')" />
                                <x-text-input id="tanggal_kembali" class="block mt-1 w-full" type="date" name="tanggal_kembali" :value="old('tanggal_kembali')" required />
                                <x-input-error :messages="$errors->get('tanggal_kembali')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keperluan / Keterangan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('inventory.loans.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Ajukan Peminjaman') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
