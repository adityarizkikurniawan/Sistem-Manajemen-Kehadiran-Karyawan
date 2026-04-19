<nav class="bg-white border-b border-gray-100 shadow-sm mb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-blue-600 font-bold text-xl tracking-tight">Presensi Perusahaan</span>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-900 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition">
                        Dashboard
                    </a>
                    <a href="{{ route('jadwal') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition">
                        Jadwal Kerja
                    </a>
                    <a href="{{ route('izin') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition">
                        Pengajuan Izin
                    </a>
                    <a href="{{ route('profile') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition">
                        Profil Saya
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <div class="ml-3 relative">
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-700">Karyawan User</span>
                        <a href="{{ route('login') }}"
                            class="text-sm text-red-600 hover:text-red-800 font-semibold">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>