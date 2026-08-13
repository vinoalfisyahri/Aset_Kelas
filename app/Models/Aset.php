<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $fillable = [
        'id_barang',
        'nomor_aset',
        'kondisi',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function masaEkonomis()
    {
        return $this->hasMany(MasaEkonomis::class, 'id_aset', 'id_aset');
    }
}
