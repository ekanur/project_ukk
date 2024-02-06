<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $paginationValue = $request->paginationValue ?? 4;
        return view('barang.index', [
            'data' => Barang::where('merk', 'like', "%$search%")->orWhere('seri', 'like', "%$search%")->orWhere('spesifikasi', 'like', "%$search%")->paginate($paginationValue)->withQueryString(),
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create', [
            'pilihan' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Barang::create($request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required'
        ]));

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', [
            'data' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'data' => $barang,
            'pilihan' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required'
        ]));

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
        }

        catch (QueryException $e){
            if($e->getCode() === '23000') {
                return redirect()->route('barang.index')->withErrors(['msg' => 'Data barang digunakan di tabel lain!']);
            }
        }
        
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus!');

    }
}
