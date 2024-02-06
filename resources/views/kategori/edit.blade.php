@extends('layout.mainLayout')

@section('title', 'Edit Kategori')

@section('content')
<div class="bg-white border shadow-lg">
    <div class="text-main font-bold secondary-bg p-4">Edit Kategori</div>
    <div class="p-4">
        <form action={{route('kategori.update', $data->id)}} method="POST">
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
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" class="border rounded p-1 w-full" value="{{$data->deskripsi}}">

            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="border rounded p-1 w-full">
                <option value="M" {{$data->kategori == "M" ? 'selected' : ''}}>Modal</option>
                <option value="A" {{$data->kategori == "A" ? 'selected' : ''}}>Alat</option>
                <option value="BHP" {{$data->kategori == "BHP" ? 'selected' : ''}}>Bahan Habis Pakai</option>
                <option value="BTHP" {{$data->kategori == "BTHP" ? 'selected' : ''}}>Bahan Tidak Habis Pakai</option>
            </select>
            
            <div class="mt-6">
                <button type="submit" class="main-bg text-white p-2 rounded">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection