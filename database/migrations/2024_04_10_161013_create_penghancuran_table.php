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
        Schema::create('penghancuran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aset_id');
            $table->string('nama_aset');
            $table->string("tipePemusnahan");
            $table->string("tglPemusnahan");
            $table->unsignedBigInteger("pengesahan")->nullable();
            $table->unsignedBigInteger("pemohon");
            $table->string("status");
            $table->string("keterangan");
            $table->string("image")->nullable();
            $table->timestamps();

            $table->foreign('aset_id')->references('id')->on('aset')->onDelete('cascade');
            $table->foreign('pemohon')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengesahan')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghancuran');
    }
};
