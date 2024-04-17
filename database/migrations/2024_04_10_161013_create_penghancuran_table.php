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
            $table->unsignedBigInteger('aset_id')->unique();
            $table->unsignedBigInteger('nama_aset_id')->unique();
            $table->string("tipePemusnahan");
            $table->string("tglPemusnahan");
            $table->string("pengesahan");
            $table->string("pemohon");
            $table->string("status");
            $table->string("image")->nullable();
            $table->timestamps();

            $table->foreign('aset_id')->references('id')->on('aset')->onDelete('cascade');
            $table->foreign('nama_aset_id')->references('id')->on('aset_detail')->onDelete('cascade');
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
