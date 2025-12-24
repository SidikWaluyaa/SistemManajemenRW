<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Surat Pengantar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('surat.store') }}">
                        @csrf

                        <!-- Warga -->
                        <div class="mb-4">
                            <x-input-label for="warga_id" :value="__('Nama Warga')" />
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

                        <!-- Jenis Surat -->
                        <div class="mb-4">
                            <x-input-label for="jenis_surat" :value="__('Jenis Surat')" />
                            <select id="jenis_surat" name="jenis_surat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="Surat Pengantar KTP" {{ old('jenis_surat') == 'Surat Pengantar KTP' ? 'selected' : '' }}>Pengantar Pembuatan KTP</option>
                                <option value="Surat Pengantar KK" {{ old('jenis_surat') == 'Surat Pengantar KK' ? 'selected' : '' }}>Pengantar Pembuatan KK</option>
                                <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Keterangan Domisili</option>
                                <option value="Surat Pengantar SKCK" {{ old('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>Pengantar SKCK</option>
                                <option value="Surat Keterangan Kematian" {{ old('jenis_surat') == 'Surat Keterangan Kematian' ? 'selected' : '' }}>Keterangan Kematian</option>
                                <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Keterangan Tidak Mampu (SKTM)</option>
                                <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_surat')" class="mt-2" />
                        </div>

                        <!-- Keperluan -->
                        <div class="mb-4">
                            <x-input-label for="keperluan" :value="__('Keperluan / Keterangan')" />
                            <textarea id="keperluan" name="keperluan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" placeholder="Contoh: Mengurus perpanjangan KTP di Kecamatan...">{{ old('keperluan') }}</textarea>
                            <x-input-error :messages="$errors->get('keperluan')" class="mt-2" />
                        </div>

                        <!-- Tanggal Surat -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_surat" :value="__('Tanggal Surat')" />
                            <x-text-input id="tanggal_surat" class="block mt-1 w-full" type="date" name="tanggal_surat" :value="old('tanggal_surat', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('tanggal_surat')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('surat.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Batal') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Buat Surat') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
