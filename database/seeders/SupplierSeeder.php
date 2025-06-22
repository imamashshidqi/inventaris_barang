<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT. Sinar Jaya Abadi',
                'kontak' => '081234567890',
            ],
            [
                'nama_supplier' => 'CV. Mitra Perkasa',
                'kontak' => 'sales@mitraperkasa.com',
            ],
            [
                'nama_supplier' => 'UD. Makmur Sentosa',
                'kontak' => '021-555-1234',
            ],
        ];

        foreach ($suppliers as $supplierData) {
            Supplier::create($supplierData);
        }
    }
}
