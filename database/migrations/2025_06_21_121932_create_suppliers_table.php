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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_supplier INT PRIMARY KEY AUTO_INCREMENT
            $table->string('nama_supplier'); // Sesuai dengan VARCHAR(255) NOT NULL
            $table->string('kontak', 100)->nullable(); // Sesuai dengan VARCHAR(100)
            $table->timestamps(); // Standar Laravel, untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
