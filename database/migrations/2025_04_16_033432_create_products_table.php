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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('jenis');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('merek');
            $table->string('deskripsi');
            $table->string('stok')->default(0);
            $table->string('harga_sewa');
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
