<<<<<<< HEAD
@extends('layouts.user')
=======
@extends('layouts.app')
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033

@section('title', 'Peminjaman Alat')

@section('content')
<div class="card">
    <h3>Peminjaman Alat</h3>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <label>Tanggal Pinjam</label><br>
        <input type="date" name="loan_date" required><br><br>

        <label>Tanggal Kembali</label><br>
        <input type="date" name="return_date" required><br><br>

        <label>Alat</label><br>
        <select name="tool_id" required>
            @foreach($tools as $tool)
                <option value="{{ $tool->id }}">
                    {{ $tool->tool_name }} (stok: {{ $tool->stock }})
                </option>
            @endforeach
        </select><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="quantity" min="1" required><br><br>

        <button class="btn btn-primary">Pinjam</button>
    </form>
</div>
@endsection
