@extends('layouts.app')

@section('title', 'Data Alat')

@section('content')
<div class="card">
    <h3>Daftar Alat Laboratorium</h3>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('tools.create') }}" class="btn btn-primary">+ Tambah Alat</a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Lab</th>
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tools as $tool)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tool->tool_name }}</td>
                    <td>{{ $tool->lab->lab_name }}</td>
                    <td>{{ $tool->category->category_name }}</td>
                    <td>{{ ucfirst($tool->condition) }}</td>
                    <td>{{ $tool->stock }}</td>
                    <td>
                        <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Yakin hapus alat ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data alat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
