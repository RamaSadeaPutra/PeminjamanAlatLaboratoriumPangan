@extends('layouts.user')

@section('title', 'Form Peminjaman Alat')

@section('content')
<div style="max-width: 600px; margin: 20px auto;">
    <div class="content-card" style="padding: 32px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #2563eb;">
                <i data-lucide="clipboard-list" style="width: 24px; height: 24px;"></i>
            </div>
            <div>
                <h2 style="font-size: 20px; font-weight: 700; margin: 0; color: #1e293b;">Form Peminjaman Alat</h2>
                <p style="margin: 4px 0 0; color: #64748b; font-size: 14px;">Silakan isi detail peminjaman di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('user.loans.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    Alat
                </label>
                <select name="tool_id" required style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: #f8fafc; cursor: default;">
                    @foreach($tools as $t)
                        <option value="{{ $t->id }}" {{ (isset($tool) && $tool->id == $t->id) ? 'selected' : '' }}>
                            {{ $t->tool_name }} (Tersedia: {{ $t->stock }})
                        </option>
                    @endforeach
                </select>
                @if(isset($tool))
                    <input type="hidden" name="tool_id" value="{{ $tool->id }}">
                @endif
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Tanggal Pinjam
                    </label>
                    <input type="date" name="tanggal_pinjam" required value="{{ date('Y-m-d') }}"
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                        Tanggal Kembali
                    </label>
                    <input type="date" name="tanggal_kembali" required
                           style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none;">
                </div>
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    Jumlah Alat
                </label>
                <input type="number" id="input-jumlah" name="jumlah" min="1" value="1" required
                       style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; text-align: left; -moz-appearance: textfield;">

                <style>
                    /* Hide native browser arrows (spinners) */
                    input[type=number]::-webkit-inner-spin-button, 
                    input[type=number]::-webkit-outer-spin-button { 
                        -webkit-appearance: none; 
                        margin: 0; 
                    }
                    input[type=number] {
                        -moz-appearance: textfield;
                    }
                    #input-jumlah:focus { border-color: #2563eb; }
                </style>
            </div>

            <script>
                // Ensure minimum value of 1
                document.getElementById('input-jumlah').addEventListener('input', function() {
                    let val = parseInt(this.value);
                    
                    // Handle empty or zero input during typing
                    if (this.value !== "" && (val < 1 || isNaN(val))) {
                        this.value = 1;
                    }
                });

                // Also check on blur to ensure no empty field
                document.getElementById('input-jumlah').addEventListener('blur', function() {
                    if (this.value === "" || isNaN(parseInt(this.value))) {
                        this.value = 1;
                    }
                });
            </script>

            <div style="display: flex; gap: 12px;">
                <a href="{{ route('user.tools.index') }}" class="btn-primary" style="background: #f1f5f9; color: #64748b; flex: 1; justify-content: center;">
                    Batal
                </a>
                <button type="submit" class="btn-primary" style="flex: 2; justify-content: center;">
                    <i data-lucide="check" style="width: 18px; height: 18px;"></i>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
@endsection

