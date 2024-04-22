<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        DB::table('aset')->insert([
            'kodeAset' => '001',
            'namaAset' => 'Laptop',
            'detailAset' => 'Digunakan Untuk Kerja',
            'jenisAset' => 'Hardware',
            'klasifikasiAset' => 'Publik',
            'ciaLevel' => 'Low',
            'AsetValuation' => '0',
            'nilaiRisiko' => '5',
            'masaRetensi' => '5'
        ]);
        DB::table('aset')->insert([
            'kodeAset' => '002',
            'namaAset' => 'Komputer',
            'detailAset' => 'Digunakan Untuk Kerja',
            'jenisAset' => 'Hardware',
            'klasifikasiAset' => 'Publik',
            'ciaLevel' => 'Low',
            'AsetValuation' => '0',
            'nilaiRisiko' => '5',
            'masaRetensi' => '5'
        ]);
        DB::table('aset')->insert([
            'kodeAset' => '003',
            'namaAset' => 'Software',
            'detailAset' => 'Digunakan Untuk Kerja',
            'jenisAset' => 'Software',
            'klasifikasiAset' => 'Publik',
            'ciaLevel' => 'Low',
            'AsetValuation' => '0',
            'nilaiRisiko' => '5',
            'masaRetensi' => '5'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_register');
    }
};
