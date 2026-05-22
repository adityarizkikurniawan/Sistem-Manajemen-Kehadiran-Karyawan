<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Presensi Karyawan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- NAVBAR ATAS --}}
    <nav class="flex justify-between items-center p-4 bg-white shadow-sm sticky top-0 z-50">
        <a href="{{ route('home') }}" class="font-bold text-blue-600 uppercase tracking-wider text-sm">
            Presensi Perusahaan
        </a>

        <div class="flex items-center gap-4">
            @auth
                {{-- TOMBOL LOGOUT MUNCUL PAS LOGIN --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-red-500 border border-red-100 px-3 py-1.5 rounded-lg hover:bg-red-50 transition">
                        LOGOUT
                    </button>
                </form>
            @else
                @if(!Route::is('home') && !Route::is('login'))
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-blue-600">Masuk</a>
                @endif
            @endauth
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow pb-24 px-4 py-6"> 
        @yield('content')
    </main>

    {{-- MENU NAVIGASI BAWAH (MOBILE STYLE) --}}
    @auth
    <footer class="fixed bottom-0 w-full bg-white border-t border-gray-100 p-4 z-50 shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <div class="flex justify-around items-center max-w-md mx-auto">
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center transition {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] mt-1 font-bold uppercase">Dashboard</span>
            </a>
            
            <a href="{{ route('jadwal') }}"
                class="flex flex-col items-center transition {{ request()->routeIs('jadwal') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-[10px] mt-1 font-bold uppercase">Jadwal</span>
            </a>

            <a href="{{ route('izin') }}"
                class="flex flex-col items-center transition {{ request()->routeIs('izin') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[10px] mt-1 font-bold uppercase">Izin</span>
            </a>

            <a href="{{ route('profile') }}"
                class="flex flex-col items-center transition {{ request()->routeIs('profile') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-[10px] mt-1 font-bold uppercase">Profil</span>
            </a>
        </div>
    </footer>
    @endauth

</body>
</html>