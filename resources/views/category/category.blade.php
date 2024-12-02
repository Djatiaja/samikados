@extends('layouts.app-be')

@section('style')
<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        background-color: #f2dede;
        border-color: #ebccd1;
        color: #a94442;
    }
</style>
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success mt-3">
    {{ $message }}
</div>
@elseif ($message = Session::get('error'))
<div class="alert alert-danger mt-3" role="alert">
    {{ $message }}
</div>
@endif

<div class="container mt-4 mb-4">
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>
                    Nama Kategori
                </th>
                <th>
                    Deskripsi
                </th>
                <th>
                    Jumlah Produk
                </th>
                <th>
                    Icon
                </th>
                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $category)
            <tr>
                <td> {{ $category ->name }}</td>
                <td> {{ $category ->description }}</td>
                <td> {{ $jumlah_produk }}</td>
                <td> <img src="{{asset('storage/public/'.$category->icon)}}"  width="100px" height="100px">
                <td>
                <a href="{{ url('admin/category/update/'.$category->id) }}">
                    <button class="btn-primary rounded-3">
                        edit
                    </button>
                </a>

                <form action="{{route('category.delete', $category->id)}}">
                    @method('delete')
                    <button type="submit">delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-100 d-flex justify-content-center">
        <a href="{{ url('admin/category/create') }}">
            <button class="btn-primary rounded-3">
                Tambah category
            </button>
        </a>
    </div>
</div>
@endsection('content')