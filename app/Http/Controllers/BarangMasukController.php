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
        // Cek apakah ada data barang keluar terkait dengan barang masuk yang akan dihapus
        $barangKeluar = BarangKeluar::where('id_barang_masuk', $id)->first();
        if ($barangKeluar) {
            return redirect()->route('barang_masuks.index')->with(['error' => 'Data tidak dapat dihapus karena terkait dengan data barang keluar!']);
        }

        // Jika tidak ada data barang keluar terkait, maka hapus data barang masuk
        $barangMasuk = BarangMasuk::findOrFail($id);

        DB::beginTransaction();
        try {
            $barangMasuk->delete();
            DB::commit();
            return redirect()->route('barang_masuks.index')->with(['success' => 'Data Barang Masuk Berhasil Dihapus!']);
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('barang_masuks.index')->with(['error' => 'Data tidak dapat dihapus karena terkait dengan data barang keluar!']);
        }
    }
}
