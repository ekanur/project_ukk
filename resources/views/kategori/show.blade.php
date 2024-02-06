@extends('layout.mainLayout')

@section('title', 'Kategori Item')

@section('content')
    <div class="bg-white border shadow-lg">
        <div class="text-main font-bold secondary-bg p-4">Data Kategori</div>
        <div class="p-4">
            <div><strong>ID:</strong> {{$data->id}}</div>
            <div><strong>deskripsi:</strong> {{$data->deskripsi}}</div>
            <div><strong>kategori:</strong> {{$data->kategori}}</div>
        </div>
    </div>
@endsection