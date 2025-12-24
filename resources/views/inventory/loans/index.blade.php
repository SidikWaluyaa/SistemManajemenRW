<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                        <h3 class="text-lg font-bold place-self-center">Monitoring Peminjaman</h3>
                        <div class="flex gap-2">
                             <a href="{{ route('inventory.loans.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-center">
                                + Ajukan Peminjaman
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
                                    <th class="py-2 px-4 border-b text-left">Peminjam</th>
                                    <th class="py-2 px-4 border-b text-left">Barang</th>
                                    <th class="py-2 px-4 border-b text-center">Tanggal Pinjam</th>
                                    <th class="py-2 px-4 border-b text-center">Rencana Kembali</th>
                                    <th class="py-2 px-4 border-b text-center">Status</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loans as $loan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">
                                            <div class="font-medium text-gray-900">{{ $loan->warga->nama_lengkap }}</div>
                                            <div class="text-xs text-gray-500">RT {{ $loan->warga->rt }}</div>
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $loan->asset->nama_barang }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ date('d M Y', strtotime($loan->tanggal_pinjam)) }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ date('d M Y', strtotime($loan->tanggal_kembali)) }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            @php
                                                $colors = [
                                                    'Diajukan' => 'bg-yellow-100 text-yellow-800',
                                                    'Dipinjam' => 'bg-blue-100 text-blue-800',
                                                    'Dikembalikan' => 'bg-green-100 text-green-800',
                                                    'Ditolak' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$loan->status] ?? 'bg-gray-100' }}">
                                                {{ $loan->status }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            @if($loan->status !== 'Dikembalikan' && $loan->status !== 'Ditolak')
                                                <a href="{{ route('inventory.loans.edit', $loan->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Update Status</a>
                                            @endif
                                            
                                            <form action="{{ route('inventory.loans.destroy', $loan->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data peminjaman ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b text-center text-gray-500">Belum ada data peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
