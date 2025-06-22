<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        $suppliers = Supplier::all();

        return view('index', [
            'barangs' => $barangs,
            'suppliers' => $suppliers
        ]);
    }
}
