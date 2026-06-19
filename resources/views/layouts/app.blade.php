<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Presensi Perusahaan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#dbe0e9] font-sans antialiased text-slate-200"> <!-- Warna background sinkron dengan login -->

    <div class="min-h-screen flex flex-col">

        <!-- HEADER / NAVBAR ATAS (Gaya Minimalis Petronas) -->
        <header class="h-20 bg-[#0a1120]/80 backdrop-blur-md border-b border-white/5 flex items-center justify-between px-8 lg:px-12 sticky top-0 z-50">
            
            <!-- Logo & Brand -->
            <div class="flex items-center gap-4">
                <span class="text-sm font-bold tracking-[0.2em] text-white uppercase">SISTEM MANAJEMEN KEHADIRAN</span>
            </div>

            <!-- Menu Navigasi Tengah (Gantiin Sidebar) -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('dashboard') }}" 
                   class="text-xs font-bold tracking-widest transition {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                   DASHBOARD
                </a>
                <a href="{{ route('jadwal') }}" 
                    class="text-xs font-bold tracking-widest transition {{ request()->routeIs('jadwal') ? 'text-blue-400' : 'text-slate-400' }}">
                    JADWAL
                </a>
                <a href="{{ route('izin') }}" 
                   class="text-xs font-bold tracking-widest transition {{ request()->routeIs('izin') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                   IZIN
                </a>
                <a href="{{ route('profil.index') }}" 
                   class="text-xs font-bold tracking-widest transition {{ request()->routeIs('profil.index') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">
                   PROFIL
                </a>
            </nav>

            <!-- User Profile & Logout -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-bold text-white">@auth {{ Auth::user()->name }} @endauth</span>
                        <span class="text-[9px] font-black tracking-tighter text-blue-500 uppercase">@auth {{ Auth::user()->role }} @endauth</span>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 border border-white/10 flex items-center justify-center text-xs font-bold shadow-lg">
                        @auth {{ substr(Auth::user()->name, 0, 2) }} @endauth
                    </div>
                </div>

                <!-- Tombol Keluar Minimalis -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-slate-500 hover:text-red-400 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- KONTEN UTAMA (Tanpa pl-64 agar lebar maksimal) -->
        <main class="flex-1 pt-8">
            <div class="max-w-7xl mx-auto animate-fade-in">
                <!-- Info Tanggal Sederhana -->
                <div class="mb-8 flex items-center gap-2 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-[11px] font-bold tracking-widest uppercase">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                @yield('content')
            </div>
        </main>

        <!-- FOOTER (Mirip halaman login kamu) -->
        <footer class="py-8 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-12 text-[10px] text-slate-600 font-bold tracking-[0.3em] uppercase">
                PBL Team - IF-2MB-09
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>