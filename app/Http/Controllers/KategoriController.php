<?php

namespace App\Http\Controllers;

use App\Models\Kategori; 
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get all categories
        $kategoris = Kategori::orderBy('id')->paginate(10);

        // Add ketKategori descriptions
        foreach ($kategoris as $kategori) {
            $kategori->kategori_description = $this->ketKategori($kategori->kategori);
        }

        //render view with categories
        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('kategoris.create');
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'deskripsi'   => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategoris')->where(function ($query) use ($request) {
                    return $query->where('deskripsi', $request->deskripsi);
                })
            ],
            'kategori'    => 'required|in:M,A,BHP,BTHP'
        ], [
            'deskripsi.unique' => $request->deskripsi . ' telah tersedia.'
        ]);


        //create category
        Kategori::create([
            'deskripsi'   => $request->deskripsi,
            'kategori'    => $request->kategori
        ]);

        //redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  string $id
     * @return View
     */
    public function show(string $id): View
    {
        //get category by ID
        $kategori = Kategori::findOrFail($id);

        // Add ketKategori description
        $kategori->kategori_description = $this->ketKategori($kategori->kategori);

        //render view with category
        return view('kategoris.show', compact('kategori'));
    }
    
    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get category by ID
        $kategori = Kategori::findOrFail($id);

        // Add ketKategori description
        $kategori->kategori_description = $this->ketKategori($kategori->kategori);

        //render view with category
        return view('kategoris.edit', compact('kategori'));
    }
        
    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'deskripsi'   => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategoris')->where(function ($query) use ($request) {
                    return $query->where('deskripsi', $request->deskripsi);
                })
            ],
            'kategori'    => 'required|in:M,A,BHP,BTHP'
        ], [
            'deskripsi.unique' => $request->deskripsi . ' telah tersedia.'
        ]);

        //get category by ID
        $kategori = Kategori::findOrFail($id);

        //update category
        $kategori->update([
            'deskripsi'   => $request->deskripsi,
            'kategori'    => $request->kategori
        ]);

        //redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        //get category by ID
        $kategori = Kategori::findOrFail($id);

        //delete category
        $kategori->delete();

        //redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * ketKategori
     *
     * @param  string $kat
     * @return string
     */
    private function ketKategori(string $kat): string
    {
        $kategori = DB::select('SELECT ketKategori(?) AS description', [$kat]);
        return $kategori[0]->description ?? 'Unknown';
    }
}