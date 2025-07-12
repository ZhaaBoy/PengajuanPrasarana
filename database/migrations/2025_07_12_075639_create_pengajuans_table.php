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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->decimal('total_harga', 12, 2); // Menyimpan harga total
            $table->date('tanggal_diperlukan');   // Tanggal barang diperlukan
            $table->text('keterangan')->nullable();
            $table->enum('status_kepsek', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_kepsek')->nullable();
            $table->enum('status_admin', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
