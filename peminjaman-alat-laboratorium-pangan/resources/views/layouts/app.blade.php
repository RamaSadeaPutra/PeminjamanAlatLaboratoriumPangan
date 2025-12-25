<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px 30px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }

        .container {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #ecf0f1;
        }

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-warning {
            background: #f39c12;
            color: white;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h2>Peminjaman Alat Laboratorium Pangan</h2>
    <nav>
        <a href="{{ route('tools.index') }}">Data Alat</a>
        <a href="{{ route('loans.index') }}">Peminjaman</a>
    </nav>
</header>

<div class="container">
    @yield('content')
</div>

</body>
</html>
