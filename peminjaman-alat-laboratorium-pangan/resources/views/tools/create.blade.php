@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<div class="card">
    <h3>Tambah Alat</h3>

    <form action="{{ route('tools.store') }}" method="POST">
        @csrf

        <label>Nama Alat</label><br>
        <input type="text" name="tool_name"><br><br>

        <label>Laboratorium</label><br>
        <select name="lab_id">
            @foreach($labs as $lab)
                <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
            @endforeach
        </select><br><br>

        <label>Kategori</label><br>
        <select name="tool_category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select><br><br>

        <label>Kondisi</label><br>
        <select name="condition">
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
        </select><br><br>

        <label>Stok</label><br>
        <input type="number" name="stock"><br><br>

        <label>Deskripsi</label><br>
        <textarea name="description"></textarea><br><br>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
