<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
    use HasFactory;

    protected $table = 'penyusutan';

    protected $primaryKey = 'id_penyusutan';

    protected $fillable = [
        'id_aset',
        'tahun',
        'nilai_penyusutan',
        'nilai_buku',
    ];

    /**
     * Relasi ke tabel aset
     */
    public function aset()
    {
        return $this->belongsTo(
            Aset::class,
            'id_aset',
            'id_aset'
        );
    }
}
