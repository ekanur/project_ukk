@extends('layout.mainLayout')

@section('title', 'Barang Keluar Item')

@section('content')
    <div class="bg-white border shadow-lg">
        <div class="text-main font-bold secondary-bg p-4">Data Barang Keluar</div>
        <div class="p-4">
            <div><strong>ID:</strong> {{$data->id}}</div>
            <div><strong>Tanggal Keluar:</strong> {{$data->tgl_keluar}}</div>
            <div><strong>Kuantitas Keluar:</strong> {{$data->qty_keluar}}</div>
            <div><strong>Barang ID:</strong> {{$data->barang_id}}</div>
        </div>
    </div>
@endsection 