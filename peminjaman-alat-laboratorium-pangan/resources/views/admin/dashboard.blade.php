@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="grid">

    <!-- STAT CARDS -->
    <div class="cards">
        <div class="stat-card">
            <span>Total Alat</span>
            <strong>{{ $totalTools }}</strong>
        </div>

        <div class="stat-card green">
            <span>Total Peminjaman</span>
            <strong>{{ $totalLoans }}</strong>
        </div>

        <div class="stat-card purple">
            <span>Total User</span>
            <strong>{{ $totalUsers }}</strong>
        </div>
    </div>

    <!-- MENU -->
    <div class="card" style="margin-top: 32px;">
        <h3 style="margin-bottom: 16px;">Menu Admin</h3>

        <div class="menu-buttons">
            <a href="{{ route('tools.index') }}" class="btn btn-primary">
                Kelola Alat
            </a>

            <a href="{{ route('loans.index') }}" class="btn btn-warning">
                Data Peminjaman
            </a>
        </div>
    </div>

</div>

<style>
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 14px;
        box-shadow: 0 12px 25px rgba(0,0,0,.08);
    }

    .stat-card span {
        color: #6b7280;
        font-size: 14px;
    }

    .stat-card strong {
        display: block;
        font-size: 34px;
        margin-top: 10px;
        color: #2563eb;
    }

    .stat-card.green strong {
        color: #16a34a;
    }

    .stat-card.purple strong {
        color: #7c3aed;
    }

    .menu-buttons {
        display: flex;
        gap: 16px;
    }
</style>

@endsection
