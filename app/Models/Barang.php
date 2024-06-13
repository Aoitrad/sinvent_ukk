<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';

    protected $fillable = [
        'merk',
        'seri',
        'spesifikasi',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id');
    }
     public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'barang_id');
    }
}
