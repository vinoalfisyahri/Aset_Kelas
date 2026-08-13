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
        Schema::create('masa_ekonomis', function (Blueprint $table) {
            $table->id('id_ekonomis');

            // Pastikan tabel 'aset' sudah dibuat pada migration sebelumnya
            // dan menggunakan engine InnoDB dengan tipe data primary key yang sama (bigint unsigned)
            $table->foreignId('id_aset')
                ->constrained('aset', 'id_aset')
                ->cascadeOnDelete();

            $table->unsignedInteger('umur');
            $table->decimal('nilai_residu', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masa_ekonomis');
    }
};