<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Database\QueryException;
use DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangmasuks = BarangMasuk::with('barang')->latest()->paginate(10);
        return view('barang_masuks.index', compact('barangmasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang_masuks.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        BarangMasuk::create($request->all());

        return redirect()->route('barang_masuks.index')->with('success', 'Barang masuk berhasil ditambahkan');
    }

    public function show($id)
    {
        $barangmasuk = BarangMasuk::with('barang')->findOrFail($id);
        return view('barang_masuks.show', compact('barangmasuk'));
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangs = Barang::all();
        return view('barang_masuks.edit', compact('barangmasuk', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->update($request->all());

        return redirect()->route('barang_masuks.index')->with('success', 'Barang masuk berhasil diupdate');
    }

    public function destroy($id)
    {
        $datamasuk = BarangMasuk::find($id);
        
        // Memeriksa apakah ada record di tabel BarangKeluar dengan barang_id yang sama
        $referencedInBarangKeluar = BarangKeluar::where('barang_id', $datamasuk->barang_id)->exists();

        if ($referencedInBarangKeluar) {
        // Jika ada referensi, penghapusan ditolak
        return redirect()->route('barangmasuk.index')->with(['error' => 'Data Tidak Bisa Dihapus Karena Masih Digunakan di Tabel Barang dan Barang Keluar!']);
        }

        // Menghapus record di tabel BarangMasuk
        $datamasuk->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);

    }
}
