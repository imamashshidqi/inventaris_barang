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
                'id' => 1,
                'nama_supplier' => 'PT. Sinar Jaya Abadi',
                'kontak' => '081234567890',
            ],
            [
                'id' => 2,
                'nama_supplier' => 'CV. Mitra Perkasa',
                'kontak' => 'sales@mitraperkasa.com',
            ],
            [
                'id' => 3,
                'nama_supplier' => 'UD. Makmur Sentosa',
                'kontak' => '021-555-1234',
            ],
        ];

        foreach ($suppliers as $supplierData) {
            Supplier::create($supplierData);
        }
    }
}
