{{-- File: resources/views/barang/index.blade.php --}}

<x-app-layout>
    <div class="container px-4 py-8 mx-auto max-w-7xl">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Inventaris Barang</h1>
        <div class="flex items-center justify-between mb-6">
            <div class="w-full md:w-1/2">
                <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="simple-search"
                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Cari barang..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>
            <a href="{{ route('admin.products.create') }}"
                class="inline-block px-4 py-2 font-semibold text-white transition duration-300 bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
                + Tambah Barang
            </a>
        </div>

        @if (session('success'))
            <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b-2 border-gray-200 bg-gray-50">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-600">Nama Barang</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Kategori</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Stok</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Harga</th>
                            <th class="p-4 text-sm font-semibold text-gray-600">Supplier</th>
                            <th class="p-4 text-sm font-semibold text-center text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($barangs as $item)
                            <tr class="transition duration-200 hover:bg-gray-50">
                                {{-- PERBAIKAN: Kolom ID utama di Laravel adalah 'id' --}}
                                <td class="p-4 font-medium text-gray-900">{{ $item->nama_barang }}</td>
                                <td class="p-4 text-gray-700">{{ $item->kategori }}</td>
                                <td class="p-4 text-gray-700">{{ $item->stok }}</td>
                                <td class="p-4 text-gray-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="p-4 text-gray-700">{{ $item->supplier->nama_supplier }}</td>
                                <td class="p-4 text-center">
                                    {{-- PERBAIKAN: Nama rute disesuaikan --}}
                                    <a href="{{ route('admin.products.edit', $item->id) }}"
                                        class="mr-3 font-semibold text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-semibold text-red-600 hover:text-red-900">Hapus</button>
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
