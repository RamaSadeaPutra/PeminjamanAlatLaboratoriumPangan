@extends('layouts.user')

@section('title', 'Daftar Alat')

@section('content')

<h2 style="margin-bottom: 24px;">Alat Tersedia</h2>

<div class="grid">
    @foreach ($tools as $tool)
        <div class="card">
            <span class="badge">{{ $tool->category->name ?? 'Tanpa Kategori' }}</span>

            <h3>{{ $tool->tool_name }}</h3>

            <p><strong>Lab:</strong> {{ $tool->lab->name ?? '-' }}</p>
            <p><strong>Stok:</strong> {{ $tool->stock }}</p>
            <p><strong>Kondisi:</strong> {{ $tool->condition }}</p>

            <a href="{{ route('loans.create', ['tool_id' => $tool->id]) }}" class="btn">
                Pinjam Alat
            </a>
        </div>
    @endforeach
</div>

@endsection
