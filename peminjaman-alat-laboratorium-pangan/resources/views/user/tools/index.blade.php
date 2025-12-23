@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Katalog Alat Laboratorium</h2>
        <p class="text-muted">Pilih alat yang Anda butuhkan untuk praktikum atau riset.</p>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Alat">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Multimeter Digital</h5>
                    <span class="badge bg-info text-dark mb-2">Elektronika</span>
                    <p class="card-text text-muted small">Status: <span class="text-success fw-bold">Tersedia</span></p>
                    <a href="#" class="btn btn-primary w-100 rounded-pill">Ajukan Pinjaman</a>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection