<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $paginationValue = $request->paginationValue ?? 4;
        return view('barangkeluar.index', [
            'data' => BarangKeluar::where('tgl_keluar', 'like', "%$search%")->orWhere('barang_id', 'like', "%$search%")->paginate($paginationValue)->withQueryString(),
            'barang' => Barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangkeluar.create', [
            'barang' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BarangKeluar::create($request->validate([
            'tgl_keluar' => 'required',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required'
        ]));
        
        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangkeluar)
    {
        return view('barangkeluar.show' , [
            'data' => $barangkeluar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangkeluar)
    {
        return view('barangkeluar.edit', [
            'data' => $barangkeluar,
            'barang' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangkeluar)
    {
        $barangkeluar->update($request->validate([
            'tgl_keluar' => 'required',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required'
        ]));

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangkeluar)
    {
        $barangkeluar->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar berhasil dihapus!');
    }
}
