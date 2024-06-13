<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'deskripsi',
        'kategori'
    ];
    // Fungsi untuk mendapatkan deskripsi lengkap kategori
    public function getKategoriDescription()
    {
        return DB::select('SELECT ketKategori(?) AS description', [$this->kategori])[0]->description;
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }

}
