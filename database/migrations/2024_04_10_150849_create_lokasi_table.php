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
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('kodeLokasi');
            $table->string('alamat');
            $table->timestamps();
        });
        DB::table('lokasi')->insert([
            'kodeLokasi' => '01',
            'alamat' => 'dibawa pulang'
        ]);
        DB::table('lokasi')->insert([
            'kodeLokasi' => '03',
            'alamat' => 'Main Site Server Duren 3'
        ]);
        DB::table('lokasi')->insert([
            'kodeLokasi' => '04',
            'alamat' => 'DRC Site Kospin Jasa'
        ]);
        DB::table('lokasi')->insert([
            'kodeLokasi' => '07',
            'alamat' => 'Lantai 7 Kospin jasa'
        ]);
        DB::table('lokasi')->insert([
            'kodeLokasi' => '08',
            'alamat' => 'Lantai 8 Kospin jasa'
        ]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi');
    }
};
