    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_kelas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_aset')->constrained('aset', 'id_aset')->cascadeOnDelete();
            // Sesuaikan dengan parameter kedua ('id_kelas')
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_kelas');
    }
};