@extends('layouts.user')

@section('title', 'Peminjaman Alat')

@section('content')
<style>
    .flatpickr-day.holiday {
        background: #fee2e2 !important; /* bg-red-100 */
        color: #dc2626 !important;       /* text-red-600 */
        font-weight: bold !important;
        border-color: #fee2e2 !important;
    }
</style>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="bg-blue-600 p-8 text-white relative overflow-hidden">
            <div class="relative z-10 flex items-center gap-4">
                <div class="p-3 bg-white/20 rounded-2xl backdrop-blur-md">
                    <i data-lucide="test-tubes" class="w-8 h-8"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">Form Peminjaman</h2>
                    <p class="text-blue-100 text-sm opacity-90">Silakan isi detail peminjaman di bawah ini</p>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        </div>

        <form action="{{ route('user.loans.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <!-- Tanggal Section -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Tanggal Pinjam -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                        Tanggal Pinjam
                    </label>
                    <div class="relative group">
                        <input type="text" name="tanggal_pinjam" required placeholder="Pilih tanggal pinjam..."
                               class="w-full px-4 py-3 bg-slate-50 border-2 rounded-2xl outline-none transition-all duration-200 
                                      group-hover:bg-white focus:bg-white 
                                      @error('tanggal_pinjam') border-red-400 focus:ring-red-100 focus:border-red-500 @else border-slate-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @enderror">
                        @error('tanggal_pinjam')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal Kembali -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <i data-lucide="calendar-check" class="w-4 h-4 text-blue-500"></i>
                        Tanggal Kembali
                    </label>
                    <div class="relative group">
                        <input type="text" name="tanggal_kembali" required placeholder="Pilih tanggal kembali..."
                               class="w-full px-4 py-3 bg-slate-50 border-2 rounded-2xl outline-none transition-all duration-200 
                                      group-hover:bg-white focus:bg-white 
                                      @error('tanggal_kembali') border-red-400 focus:ring-red-100 focus:border-red-500 @else border-slate-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @enderror">
                        @error('tanggal_kembali')
                            <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Alat Selection -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <i data-lucide="microscope" class="w-4 h-4 text-blue-500"></i>
                    Pilih Alat Laboratorium
                </label>
                <div class="relative">
                    <select name="tool_id" required
                            class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none transition-all duration-200 
                                   appearance-none hover:bg-white focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        <option value="" disabled selected>Pilih alat...</option>
                        @foreach($tools as $t)
                            <option value="{{ $t->id }}" {{ (isset($tool) && $tool->id == $t->id) ? 'selected' : '' }}>
                                {{ $t->tool_name }} — Stok: {{ $t->stock }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </div>
                </div>
            </div>

            <!-- Jumlah -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <i data-lucide="package" class="w-4 h-4 text-blue-500"></i>
                    Jumlah Pinjam
                </label>
                <div class="relative group">
                    <input type="number" name="jumlah" min="1" required placeholder="0"
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none transition-all duration-200 
                                  hover:bg-white focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                </div>
            </div>

            <!-- Action Button -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 
                               transform active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-3 group">
                    <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    Kirim Pengajuan Peminjaman
                </button>
                <p class="text-center text-slate-400 text-xs mt-4">
                    Peminjaman akan melalui proses persetujuan oleh Laboran
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const holidayData = @json($holidayData);
        const holidayDates = Object.keys(holidayData);
        
        const config = {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: holidayDates,
            locale: {
                firstDayOfWeek: 1
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const date = dayElem.dateObj;
                const d = date.getDate();
                const m = date.getMonth() + 1;
                const y = date.getFullYear();
                const dateString = y + "-" + String(m).padStart(2, '0') + "-" + String(d).padStart(2, '0');

                if (holidayData[dateString]) {
                    dayElem.classList.add("holiday");
                    dayElem.title = holidayData[dateString];
                }
            }
        };

        if (typeof flatpickr === 'function') {
            flatpickr("input[name='tanggal_pinjam']", config);
            flatpickr("input[name='tanggal_kembali']", config);
        }
        
        // Refresh icons for new elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
