<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventaris & Aset RW') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                        <h3 class="text-lg font-bold place-self-center">Daftar Aset RW</h3>
                        <div class="flex gap-2">
                             <a href="{{ route('inventory.assets.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-center">
                                + Tambah Barang
                            </a>
                        </div>
                    </div>
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b text-center">Foto</th>
                                    <th class="py-2 px-4 border-b text-left">Nama Barang</th>
                                    <th class="py-2 px-4 border-b text-left">Kode</th>
                                    <th class="py-2 px-4 border-b text-center">Jumlah</th>
                                    <th class="py-2 px-4 border-b text-center">Kondisi</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assets as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b text-center w-24">
                                            @if($item->foto)
                                                <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto Barang" class="h-12 w-12 object-cover rounded mx-auto">
                                            @else
                                                <div class="h-12 w-12 bg-gray-200 rounded mx-auto flex items-center justify-center text-xs text-gray-500">No Img</div>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b font-medium">{{ $item->nama_barang }}</td>
                                        <td class="py-2 px-4 border-b text-gray-600 text-sm">{{ $item->kode_barang }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $item->jumlah }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            @php
                                                $colors = [
                                                    'Baik' => 'bg-green-100 text-green-800',
                                                    'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                                                    'Rusak Berat' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$item->kondisi] ?? 'bg-gray-100' }}">
                                                {{ $item->kondisi }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <a href="{{ route('inventory.assets.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form action="{{ route('inventory.assets.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus aset ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b text-center text-gray-500">Belum ada data barang inventaris.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
