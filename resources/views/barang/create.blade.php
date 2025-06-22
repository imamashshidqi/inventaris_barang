{{-- File: resources/views/barang/create.blade.php (Versi Final) --}}

<x-app-layout>
    {{-- PERBAIKAN: Menambahkan slot untuk judul halaman --}}
    <x-slot:title>Tambah Barang Baru</x-slot:title>

    <div class="container mx-auto max-w-4xl px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Barang Baru</h1>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                    </div>

                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <div>
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                        <input type="number" id="stok" name="stok" value="{{ old('stok') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                    </div>

                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        <input type="number" step="0.01" id="harga" name="harga" value="{{ old('harga') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label for="id_supplier" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                        <select id="id_supplier" name="id_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="" disabled {{ old('id_supplier') ? '' : 'selected' }}>Pilih Supplier
                            </option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('id_supplier') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_supplier')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="inline-block bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-gray-300 transition duration-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
