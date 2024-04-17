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
        Schema::create('aset_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset_id'); // Menghapus unique()
            $table->string("namaAset");
            $table->string("detailAset");
            $table->string("jenisAset");
            $table->string("klasifikasiAset");
            $table->string("masaRetensi");
            $table->string("tglPembelian");
            $table->integer("jumlah");
            $table->string("image")->nullable();
            $table->string("status");
            $table->timestamps();

            $table->foreign('aset_id')->references('id')->on('aset')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_detail');
    }
};
