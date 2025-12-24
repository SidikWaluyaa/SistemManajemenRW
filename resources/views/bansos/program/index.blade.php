<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Program Bansos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-bold">Daftar Program Bantuan</h3>
                        <a href="{{ route('bansos.program.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                            + Tambah Program
                        </a>
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
                                    <th class="py-2 px-4 border-b text-left">Nama Program</th>
                                    <th class="py-2 px-4 border-b text-left">Jenis</th>
                                    <th class="py-2 px-4 border-b text-left">Keterangan</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($programs as $program)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $program->nama_program }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $program->jenis_bantuan == 'Tunai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ $program->jenis_bantuan }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $program->keterangan ?? '-' }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <a href="{{ route('bansos.program.edit', $program->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form action="{{ route('bansos.program.destroy', $program->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-4 border-b text-center text-gray-500">Belum ada data program bansos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $programs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
