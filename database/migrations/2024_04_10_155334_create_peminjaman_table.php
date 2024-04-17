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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('aset_id')->unique();
            $table->unsignedBigInteger('nama_aset_id')->unique();
            $table->string("kodePeminjaman");
            $table->string("tglPeminjaman");
            $table->string("status");
            $table->string("keterangan");
            $table->string("image")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('aset_id')->references('id')->on('aset')->onDelete('cascade');
            $table->foreign('nama_aset_id')->references('id')->on('aset_detail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
