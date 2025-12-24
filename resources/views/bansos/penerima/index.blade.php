<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Penerima Bansos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                        <h3 class="text-lg font-bold place-self-center">Monitoring Penyaluran</h3>
                        <div class="flex gap-2">
                             <a href="{{ route('bansos.penerima.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-center">
                                + Input Penerima
                            </a>
                        </div>
                    </div>
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Filter Form -->
                    <div class="bg-gray-50 p-4 rounded-md mb-6 border border-gray-200">
                        <form action="{{ route('bansos.penerima.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <x-input-label for="search" :value="__('Cari Kepala Keluarga / No KK')" />
                                <x-text-input id="search" name="search" type="text" class="mt-1 block w-full text-sm" :value="request('search')" placeholder="Nama / No KK..." />
                            </div>

                            <!-- Filter Program -->
                            <div>
                                <x-input-label for="program_id" :value="__('Program')" />
                                <select id="program_id" name="program_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                    <option value="">-- Semua Program --</option>
                                    @foreach($programs as $prog)
                                        <option value="{{ $prog->id }}" {{ request('program_id') == $prog->id ? 'selected' : '' }}>
                                            {{ $prog->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                    <option value="">-- Semua Status --</option>
                                    <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Disalurkan" {{ request('status') == 'Disalurkan' ? 'selected' : '' }}>Disalurkan</option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <!-- Button Filter -->
                            <div class="flex items-end">
                                <x-primary-button class="w-full justify-center h-10">
                                    {{ __('Filter Data') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                    <th class="py-2 px-4 border-b text-left">Program</th>
                                    <th class="py-2 px-4 border-b text-left">Penerima (KK)</th>
                                    <th class="py-2 px-4 border-b text-left">Status</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penerimas as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ date('d M Y', strtotime($item->tanggal_terima)) }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="font-medium text-gray-900">{{ $item->program->nama_program }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->program->jenis_bantuan }}</div>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="font-medium text-gray-900">{{ $item->kartuKeluarga->kepala_keluarga }}</div>
                                            <div class="text-xs text-gray-500">RT {{ $item->kartuKeluarga->rt }} / RW {{ $item->kartuKeluarga->rw }}</div>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            @php
                                                $colors = [
                                                    'Diajukan' => 'bg-yellow-100 text-yellow-800',
                                                    'Disetujui' => 'bg-blue-100 text-blue-800',
                                                    'Disalurkan' => 'bg-green-100 text-green-800',
                                                    'Ditolak' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$item->status] ?? 'bg-gray-100' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <a href="{{ route('bansos.penerima.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Update</a>
                                            <form action="{{ route('bansos.penerima.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data penerima ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-4 border-b text-center text-gray-500">Belum ada data penyaluran bansos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $penerimas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
