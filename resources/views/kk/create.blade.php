<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Kartu Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('kk.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nomor KK -->
                            <div class="mb-4">
                                <x-input-label for="nomor_kk" :value="__('Nomor KK')" />
                                <x-text-input id="nomor_kk" class="block mt-1 w-full" type="number" name="nomor_kk" :value="old('nomor_kk')" required autofocus />
                                <x-input-error :messages="$errors->get('nomor_kk')" class="mt-2" />
                            </div>

                            <!-- Kepala Keluarga -->
                            <div class="mb-4">
                                <x-input-label for="kepala_keluarga" :value="__('Nama Kepala Keluarga')" />
                                <x-text-input id="kepala_keluarga" class="block mt-1 w-full" type="text" name="kepala_keluarga" :value="old('kepala_keluarga')" required />
                                <x-input-error :messages="$errors->get('kepala_keluarga')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" required>{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="rt" :value="__('RT')" />
                                @if(Auth::user()->role === 'rt')
                                    <x-text-input id="rt" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="rt" :value="Auth::user()->rt" readonly />
                                @else
                                    <select id="rt" name="rt" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        @for($i=2; $i<=5; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('rt') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                @endif
                            </div>
                            <div>
                                <x-input-label for="rw" :value="__('RW')" />
                                <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw')" />
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="desa_kelurahan" :value="__('Desa/Kelurahan')" />
                                <x-text-input id="desa_kelurahan" class="block mt-1 w-full" type="text" name="desa_kelurahan" :value="old('desa_kelurahan')" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                                <x-text-input id="kecamatan" class="block mt-1 w-full" type="text" name="kecamatan" :value="old('kecamatan')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <x-input-label for="kabupaten_kota" :value="__('Kabupaten/Kota')" />
                                <x-text-input id="kabupaten_kota" class="block mt-1 w-full" type="text" name="kabupaten_kota" :value="old('kabupaten_kota')" />
                            </div>
                            <div>
                                <x-input-label for="provinsi" :value="__('Provinsi')" />
                                <x-text-input id="provinsi" class="block mt-1 w-full" type="text" name="provinsi" :value="old('provinsi')" />
                            </div>
                             <div>
                                <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                                <x-text-input id="kode_pos" class="block mt-1 w-full" type="text" name="kode_pos" :value="old('kode_pos')" />
                            </div>
                        </div>


                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('kk.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ __('Batal') }}</a>
                            <x-primary-button>
                                {{ __('Simpan Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
