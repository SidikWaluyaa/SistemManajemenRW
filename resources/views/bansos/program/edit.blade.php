<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Program Bansos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('bansos.program.update', $program->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Program -->
                        <div class="mb-4">
                            <x-input-label for="nama_program" :value="__('Nama Program')" />
                            <x-text-input id="nama_program" class="block mt-1 w-full" type="text" name="nama_program" :value="old('nama_program', $program->nama_program)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_program')" class="mt-2" />
                        </div>

                        <!-- Jenis Bantuan -->
                        <div class="mb-4">
                            <x-input-label for="jenis_bantuan" :value="__('Jenis Bantuan')" />
                            <select id="jenis_bantuan" name="jenis_bantuan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Tunai" {{ $program->jenis_bantuan == 'Tunai' ? 'selected' : '' }}>Tunai (Uang)</option>
                                <option value="Non-Tunai" {{ $program->jenis_bantuan == 'Non-Tunai' ? 'selected' : '' }}>Non-Tunai (Barang/Sembako)</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_bantuan')" class="mt-2" />
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan', $program->keterangan) }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('bansos.program.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Perbarui') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
