@extends('layout.mainLayout')

@section('title', 'Edit Barang Masuk')

@section('content')
<div class="bg-white border shadow-lg">
    <div class="text-main font-bold secondary-bg p-4">Edit Barang Masuk</div>
    <div class="p-4">
        <form action={{route('barangmasuk.update', $data->id)}} method="POST">
            @csrf
            @method('put')
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="tgl_masuk" class="border rounded p-1 w-full hidden" value={{now()}}>

            <label for="qty_masuk">Kuantitas Masuk</label>
            <input type="text" name="qty_masuk" id="qty_masuk" class="border rounded p-1 w-full" value="{{$data->qty_masuk}}">
            
            <label for="barang_id">Barang</label>
            <select name="barang_id" id="barang_id" class="border rounded p-1 w-full">
                @foreach ($barang as $item)
                    <option value={{$item->id}} {{$item->id == $data->barang_id ? 'selected' : ''}}>{{$item->merk}} ({{$item->seri}})</option>
                @endforeach
            </select>
            
            <div class="mt-6">
                <button type="submit" class="main-bg text-white p-2 rounded">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection