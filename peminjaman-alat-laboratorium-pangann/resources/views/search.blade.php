@extends(auth()->user()->role === 'admin' ? 'layouts.app' : 'layouts.user')

@section('title', 'Hasil Pencarian Alat')

@section('content')
<style>
    /* Styling untuk kartu tabel */
    .table-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,.06);
    }

    .table-title {
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Styling tabel modern */
    .modern-table {
        width: 100%;
        border-collapse: collapse;
    }

    .modern-table th {
        text-align: left;
        font-size: 13px;
        text-transform: uppercase;
        color: #64748b;
        padding: 14px 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    .modern-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }

    .modern-table tr:hover {
        background: #f8fafc;
    }

    .font-bold {
        font-weight: 600;
    }

    /* Styling badge */
    .badge {
        padding: 4px 10px;
        font-size: 12px;
        border-radius: 999px;
        font-weight: 600;
    }

    .badge.good {
        background: #dcfce7;
        color: #166534;
    }

    .badge.bad {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-stock {
        background: #eff6ff;
        color: #1d4ed8;
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 12px;
    }

    /* Form pencarian di halaman hasil */
    .search-box {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .search-input {
        padding: 10px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        width: 300px;
        outline: none;
    }

    .search-input:focus {
        border-color: #2563eb;
    }

    .btn-search {
        background: #2563eb;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-search:hover {
        background: #1e40af;
    }
</style>

<div class="table-card">
    <div class="table-title">
        <span>Hasil Pencarian: "{{ $query }}"</span>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('tools.index') }}" style="font-size: 14px; text-decoration: none; color: #2563eb;">Kembali ke Manajemen</a>
        @else
            <a href="{{ route('user.tools.index') }}" style="font-size: 14px; text-decoration: none; color: #2563eb;">Kembali ke Daftar</a>
        @endif
    </div>

    <!-- Form pencarian ulang -->
    <form action="{{ route('search') }}" method="GET" class="search-box">
        <input type="text" name="query" class="search-input" placeholder="Cari alat..." value="{{ $query }}">
        <button type="submit" class="btn-search">Cari</button>
    </form>

    <table class="modern-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Lab</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tools as $tool)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-bold">{{ $tool->tool_name }}</td>
                    <td>{{ $tool->lab->name ?? $tool->lab->lab_name ?? '-' }}</td>
                    <td>{{ $tool->category->name ?? $tool->category->category_name ?? '-' }}</td>
                    <td>
                        <span class="badge-stock">{{ $tool->stock }}</span>
                    </td>
                    <td>
                        <span class="badge {{ in_array(strtolower($tool->condition), ['baik', 'bagus']) ? 'good' : 'bad' }}">
                           {{ $tool->condition }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                       @if(auth()->user()->role === 'admin')
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('tools.edit', $tool->id) }}" title="Edit" style="color: #2563eb; text-decoration: none;">
                                    <i data-lucide="edit-3" style="width: 18px; height: 18px;"></i>
                                </a>
                                <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')" style="background: none; border: none; color: #dc2626; cursor: pointer; padding: 0;">
                                        <i data-lucide="trash-2" style="width: 18px; height: 18px;"></i>
                                    </button>
                                </form>
                            </div>
                       @else
                           <a href="{{ route('user.loans.create', $tool->id) }}"
                              style="background: #2563eb; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px;">
                                Pinjam
                            </a>
                       @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                        Tidak ditemukan alat dengan keyword "{{ $query }}"
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
