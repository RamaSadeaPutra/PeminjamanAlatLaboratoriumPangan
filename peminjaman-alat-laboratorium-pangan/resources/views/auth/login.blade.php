<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peminjaman Alat Laboratorium</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            
            /* BACKGROUND GAMBAR LAB - Menggunakan Pexels untuk stabilitas */
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                        url('https://images.pexels.com/photos/2280571/pexels-photo-2280571.jpeg?auto=compress&cs=tinysrgb&w=1600');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .card {
            background: rgba(255, 255, 255, 0.95); /* Semi transparan */
            backdrop-filter: blur(10px); /* Efek blur di belakang kartu */
            padding: 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            background: #2563eb; 
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.4;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            width: 18px;
            height: 18px;
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .error-box {
            background: #fff1f2;
            color: #be123c;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #ffe4e6;
            text-align: left;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            font-size: 13px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <div class="brand-icon">
            <i data-lucide="flask-conical" size="40"></i>
        </div>
        <h2>Peminjaman<br>Alat Laboratorium</h2>
        <p>StarTech</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <i data-lucide="alert-circle" size="16"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <i data-lucide="mail"></i>
                <input type="email" id="email" name="email" placeholder="contoh@lab.com" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <i data-lucide="lock"></i>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit">
            <i data-lucide="log-in" size="18"></i>
            Login
        </button>
    </form>

    <div class="footer">
        &copy; 2025 Sistem Informasi Laboratorium
    </div>
</div>

<script>
    // Inisialisasi ikon Lucide
    lucide.createIcons();
</script>

</body>
</html>