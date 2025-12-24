<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kartu Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Informasi KK</h3>
                        <a href="{{ route('kk.index') }}" class="text-gray-600 hover:text-gray-900">
                            &larr; Kembali
                        </a>
                    </div>

                    <!-- Info KK -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Kartu Keluarga</p>
                            <p class="font-bold text-lg text-gray-800">{{ $kk->nomor_kk }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kepala Keluarga</p>
                            <p class="font-bold text-lg text-gray-800">{{ $kk->kepala_keluarga }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium text-gray-800">{{ $kk->alamat }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">RT / RW</p>
                            <p class="font-medium text-gray-800">{{ $kk->rt }} / {{ $kk->rw }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Desa/Kelurahan</p>
                            <p class="font-medium text-gray-800">{{ $kk->desa_kelurahan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kecamatan</p>
                            <p class="font-medium text-gray-800">{{ $kk->kecamatan ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Daftar Anggota Keluarga -->
                    <h3 class="text-lg font-bold mb-4">Daftar Anggota Keluarga</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100 text-sm">
                                    <th class="py-2 px-4 border-b text-left">No</th>
                                    <th class="py-2 px-4 border-b text-left">NIK</th>
                                    <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                                    <th class="py-2 px-4 border-b text-left">JK</th>
                                    <th class="py-2 px-4 border-b text-left">Tempat, Tgl Lahir</th>
                                    <th class="py-2 px-4 border-b text-left">Agama</th>
                                    <th class="py-2 px-4 border-b text-left">Pekerjaan</th>
                                    <th class="py-2 px-4 border-b text-left">Status Hubungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kk->wargas as $index => $warga)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $warga->nik }}</td>
                                        <td class="py-2 px-4 border-b font-medium">{{ $warga->nama_lengkap }}</td>
                                        <td class="py-2 px-4 border-b">{{ $warga->jenis_kelamin }}</td>
                                        <td class="py-2 px-4 border-b">
                                            {{ $warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $warga->agama }}</td>
                                        <td class="py-2 px-4 border-b">{{ $warga->pekerjaan }}</td>
                                        <td class="py-2 px-4 border-b font-semibold text-gray-700">{{ $warga->status_hubungan_dalam_keluarga }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-4 px-4 border-b text-center text-gray-500">Belum ada data anggota keluarga.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
