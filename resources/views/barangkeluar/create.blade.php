@extends('layout.mainLayout')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="bg-white border shadow-lg">
    <div class="text-main font-bold secondary-bg p-4">Tambah Barang Keluar</div>
    <div class="p-4">
        <form action={{route('barangkeluar.store')}} method="POST">
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="tgl_keluar" class="border rounded p-1 w-full hidden" value={{now()}}>

            <label for="qty_keluar">Kuantitas Keluar</label>
            <input type="text" name="qty_keluar" id="qty_keluar" class="border rounded p-1 w-full">
            
            <label for="barang_id">Barang</label>
            <select name="barang_id" id="barang_id" class="border rounded p-1 w-full">
                @foreach ($barang as $item)
                    <option value={{$item->id}}>{{$item->merk}} ({{$item->seri}})</option>
                @endforeach
            </select>
            
            <div class="mt-6">
                <button type="submit" class="main-bg text-white p-2 rounded">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection