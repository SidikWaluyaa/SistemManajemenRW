<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Status Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('inventory.loans.update', $loan->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Warga Peminjam (Read Only/Select) -->
                        <div class="mb-4">
                            <x-input-label for="warga_id" :value="__('Nama Peminjam')" />
                            <select id="warga_id" name="warga_id" class="block mt-1 w-full border-gray-300 bg-gray-100 rounded-md shadow-sm pointer-events-none" readonly>
                                <option value="{{ $loan->warga_id }}" selected>
                                    {{ $loan->warga->nama_lengkap }} (RT {{ $loan->warga->rt }})
                                </option>
                            </select>
                            <input type="hidden" name="warga_id" value="{{ $loan->warga_id }}">
                        </div>

                        <!-- Barang (Read Only/Select) -->
                        <div class="mb-4">
                            <x-input-label for="asset_id" :value="__('Barang yang Dipinjam')" />
                            <select id="asset_id" name="asset_id" class="block mt-1 w-full border-gray-300 bg-gray-100 rounded-md shadow-sm pointer-events-none" readonly>
                                <option value="{{ $loan->asset_id }}" selected>
                                    {{ $loan->asset->nama_barang }}
                                </option>
                            </select>
                             <input type="hidden" name="asset_id" value="{{ $loan->asset_id }}">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Tanggal Pinjam -->
                            <div class="mb-4">
                                <x-input-label for="tanggal_pinjam" :value="__('Tanggal Pinjam')" />
                                <x-text-input id="tanggal_pinjam" class="block mt-1 w-full" type="date" name="tanggal_pinjam" :value="old('tanggal_pinjam', $loan->tanggal_pinjam)" required />
                                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
                            </div>

                            <!-- Rencana Kembali -->
                            <div class="mb-4">
                                <x-input-label for="tanggal_kembali" :value="__('Rencana Kembali')" />
                                <x-text-input id="tanggal_kembali" class="block mt-1 w-full" type="date" name="tanggal_kembali" :value="old('tanggal_kembali', $loan->tanggal_kembali)" required />
                                <x-input-error :messages="$errors->get('tanggal_kembali')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4 bg-yellow-50 p-4 rounded border border-yellow-200">
                            <x-input-label for="status" :value="__('Update Status Peminjaman')" class="text-lg font-bold text-yellow-800 mb-2" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm font-semibold">
                                <option value="Diajukan" {{ old('status', $loan->status) == 'Diajukan' ? 'selected' : '' }}>Diajukan (Belum diambil)</option>
                                <option value="Dipinjam" {{ old('status', $loan->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam (Sedang dibawa)</option>
                                <option value="Dikembalikan" {{ old('status', $loan->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan (Selesai)</option>
                                <option value="Ditolak" {{ old('status', $loan->status) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <p class="text-sm text-gray-600 mt-2">Ubah status menjadi <b>Dipinjam</b> saat barang diambil, dan <b>Dikembalikan</b> saat barang sudah kembali.</p>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Catatan Tambahan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan', $loan->keterangan) }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('inventory.loans.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Update Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
