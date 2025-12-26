<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Peminjaman Alat Laboratorium</title>

    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="login-page">

    <div class="login-card">
        <div class="brand-icon-wrapper">
            <i data-lucide="flask-conical" class="w-8 h-8"></i>
        </div>

        <h2 class="login-title">
            PEMINJAMAN<br>ALAT LABORATORIUM
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

        <div class="login-footer">
            © 2025 Sistem Informasi Laboratorium
        </div>
    </div>

    <!-- SCRIPT -->
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
    </script>
</body>
</html>
