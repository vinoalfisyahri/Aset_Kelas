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
        Schema::create('penyusutan', function (Blueprint $table) {
            $table->id('id_penyusutan');
            $table->unsignedBigInteger('id_aset');
            $table->year('tahun');
            $table->decimal('nilai_penyusutan', 15, 2);
            $table->decimal('nilai_buku', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyusutan');
    }
};