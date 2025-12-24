<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center space-x-4">
                            @if($warga->foto_warga)
                                <img src="{{ asset('storage/' . $warga->foto_warga) }}" alt="Pas Foto" class="h-24 w-24 rounded-full object-cover border-2 border-gray-300 shadow-sm">
                            @else
                                <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xl font-bold">{{ $warga->nama_lengkap }}</h3>
                                <p class="text-sm text-gray-500">NIK: {{ $warga->nik }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('warga.cetak', $warga->id) }}" target="_blank" class="text-gray-600 hover:text-gray-900 font-medium border border-gray-300 px-3 py-1 rounded-md">Cetak Biodata</a>
                            <a href="{{ route('warga.edit', $warga->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium px-3 py-1">Edit Data</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                            <p class="text-lg font-semibold">{{ $warga->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">NIK</p>
                            <p class="text-lg font-semibold">{{ $warga->nik }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tempat, Tanggal Lahir</p>
                            <p class="text-lg font-semibold">{{ $warga->tempat_lahir }}, {{ $warga->tanggal_lahir ? $warga->tanggal_lahir->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                            <p class="text-lg font-semibold">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status Warga</p>
                            <span class="px-2 py-1 text-sm rounded-full {{ $warga->status_warga == 'Tetap' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $warga->status_warga }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Agama</p>
                            <p class="text-lg font-semibold">{{ $warga->agama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pekerjaan</p>
                            <p class="text-lg font-semibold">{{ $warga->pekerjaan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status Perkawinan</p>
                            <p class="text-lg font-semibold">{{ $warga->status_perkawinan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Golongan Darah</p>
                            <p class="text-lg font-semibold">{{ $warga->golongan_darah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kewarganegaraan</p>
                            <p class="text-lg font-semibold">{{ $warga->kewarganegaraan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pendidikan Terakhir</p>
                            <p class="text-lg font-semibold">{{ $warga->pendidikan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status Hubungan</p>
                            <p class="text-lg font-semibold">{{ $warga->status_hubungan_dalam_keluarga ?? '-' }}</p>
                        </div>
                         <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama Ayah</p>
                            <p class="text-lg font-semibold">{{ $warga->nama_ayah ?? '-' }}</p>
                        </div>
                         <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nama Ibu</p>
                            <p class="text-lg font-semibold">{{ $warga->nama_ibu ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Alamat Lengkap</p>
                            <p class="text-lg font-semibold">{{ $warga->alamat }}</p>
                            <p class="text-base">
                                RT {{ $warga->rt ?? '-' }} / RW {{ $warga->rw ?? '-' }}, 
                                {{ $warga->desa_kelurahan ?? '-' }}, 
                                {{ $warga->kecamatan ?? '-' }}, 
                                {{ $warga->kabupaten_kota ?? '-' }}, 
                                {{ $warga->provinsi ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-6">
                        <h3 class="text-lg font-medium mb-4">Informasi Kartu Keluarga</h3>
                        @if($warga->kartuKeluarga)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Nomor KK</p>
                                    <p class="text-lg font-semibold">{{ $warga->kartuKeluarga->nomor_kk }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Kepala Keluarga</p>
                                    <p class="text-lg font-semibold">{{ $warga->kartuKeluarga->kepala_keluarga }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Alamat KK</p>
                                    <p class="text-lg font-semibold">
                                        {{ $warga->kartuKeluarga->alamat }}, 
                                        RT {{ $warga->kartuKeluarga->rt }} / RW {{ $warga->kartuKeluarga->rw }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('kk.edit', $warga->kartuKeluarga->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Lihat Detail KK &rarr;</a>
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum terdaftar dalam Kartu Keluarga manapun.</p>
                        @endif
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('warga.index') }}" class="text-gray-600 hover:text-gray-900 border border-gray-300 px-4 py-2 rounded-md">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
