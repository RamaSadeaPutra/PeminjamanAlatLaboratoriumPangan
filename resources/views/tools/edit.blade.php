@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="card">
    <h3>Edit Alat</h3>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tools.update', $tool->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Alat</label><br>
        <input type="text" name="tool_name" value="{{ old('tool_name', $tool->tool_name) }}"><br><br>

        <label>Laboratorium</label><br>
        <select name="lab_id">
            @foreach($labs as $lab)
                <option value="{{ $lab->id }}" {{ $tool->lab_id == $lab->id ? 'selected' : '' }}>
                    {{ $lab->lab_name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Kategori</label><br>
        <select name="tool_category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $tool->tool_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Kondisi</label><br>
        <select name="condition">
            <option value="baik" {{ $tool->condition == 'baik' ? 'selected' : '' }}>Baik</option>
            <option value="rusak" {{ $tool->condition == 'rusak' ? 'selected' : '' }}>Rusak</option>
        </select><br><br>

        <label>Stok</label><br>
        <input type="number" name="stock" value="{{ old('stock', $tool->stock) }}"><br><br>

        <label>Deskripsi</label><br>
        <textarea name="description">{{ old('description', $tool->description) }}</textarea><br><br>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('tools.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection
