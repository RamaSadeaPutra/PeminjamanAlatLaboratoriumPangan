<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Peminjaman Alat Laboratorium Teknologi Pangan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="login-page">

    <div class="login-card">
        <div class="brand-icon-wrapper">
            <i data-lucide="flask-conical" class="w-8 h-8"></i>
        </div>

        <h2 class="login-title">
            PEMINJAMAN ALAT <br> LABORATORIUM TEKNOLOGI PANGAN
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="login-input-group">
                <label class="login-label">Alamat Email</label>
                <div class="input-container">
                    <i data-lucide="mail" class="input-icon"></i>
                    <input type="email"
                           name="email"
                           class="login-input"
                           placeholder="contoh@lab.com"
                           required autofocus>
                </div>
            </div>

            <!-- PASSWORD -->
                    <div class="login-input-group">
            <label class="login-label">Password</label>

            <div class="input-container">
                <i data-lucide="lock" class="input-icon"></i>

                <input type="password"
                    id="password"
                    name="password"
                    class="login-input pr-14"
                    placeholder="••••••••"
                    required>

                <!-- ICON MATA -->
                <button type="button"
                        class="password-toggle"
                        onclick="togglePassword()">
                    <i data-lucide="eye" id="eyeIcon" class="w-5 h-5"></i>
                </button>
            </div>
        </div>


            <!-- BUTTON -->
            <button type="submit" class="login-button">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                <span>Login</span>
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Daftar disini
                </a>
            </p>
        </div>

        <div class="login-footer">
            © 2025 Sistem Informasi Laboratorium
        </div>
    </div>

    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.setAttribute("data-lucide", "eye-off");
            } else {
                input.type = "password";
                icon.setAttribute("data-lucide", "eye");
            }

            lucide.createIcons();
        }

        lucide.createIcons();

        // SweetAlert2 Popup
   const statusMessage = "{{ session('status') ?? '' }}";

    if (statusMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: statusMessage,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
    </script>
</body>
</html>
