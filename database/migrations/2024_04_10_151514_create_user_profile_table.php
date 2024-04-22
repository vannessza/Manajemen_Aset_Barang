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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('divisi_id');
            $table->string("alamat");
            $table->string("noTelp");
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('divisi_id')->references('id')->on('divisi')->onDelete('cascade');
        });  
            DB::table('user_profile')->insert([
                'user_id' => '1',
                'divisi_id' => '5',
                'alamat' => 'Jl. Gatot Subroto Kav. 1, Daerah Khusus Ibukota Jakarta',
                'noTelp' => '0812345678',
            ]);
            DB::table('user_profile')->insert([
                'user_id' => '2',
                'divisi_id' => '5',
                'alamat' => 'Jl. Gatot Subroto Kav. 1, Daerah Khusus Ibukota Jakarta',
                'noTelp' => '0812345678',
            ]);
            DB::table('user_profile')->insert([
                'user_id' => '3',
                'divisi_id' => '6',
                'alamat' => 'Jl. Gatot Subroto Kav. 1, Daerah Khusus Ibukota Jakarta',
                'noTelp' => '0812345678',
            ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
