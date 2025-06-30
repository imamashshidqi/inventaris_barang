<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barangs = Barang::query()->latest()->filter($request->only(['search', 'supplier']))->paginate(10)->withQueryString();
        $suppliers = Supplier::query();

        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('barang.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'id_supplier' => 'required|exists:suppliers,id', // Pastikan supplier ada di database
        ]);

        // Buat record baru di tabel 'barangs'
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'id_supplier' => $request->id_supplier,
            // Jika ada field lain, tambahkan di sini
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.products.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $product)
    {
        // Ambil semua supplier untuk dropdown
        $suppliers = Supplier::all();

        // Kirim data barang yang akan diedit ($product) dan daftar supplier ke view
        return view('barang.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $product)
    {
        // Validasi input dari form
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'id_supplier' => 'required|exists:suppliers,id',
        ]);

        // Update record barang yang ada dengan data baru
        $product->update($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.products.index')
            ->with('success', 'Data barang berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $product)
    {
        // 1. Hapus record dari database
        $product->delete();

        // 2. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.products.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
