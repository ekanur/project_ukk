<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $paginationValue = $request->paginationValue ?? 4;
        return view('kategori.index', [
            'data' => Kategori::where('kategori', 'like', "%$search%")->orWhere('deskripsi', 'like', "%$search%")->paginate($paginationValue)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);
        Kategori::create($data);
        return redirect()->route('kategori.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return view('kategori.show', [
            'data' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', [
            'data' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]));
        return redirect()->route('kategori.index')->with('success', 'Data kategori telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
        }

        catch (QueryException $e){
            if($e->getCode() === '23000') {
                return redirect()->route('kategori.index')->withErrors(['msg' => 'Data Kategori digunakan di tabel lain!']);
            }
        }

        return redirect()->route('kategori.index')->with('success', 'Data kategori telah dihapus!');
    }
}
