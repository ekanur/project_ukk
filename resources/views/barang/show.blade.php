@extends('layout.mainLayout')

@section('title', 'Barang Item')

@section('content')
    <div class="bg-white border shadow-lg">
        <div class="text-main font-bold secondary-bg p-4">Data Barang</div>
        <div class="p-4">
            <div><strong>ID:</strong> {{$data->id}}</div>
            <div><strong>Merk:</strong> {{$data->merk}}</div>
            <div><strong>Seri:</strong> {{$data->seri}}</div>
            <div><strong>Spesifikasi:</strong> {{$data->spesifikasi}}</div>
            <div><strong>Stok:</strong> {{$data->stok}}</div>
            <div><strong>kategori ID:</strong> {{$data->kategori_id}}</div>
        </div>
    </div>
@endsection