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
        Schema::create('divisi', function (Blueprint $table) {
            $table->id();
            $table->string('kodeDivisi');
            $table->string('namaDivisi');
            $table->timestamps();
        });
            DB::table('divisi')->insert([
                'kodedivisi' => 'CAS',
                'namaDivisi' => 'Custody and Settlements/Kustodian Efek dan Settlement Dana'
            ]);
            DB::table('divisi')->insert([
                'kodedivisi' => 'CC',
                'namaDivisi' => 'Credit Control'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'ERM',
                'namaDivisi' => 'Enterprise Risk Management/Manajemen Risiko Perusahaan'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'HR',
                'namaDivisi' => 'Human Resources atau HRD'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'IT',
                'namaDivisi' => 'Information Technology/Teknologi Informasi'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'LG',
                'namaDivisi' => 'Legal/Hukum'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'MKT',
                'namaDivisi' => 'Marketing/Pemasaran'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'RES',
                'namaDivisi' => 'Research/Riset'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'CRO',
                'namaDivisi' => 'Customer Relation Officer'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'DIR',
                'namaDivisi' => 'Direktur'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'FIN',
                'namaDivisi' => 'Finance'
            ]);
            DB::table('divisi')->insert([
                'kodeDivisi' => 'ACC',
                'namaDivisi' => 'Accounting'
            ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi');
    }
};
