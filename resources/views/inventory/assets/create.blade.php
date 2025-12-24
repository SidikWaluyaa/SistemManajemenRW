<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Inventaris') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('inventory.assets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Kode Barang -->
                        <div class="mb-4">
                            <x-input-label for="kode_barang" :value="__('Kode Barang (Unik)')" />
                            <x-text-input id="kode_barang" class="block mt-1 w-full" type="text" name="kode_barang" :value="old('kode_barang', 'INV/'.date('Y').'/'.rand(100,999))" required autofocus placeholder="Contoh: INV/2024/001" />
                            <x-input-error :messages="$errors->get('kode_barang')" class="mt-2" />
                        </div>

                        <!-- Nama Barang -->
                        <div class="mb-4">
                            <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang')" required placeholder="Contoh: Tenda 4x6" />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Jumlah -->
                            <div class="mb-4">
                                <x-input-label for="jumlah" :value="__('Jumlah Unit')" />
                                <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" :value="old('jumlah', 1)" min="1" required />
                                <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                            </div>

                            <!-- Kondisi -->
                            <div class="mb-4">
                                <x-input-label for="kondisi" :value="__('Kondisi Barang')" />
                                <select id="kondisi" name="kondisi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                                <x-input-error :messages="$errors->get('kondisi')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Tanggal Perolehan -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_perolehan" :value="__('Tanggal Perolehan')" />
                            <x-text-input id="tanggal_perolehan" class="block mt-1 w-full" type="date" name="tanggal_perolehan" :value="old('tanggal_perolehan', date('Y-m-d'))" />
                            <x-input-error :messages="$errors->get('tanggal_perolehan')" class="mt-2" />
                        </div>

                        <!-- Sumber -->
                        <div class="mb-4">
                            <x-input-label for="sumber" :value="__('Sumber Perolehan')" />
                            <x-text-input id="sumber" class="block mt-1 w-full" type="text" name="sumber" :value="old('sumber')" placeholder="Contoh: Kas RW, Hibah Walikota" />
                            <x-input-error :messages="$errors->get('sumber')" class="mt-2" />
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan Tambahan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <!-- Foto -->
                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto Barang (Opsional)')" />
                            <input id="foto" name="foto" type="file" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*">
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('inventory.assets.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Barang') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
