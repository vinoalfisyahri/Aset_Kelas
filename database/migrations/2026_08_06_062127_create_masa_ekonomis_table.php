<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masa_ekonomis', function (Blueprint $table) {
            $table->id('id_ekonomis');

            $table->foreignId('id_barang')
                ->constrained('barang', 'id_barang')
                ->onDelete('cascade');

            $table->integer('umur');
            $table->decimal('nilai_residu', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masa_ekonomis');
    }
};