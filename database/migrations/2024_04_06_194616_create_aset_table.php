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
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('kodeAset');
            $table->string('namaAset');
            $table->string('detailAset');
            $table->string('jenisAset');
            $table->string('klasifikasiAset');
            $table->string('ciaLevel');
            $table->integer('asetValuation')->nullable;
            $table->string('nilaiRisiko');
            $table->string('masaRetensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_register');
    }
};
