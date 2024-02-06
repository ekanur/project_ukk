@extends('layout.mainLayout')

@section('title', 'Barang Masuk Item')

@section('content')
    <div class="bg-white border shadow-lg">
        <div class="text-main font-bold secondary-bg p-4">Data Barang Masuk</div>
        <div class="p-4">
            <div><strong>ID:</strong> {{$data->id}}</div>
            <div><strong>Tanggal Masuk:</strong> {{$data->tgl_masuk}}</div>
            <div><strong>Kuantitas Masuk:</strong> {{$data->qty_masuk}}</div>
            <div><strong>Barang ID:</strong> {{$data->barang_id}}</div>
        </div>
    </div>
@endsection 