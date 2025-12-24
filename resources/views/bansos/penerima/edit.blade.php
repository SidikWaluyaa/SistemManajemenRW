<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Data Penerima Bansos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('bansos.penerima.update', $penerima->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Program Bansos -->
                        <div class="mb-4">
                            <x-input-label for="program_bansos_id" :value="__('Program Bansos')" />
                            <select id="program_bansos_id" name="program_bansos_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_bansos_id', $penerima->program_bansos_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->nama_program }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('program_bansos_id')" class="mt-2" />
                        </div>

                        <!-- Kartu Keluarga / Warga -->
                        <div class="mb-4">
                            <x-input-label for="kartu_keluarga_id" :value="__('Kepala Keluarga Penerima')" />
                            <select id="kartu_keluarga_id" name="kartu_keluarga_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($kks as $kk)
                                    <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id', $penerima->kartu_keluarga_id) == $kk->id ? 'selected' : '' }}>
                                        {{ $kk->kepala_keluarga }} - NO KK: {{ $kk->nomor_kk }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kartu_keluarga_id')" class="mt-2" />
                        </div>

                        <!-- Tanggal Terima -->
                        <div class="mb-4">
                            <x-input-label for="tanggal_terima" :value="__('Tanggal Penyaluran')" />
                            <x-text-input id="tanggal_terima" class="block mt-1 w-full" type="date" name="tanggal_terima" :value="old('tanggal_terima', $penerima->tanggal_terima)" required />
                            <x-input-error :messages="$errors->get('tanggal_terima')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Diajukan" {{ old('status', $penerima->status) == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="Disetujui" {{ old('status', $penerima->status) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Disalurkan" {{ old('status', $penerima->status) == 'Disalurkan' ? 'selected' : '' }}>Disalurkan (Sudah Diterima)</option>
                                <option value="Ditolak" {{ old('status', $penerima->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Catatan Tambahan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan', $penerima->keterangan) }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <!-- Bukti Foto -->
                        <div class="mb-4">
                            <x-input-label for="bukti_foto" :value="__('Update Bukti Foto (Kosongkan jika tidak ingin mengubah)')" />
                            @if($penerima->bukti_foto)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/'.$penerima->bukti_foto) }}" target="_blank" class="text-blue-600 underline text-sm">Lihat Foto Saat Ini</a>
                                </div>
                            @endif
                            <input id="bukti_foto" name="bukti_foto" type="file" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/*">
                            <x-input-error :messages="$errors->get('bukti_foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('bansos.penerima.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
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
