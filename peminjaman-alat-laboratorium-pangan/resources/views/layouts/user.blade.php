<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Lab System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-gradient-custom {
            background: linear-gradient(135deg, #62b1a1 0%, #a3e635 100%);
        }
        .sidebar-active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #a3e635;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">

    <aside class="w-64 bg-[#1a222b] text-white flex flex-col">
        <div class="p-6 text-2xl font-bold italic text-[#a3e635]">Lab-Tools</div>
        <nav class="flex-1 px-4 space-y-2 mt-4">
            <a href="#" class="sidebar-active flex items-center p-3 gap-3 rounded-lg text-white">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="#" class="flex items-center p-3 gap-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
                <i class="fas fa-microscope"></i> Katalog Alat
            </a>
            <a href="#" class="flex items-center p-3 gap-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
                <i class="fas fa-exchange-alt"></i> Peminjaman Saya
            </a>
            <a href="#" class="flex items-center p-3 gap-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">
                <i class="fas fa-user"></i> Profil
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <a href="#" class="flex items-center p-3 gap-3 text-red-400 hover:bg-gray-800 rounded-lg">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto bg-gradient-custom">
        <header class="flex justify-between items-center p-6 text-white">
            <div class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full flex items-center gap-2">
                <span class="font-semibold uppercase tracking-wider text-sm">Dashboard User</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="font-medium">Welcome, Ahmad Rizki</span>
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-teal-600">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>

        <div class="p-6">
            @yield('content')
        </div>
    </main>

</body>
</html>