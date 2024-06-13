<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table="barang_masuks";
    protected $fillable = [
        'tgl_masuk', 
        'qty_masuk', 
        'barang_id'
    ];

    // Relasi ke model Kategori
    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'id_barang_masuk');
    }
}
