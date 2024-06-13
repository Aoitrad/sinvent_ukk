<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table="barang_keluars";
    protected $fillable = [
        'tgl_keluar', 
        'qty_keluar', 
        'barang_id',
        'id_barang_masuk'
    ];

    // Relasi ke model Kategori
    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barang_masuk');
    }
}
