<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catat Mutasi Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Mencatat mutasi akan mengubah status warga menjadi <strong>Pindah</strong> atau <strong>Meninggal</strong>. 
                                    Warga tersebut tidak akan muncul lagi di daftar warga aktif (Kartu Keluarga).
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('mutasi.store') }}">
                        @csrf

                        <!-- Warga -->
                        <div class="mb-4">
                            <x-input-label for="warga_id" :value="__('Pilih Warga')" />
                            <select id="warga_id" name="warga_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm select2">
                                <option value="">-- Pilih Warga Yang Dimutasi --</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->id }}" {{ old('warga_id') == $warga->id ? 'selected' : '' }}>
                                        {{ $warga->nama_lengkap }} (RT {{ $warga->rt }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('warga_id')" class="mt-2" />
                        </div>

                        <!-- Jenis Mutasi -->
                        <div class="mb-4">
                            <x-input-label for="jenis_mutasi" :value="__('Jenis Mutasi')" />
                            <select id="jenis_mutasi" name="jenis_mutasi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="Pindah" {{ old('jenis_mutasi') == 'Pindah' ? 'selected' : '' }}>Pindah Domisili (Keluar)</option>
                                <option value="Meninggal" {{ old('jenis_mutasi') == 'Meninggal' ? 'selected' : '' }}>Meninggal Dunia</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_mutasi')" class="mt-2" />
                        </div>

                        <!-- Tanggal Mutasi -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_mutasi" :value="__('Tanggal Mutasi')" />
                            <x-text-input id="tanggal_mutasi" class="block mt-1 w-full" type="date" name="tanggal_mutasi" :value="old('tanggal_mutasi', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('tanggal_mutasi')" class="mt-2" />
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan / Alasan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" placeholder="Contoh: Pindah ke luar kota karena pekerjaan...">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('mutasi.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Batal') }}</a>
                            <x-primary-button class="ml-4 bg-red-600 hover:bg-red-500">
                                {{ __('Simpan Data Mutasi') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
