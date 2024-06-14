<?php
// app/Http/Controllers/BarangController.php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->paginate(10);
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barangs.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:50',
            'seri' => 'required|string|max:50',
            'spesifikasi' => 'nullable|string',
            'stok' => 'default(0)',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        Barang::create($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang created successfully.');
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('barangs.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required|string|max:50',
            'seri' => 'required|string|max:50',
            'spesifikasi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang updated successfully.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        
        try {
            $barang->delete();
            return redirect()->route('barangs.index')->with('success', 'Barang deleted successfully.');
        } catch (QueryException $e) {
            return redirect()->route('barangs.index')->with('error', 'Barang cannot be deleted because it is associated with other records.');
        }
    }

}
