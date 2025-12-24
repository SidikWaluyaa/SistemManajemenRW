<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Kategori Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('kategori.store') }}">
                        @csrf

                        <!-- Nama Kategori -->
                        <div class="mb-4">
                            <x-input-label for="nama_kategori" :value="__('Nama Kategori')" />
                            <x-text-input id="nama_kategori" class="block mt-1 w-full" type="text" name="nama_kategori" :value="old('nama_kategori')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                        </div>

                        <!-- Jenis -->
                        <div class="mb-4">
                            <x-input-label for="jenis" :value="__('Jenis Transaksi')" />
                            <select id="jenis" name="jenis" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="Pemasukan" {{ old('jenis') == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="Pengeluaran" {{ old('jenis') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                        </div>

                        <!-- Nominal Default -->
                        <div class="mb-4">
                            <x-input-label for="nominal_default" :value="__('Nominal Default (Opsional)')" />
                            <x-text-input id="nominal_default" class="block mt-1 w-full" type="number" name="nominal_default" :value="old('nominal_default')" placeholder="Contoh: 20000" />
                            <p class="text-sm text-gray-500 mt-1">Jika diisi, nominal ini akan otomatis muncul saat mencatat transaksi kategori ini.</p>
                            <x-input-error :messages="$errors->get('nominal_default')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('kategori.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Batal') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
