<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_barang
            $table->string('nama_barang');
            $table->string('kategori', 100)->nullable();
            $table->integer('stok');
            $table->decimal('harga', 10, 2);

            // -- KUNCI RELASI (FOREIGN KEY) --
            // Kolom ini harus nullable() jika kita ingin menggunakan onDelete('set null')
            $table->unsignedBigInteger('id_supplier')->nullable();

            // Membuat constraint foreign key
            $table->foreign('id_supplier')
                ->references('id')      // Mengacu pada kolom 'id'
                ->on('suppliers')       // di tabel 'suppliers'
                ->onDelete('set null'); // Aksi saat supplier dihapus:
            // Nilai id_supplier di tabel barang akan menjadi NULL.
            // Opsi lain: onDelete('cascade') akan menghapus barang jika supplier dihapus.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
