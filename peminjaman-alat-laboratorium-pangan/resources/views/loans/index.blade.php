@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<style>
    /* Header Style */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .header-title h2 { margin: 0; font-size: 22px; font-weight: 700; color: var(--text-main); }
    .header-title p { margin: 4px 0 0; color: var(--text-gray); font-size: 14px; }

    /* Table Styling */
    .table-card {
        background: var(--pure-white);
        border-radius: 12px;
        border: 1px solid var(--border-gray);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th { background: var(--sidebar-gray); padding: 16px; font-size: 12px; text-transform: uppercase; color: var(--text-gray); border-bottom: 1px solid var(--border-gray); }
    td { padding: 16px; border-bottom: 1px solid var(--border-gray); color: var(--text-main); font-size: 14px; }
    
    /* Badge & Tags */
    .badge { padding: 6px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; text-transform: uppercase; }
    .badge-aktif { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-kembali { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .tool-tag { display: inline-flex; align-items: center; background: var(--bg-gray); padding: 4px 10px; border-radius: 6px; margin: 2px; font-size: 12px; border: 1px solid var(--border-gray); }

    /* Action Buttons */
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 8px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; transition: 0.2s; }
    .btn-edit { color: var(--primary-blue); background: var(--light-blue); }
    .btn-delete { color: #ef4444; background: #fee2e2; }
</style>

<div class="page-header">
    <div class="header-title">
        <h2>Daftar Peminjaman Alat</h2>
        <p>Manajemen sirkulasi alat Laboratorium Pangan</p>
    </div>
    <a href="{{ route('loans.create') }}" class="btn-primary">
        <i data-lucide="plus" size="18"></i> Peminjaman Baru
    </a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Detail Alat</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</div>
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($loan->status) }}">
                            {{ $loan->status }}
                        </span>
                    </td>
                    <td>
                        @if($loan->details)
                            @foreach($loan->details as $detail)
                                <div class="tool-tag">
                                    {{ $detail->tool->tool_name ?? 'Alat' }} 
                                    <span style="margin-left:5px; font-weight:bold; color:var(--primary-blue)">x{{ $detail->quantity }}</span>
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                            
                            {{-- PERBAIKAN ROUTE EDIT --}}
                            <a href="{{ url('loans/'.$loan->id.'/edit') }}" class="btn-icon btn-edit" title="Edit">
                                <i data-lucide="edit-2" size="16"></i>
                            </a>

                            {{-- PERBAIKAN ROUTE DELETE --}}
                            <form action="{{ url('loans/'.$loan->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Hapus data ini?')">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: var(--text-gray);">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection