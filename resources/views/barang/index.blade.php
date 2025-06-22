{{-- File: resources/views/barang/index.blade.php --}}

<x-app-layout>
    <div class="container mx-auto max-w-7xl px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Inventaris Barang</h1>
            {{-- PERBAIKAN: Nama rute disesuaikan --}}
            <a href="{{ route('admin.products.create') }}"
                class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                + Tambah Barang
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-600">Nama Barang</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Kategori</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Stok</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Harga</th>
                            <th class="p-4 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($barangs as $item)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                {{-- PERBAIKAN: Kolom ID utama di Laravel adalah 'id' --}}
                                <td class="p-4 text-gray-900 font-medium">{{ $item->nama_barang }}</td>
                                <td class="p-4 text-gray-700">{{ $item->kategori }}</td>
                                <td class="p-4 text-gray-700">{{ $item->stok }}</td>
                                <td class="p-4 text-gray-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="p-4 text-center">
                                    {{-- PERBAIKAN: Nama rute disesuaikan --}}
                                    <a href="{{ route('admin.products.edit', $item->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 font-semibold mr-3">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">Data barang tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Bagian Paginasi --}}
            <div class="p-4 bg-white border-t border-gray-200">
                {{ $barangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
