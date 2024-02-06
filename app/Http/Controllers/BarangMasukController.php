<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $paginationValue = $request->paginationValue ?? 4;
        return view('barangmasuk.index', [
            'data' => BarangMasuk::where('tgl_masuk', 'like', "%$search%")->orWhere('barang_id', 'like', "%$search%")->paginate($paginationValue)->withQueryString(),
            'barang' => Barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangmasuk.create', [
            'barang' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BarangMasuk::create($request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|integer|min:1',
            'barang_id' => 'required'
        ]));
        
        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangmasuk)
    {
        return view('barangmasuk.show', [
            'data' => $barangmasuk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangmasuk)
    {
        return view('barangmasuk.edit', [
            'data' => $barangmasuk,
            'barang' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangmasuk)
    {
        $barangmasuk->update($request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|integer|min:1',
            'barang_id' => 'required'
        ]));

        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangmasuk)
    {
        $barangmasuk->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk berhasil dihapus!');
    }
}
