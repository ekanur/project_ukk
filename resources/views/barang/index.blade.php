@extends('layout.mainLayout')

@section('title', 'Barang')

@section('content')
    {{-- {{dd($kategori)}} --}}
    @php
        if(!isset($_GET['paginationValue'])){
            $_GET['paginationValue'] = '4';
        };
        if(!isset($_GET['search'])){
            $_GET['search'] = '';
        };
    @endphp
    <div class="bg-white border shadow-lg">
        <div class="text-main font-bold secondary-bg p-4">Tabel Barang</div>
        <div class="p-4">
            <div class="flex justify-between">
                <div class="flex items-center">
                    Show
                    <form id="paginationForm" action={{route('barang.index')}} method="GET" class="mx-2">
                        <select name="paginationValue" class="border rounded p-1" onchange="getSubmit(this.value)">
                            <option value="1" {{$_GET['paginationValue'] == '1' ? 'selected' : ''}}>1</option>
                            <option value="2" {{$_GET['paginationValue'] == '2' ? 'selected' : ''}}>2</option>
                            <option value="3" {{$_GET['paginationValue'] == '3' ? 'selected' : ''}}>3</option>
                            <option value="4" {{$_GET['paginationValue'] == '4' ? 'selected' : ''}}>4</option>
                        </select> 
                    {{-- </form> --}}
                    entries 
                </div>
                <div class="flex items-center">
                    Search: 
                    {{-- <form action="" class="ml-2 flex items-center"> --}}
                        <input type="text" class="border rounded p-1" placeholder="Search for" name="search" value={{$_GET['search']}}>                   
                        <button type="submit"><i class="fa-solid fa-magnifying-glass p-2 main-bg text-white rounded ml-1"></i></button>
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <a href={{route('barang.create')}} class="main-bg text-white p-2 rounded">Tambah Barang</a>
            </div>
            @if ($errors->any())
                <div class="text-red-500 mt-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table-auto border-collapse w-full mt-6">
                <thead>
                    <tr>
                        <th class="border-2">ID</th>
                        <th class="border-2">Merk</th>
                        <th class="border-2">Seri</th>
                        <th class="border-2">Spesifikasi</th>
                        <th class="border-2">Stok</th>
                        <th class="border-2">Kategori</th>
                        <th class="border-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="border-2 text-center">{{$item->id}}</td>
                        <td class="border-2">{{$item->merk}}</td>
                        <td class="border-2">{{$item->seri}}</td>
                        <td class="border-2">{{$item->spesifikasi}}</td>
                        <td class="border-2 text-center">{{$item->stok}}</td>
                        <td class="border-2 text-center">
                            @foreach ($kategori as $kategoriItem)
                                {{$kategoriItem->id == $item->kategori_id ? $kategoriItem->deskripsi." (".$kategoriItem->kategori.")" : ''}}
                            @endforeach
                        </td>
                        <td class="border-2 text-center">
                            <div class="flex justify-evenly">
                                <a href={{route('barang.show', $item->id)}}><i class="fa-regular fa-eye text-white main-bg p-2 rounded"></i></a>
                                <a href={{route('barang.edit', $item->id)}}><i class="fa-solid fa-pen-to-square text-white warning-bg p-2 rounded"></i></a>
                                <form action={{route('barang.destroy', $item->id)}} method='POST'>
                                    @csrf
                                    @method('delete')
                                    <button type="submit"><i class="fa-solid fa-trash-can text-white danger-bg p-2 rounded"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">{{$data->links()}}</div>
        </div>
    </div>
@endsection