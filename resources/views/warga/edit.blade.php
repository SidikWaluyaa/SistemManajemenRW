<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('warga.update', $warga->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6 border-b pb-2">
                             <h3 class="text-lg font-medium">Informasi Dasar</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="kartu_keluarga_id" :value="__('Kartu Keluarga (Opsional)')" />
                                <select id="kartu_keluarga_id" name="kartu_keluarga_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">-- Pilih KK --</option>
                                    @foreach($kks as $kk)
                                        <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id', $warga->kartu_keluarga_id) == $kk->id ? 'selected' : '' }}>{{ $kk->nomor_kk }} - {{ $kk->kepala_keluarga }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kartu_keluarga_id')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="nik" :value="__('NIK')" />
                                <x-text-input id="nik" class="block mt-1 w-full" type="number" name="nik" :value="old('nik', $warga->nik)" required />
                                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap', $warga->nama_lengkap)" required />
                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir', $warga->tempat_lahir)" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir', $warga->tanggal_lahir?->format('Y-m-d'))" />
                            </div>
                        </div>

                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="golongan_darah" :value="__('Gol. Darah')" />
                                <select id="golongan_darah" name="golongan_darah" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" {{ old('golongan_darah', $warga->golongan_darah) == '' ? 'selected' : '' }}>-</option>
                                    <option value="A" {{ old('golongan_darah', $warga->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $warga->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $warga->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $warga->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                            </div>
                             <div>
                                <x-input-label for="agama" :value="__('Agama')" />
                                <select id="agama" name="agama" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>
                        </div>

                         <div class="mb-6 border-b pb-2 mt-6">
                             <h3 class="text-lg font-medium">Alamat Lengkap</h3>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat Jalan')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('alamat', $warga->alamat) }}</textarea>
                        </div>

                         <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                             <div>
                                <x-input-label for="rt" :value="__('RT')" />
                                @if(Auth::user()->role === 'rt')
                                    <x-text-input id="rt" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="rt" :value="Auth::user()->rt" readonly />
                                @else
                                    <select id="rt" name="rt" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        @for($i=2; $i<=5; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('rt', $warga->rt) == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                @endif
                            </div>
                            <div>
                                <x-input-label for="rw" :value="__('RW')" />
                                <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw', $warga->rw)" />
                            </div>
                             <div>
                                <x-input-label for="desa_kelurahan" :value="__('Kel/Desa')" />
                                <x-text-input id="desa_kelurahan" class="block mt-1 w-full" type="text" name="desa_kelurahan" :value="old('desa_kelurahan', $warga->desa_kelurahan)" />
                            </div>
                            <div>
                                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                                <x-text-input id="kecamatan" class="block mt-1 w-full" type="text" name="kecamatan" :value="old('kecamatan', $warga->kecamatan)" />
                            </div>
                        </div>
                        
                         <div class="mb-6 border-b pb-2 mt-6">
                             <h3 class="text-lg font-medium">Status & Lainnya</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="status_perkawinan" :value="__('Status Perkawinan')" />
                                <select id="status_perkawinan" name="status_perkawinan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                                <x-text-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan', $warga->pekerjaan)" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                             <div>
                                <x-input-label for="kewarganegaraan" :value="__('Kewarganegaraan')" />
                                 <select id="kewarganegaraan" name="kewarganegaraan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="WNI" {{ old('kewarganegaraan', $warga->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                                    <option value="WNA" {{ old('kewarganegaraan', $warga->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                                </select>
                             </div>
                             <div>
                                <x-input-label for="status_warga" :value="__('Status Kependudukan')" />
                                <select id="status_warga" name="status_warga" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Tetap" {{ old('status_warga', $warga->status_warga) == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                                    <option value="Kontrak" {{ old('status_warga', $warga->status_warga) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                    <option value="Pindah" {{ old('status_warga', $warga->status_warga) == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                                    <option value="Meninggal" {{ old('status_warga', $warga->status_warga) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                            </div>
                         </div>
                         
                         <!-- Additional KK Info -->
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="status_hubungan_dalam_keluarga" :value="__('Status Hubungan Keluarga')" />
                                <select id="status_hubungan_dalam_keluarga" name="status_hubungan_dalam_keluarga" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Kepala Keluarga" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="Suami" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Suami' ? 'selected' : '' }}>Suami</option>
                                    <option value="Istri" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Menantu" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                                    <option value="Cucu" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                    <option value="Orang Tua" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Mertua" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                                    <option value="Famili Lain" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                                    <option value="Pembantu" {{ old('status_hubungan_dalam_keluarga', $warga->status_hubungan_dalam_keluarga) == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="pendidikan" :value="__('Pendidikan Terakhir')" />
                                <x-text-input id="pendidikan" class="block mt-1 w-full" type="text" name="pendidikan" :value="old('pendidikan', $warga->pendidikan)" />
                            </div>
                         </div>

                        <!-- Parents Info (Optional but in KK) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="nama_ayah" :value="__('Nama Ayah')" />
                                <x-text-input id="nama_ayah" class="block mt-1 w-full" type="text" name="nama_ayah" :value="old('nama_ayah', $warga->nama_ayah)" />
                            </div>
                             <div>
                                <x-input-label for="nama_ibu" :value="__('Nama Ibu')" />
                                <x-text-input id="nama_ibu" class="block mt-1 w-full" type="text" name="nama_ibu" :value="old('nama_ibu', $warga->nama_ibu)" />
                            </div>
                        </div>

                        <!-- Foto Warga -->
                        <div class="mb-4">
                            <x-input-label for="foto_warga" :value="__('Pas Foto (Opsional)')" />
                            @if($warga->foto_warga)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $warga->foto_warga) }}" alt="Pas Foto" class="h-32 w-auto rounded border">
                                </div>
                            @endif
                            <input id="foto_warga" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="foto_warga">
                            <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('foto_warga')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('warga.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">{{ __('Batal') }}</a>
                            <x-primary-button>
                                {{ __('Perbarui Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
