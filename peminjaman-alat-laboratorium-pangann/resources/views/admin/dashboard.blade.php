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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex flex-col h-[400px]">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-slate-800">Statistik Peminjaman Bulanan</h3>
            <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-500 rounded-full">2025</span>
        </div>
        <div class="flex-1 min-h-0 relative">
            <canvas id="loanChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
            <i data-lucide="zap" class="w-5 h-5 text-amber-500 fill-amber-500"></i>
            Menu Cepat
        </h3>
        <div class="space-y-3">
            <a href="{{ route('tools.create') }}" class="flex items-center gap-3 p-4 bg-slate-50 text-slate-700 rounded-xl font-semibold border border-transparent hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100 transition-all duration-200">
                <i data-lucide="plus-circle" class="w-5 h-5 opacity-70"></i>
                Tambah Alat Lab Baru
            </a>
            <a href="{{ route('admin.loans.index') }}" class="flex items-center gap-3 p-4 bg-slate-50 text-slate-700 rounded-xl font-semibold border border-transparent hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100 transition-all duration-200">
                <i data-lucide="file-plus" class="w-5 h-5 opacity-70"></i>
                Input Peminjaman Baru
            </a>
            <a href="{{ route('tools.index') }}" class="flex items-center gap-3 p-4 bg-slate-50 text-slate-700 rounded-xl font-semibold border border-transparent hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100 transition-all duration-200">
                <i data-lucide="search" class="w-5 h-5 opacity-70"></i>
                Cek Inventaris Alat
            </a>
            <a href="{{ route('admin.loans.index') }}" class="flex items-center gap-3 p-4 bg-slate-50 text-slate-700 rounded-xl font-semibold border border-transparent hover:bg-blue-50 hover:text-blue-600 hover:border-blue-100 transition-all duration-200">
                <i data-lucide="history" class="w-5 h-5 opacity-70"></i>
                Riwayat Peminjaman
            </a>
        </div>
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