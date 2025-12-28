@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')

<div class="stat-grid">
    <div class="stat-card">
   <div class="stat-info">
            <span>Alat Tersedia</span>
            <strong>{{ $availableTools ?? 0 }}</strong>
        </div>
        <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
            <i data-lucide="check-circle-2"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <span>Sedang Dipinjam</span>
            <strong>{{ $borrowedTools ?? 0 }}</strong>
        </div>
        <div class="stat-icon" style="background: #fef9c3; color: #ca8a04;">
            <i data-lucide="microscope"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <span>Peminjaman Aktif</span>
            <strong>{{ $activeLoans ?? 0 }}</strong>
        </div>
        <div class="stat-icon" style="background: var(--light-blue); color: var(--primary-blue);">
            <i data-lucide="clipboard-list"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <span>Total User</span>
            <strong>{{ $totalUsers ?? 0 }}</strong>
        </div>
        <div class="stat-icon" style="background: #f5f3ff; color: #7c3aed;">
            <i data-lucide="users"></i>
        </div>
    </div>
</div>

<div class="dashboard-body">
    <div class="chart-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin:0; font-size: 16px; font-weight: 600;">Statistik Peminjaman Bulanan</h3>
            <span style="font-size: 12px; color: var(--text-gray);">Data Tahun 2025</span>
        </div>
        <div class="chart-wrapper">
            <canvas id="loanChart"></canvas>
        </div>
    </div>

    <div class="quick-menu-card">
        <h3><i data-lucide="zap" size="18" style="color: #eab308;"></i> Menu Cepat</h3>
        <a href="{{ route('tools.create') }}" class="quick-link">
            <i data-lucide="plus-circle" size="18"></i>
            Tambah Alat Lab Baru
        </a>
        <a href="{{ route('admin.loans.index') }}" class="quick-link">
            <i data-lucide="file-plus" size="18"></i>
            Input Peminjaman Baru
        </a>
        <a href="{{ route('tools.index') }}" class="quick-link">
            <i data-lucide="search" size="18"></i>
            Cek Inventaris Alat
        </a>
        <a href="{{ route('admin.loans.index') }}" class="quick-link">
            <i data-lucide="history" size="18"></i>
            Riwayat Peminjaman
        </a>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('loanChart').getContext('2d');
        const chartData = @json($chartData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Pinjam',
                    data: chartData,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { color: '#f1f5f9' },
                        ticks: { stepSize: 1 } 
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    });

</script>



@endsection 