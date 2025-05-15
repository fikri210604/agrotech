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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_penyewa');
            $table->string('no_hp_penyewa');
            $table->string('email_penyewa');
            $table->string('alamat_penyewa');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('jumlah_pemesanan');
            $table->date('tanggal_awal_sewa');
            $table->date('tanggal_akhir_sewa');
            $table->integer('total_harga');
            $table->enum('status', ['lunas', 'pending','batal'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
