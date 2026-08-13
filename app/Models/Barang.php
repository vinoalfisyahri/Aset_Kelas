<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kode_barang',
        'kategori_barang',
        'merk',
        'tipe',
        'harga',
    ];

    public function aset()
    {
        return $this->hasMany(Aset::class, 'id_barang', 'id_barang');
    }
}
