<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasaEkonomis extends Model
{
    use HasFactory;

    protected $table = 'masa_ekonomis';
    protected $primaryKey = 'id_ekonomis';

    protected $fillable = [
        'id_aset',
        'umur',
        'nilai_residu',
    ];

    // Relasi balik ke model Aset (Belongs To)
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'id_aset', 'id_aset');
    }
}
