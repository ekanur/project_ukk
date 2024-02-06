@extends('layout.mainLayout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="bg-white border shadow-lg">
    <div class="text-main font-bold secondary-bg p-4">Tambah Kategori</div>
    <div class="p-4">
        <form action={{route('kategori.store')}} method="POST">
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
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" class="border rounded p-1 w-full">

            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="border rounded p-1 w-full">
                <option value="M">Modal</option>
                <option value="A">Alat</option>
                <option value="BHP">Bahan Habis Pakai</option>
                <option value="BTHP">Bahan Tidak Habis Pakai</option>
            </select>
            
            <div class="mt-6">
                <button type="submit" class="main-bg text-white p-2 rounded">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection