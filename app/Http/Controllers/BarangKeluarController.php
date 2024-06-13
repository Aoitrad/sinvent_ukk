<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Barang;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangkeluars = BarangKeluar::with('barang')->latest()->paginate(10);
        return view('barang_keluars.index', compact('barangkeluars'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barang_keluars.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi tanggal
        $barangMasukTerakhir = $barang->barangMasuks()->latest('tgl_masuk')->first();
        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withErrors(['tgl_keluar' => 'Tanggal barang keluar tidak boleh mendahului tanggal barang masuk terakhir.'])->withInput();
        }

        // Validasi stok
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok yang tersedia.'])->withInput();
        }

        BarangKeluar::create($request->all());

        return redirect()->route('barang_keluars.index')->with('success', 'Barang keluar berhasil ditambahkan');
    }

    public function show($id)
    {
        $barangkeluar = BarangKeluar::with('barang')->findOrFail($id);
        return view('barang_keluars.show', compact('barangkeluar'));
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangs = Barang::all();
        return view('barang_keluars.edit', compact('barangkeluar', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barangkeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi tanggal
        $barangMasukTerakhir = $barang->barangMasuks()->latest('tgl_masuk')->first();
        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withErrors(['tgl_keluar' => 'Tanggal barang keluar tidak boleh mendahului tanggal barang masuk terakhir.'])->withInput();
        }

        // Validasi stok
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok yang tersedia.'])->withInput();
        }

        $barangkeluar->update($request->all());
        return redirect()->route('barang_keluars.index')->with('success', 'Barang keluar berhasil diupdate');
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->delete();

        return redirect()->route('barang_keluars.index')->with('success', 'Barang keluar berhasil dihapus');
    }
}
