@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-100 flex justify-between items-center transition-transform hover:-translate-y-1 shadow-sm">
        <div class="space-y-1">
            <span class="block text-slate-500 text-sm font-medium">Alat Tersedia</span>
            <strong class="text-3xl text-slate-800">{{ $availableTools ?? 0 }}</strong>
        </div>
        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-100 flex justify-between items-center transition-transform hover:-translate-y-1 shadow-sm">
        <div class="space-y-1">
            <span class="block text-slate-500 text-sm font-medium">Sedang Dipinjam</span>
            <strong class="text-3xl text-slate-800">{{ $borrowedTools ?? 0 }}</strong>
        </div>
        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
            <i data-lucide="microscope" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-100 flex justify-between items-center transition-transform hover:-translate-y-1 shadow-sm">
        <div class="space-y-1">
            <span class="block text-slate-500 text-sm font-medium">Peminjaman Aktif</span>
            <strong class="text-2xl text-slate-800">{{ $activeLoans ?? 0 }}</strong>
        </div>
        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
            <i data-lucide="clipboard-list" class="w-6 h-6"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-100 flex justify-between items-center transition-transform hover:-translate-y-1 shadow-sm">
        <div class="space-y-1">
            <span class="block text-slate-500 text-sm font-medium">Total User</span>
            <strong class="text-3xl text-slate-800">{{ $totalUsers ?? 0 }}</strong>
        </div>
        <div class="w-12 h-12 bg-violet-100 text-violet-600 rounded-xl flex items-center justify-center">
            <i data-lucide="users" class="w-6 h-6"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6">
    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex flex-col h-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-slate-800">
                Statistik Peminjaman Bulanan
            </h3>
            <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-500 rounded-full">
                2025
            </span>
        </div>

        <div class="flex-1 relative">
            <canvas id="loanChart"></canvas>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('loanChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    // Data dari Laravel (AMAN dari error VS Code)
    const chartData = JSON.parse('{!! json_encode($chartData ?? []) !!}');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Pinjam',
                data: chartData,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.08)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#2563eb'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: '#f1f5f9' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

@endsection
