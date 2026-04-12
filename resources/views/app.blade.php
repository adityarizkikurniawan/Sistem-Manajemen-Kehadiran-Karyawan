<!DOCTYPE html>
<html lang="en">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="#" class="flex items-center">
                <span class="self-center text-xl font-bold whitespace-nowrap dark:text-white text-blue-600">PBL-Team
                    <span class="text-gray-900 dark:text-gray-100">Presensi</span></span>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="#"
                    class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 focus:outline-none">Login</a>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li><a href="#"
                            class="block py-2 pr-4 pl-3 text-blue-700 border-b border-gray-100 lg:border-0 lg:p-0">Dashboard</a>
                    </li>
                    <li><a href="#"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Karyawan</a>
                    </li>
                    <li><a href="#"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="p-8 mx-auto max-w-screen-xl">
        <div class="p-10 bg-white border border-gray-200 rounded-xl shadow-sm">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Selamat Datang di Sistem Presensi</h2>
            <p class="text-gray-600 mb-6">Silakan kelola data kehadiran karyawan Anda dengan mudah dan cepat melalui
                dashboard ini.</p>

            <div class="flex gap-4">
                <button
                    class="px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                    Cek Kehadiran Hari Ini
                </button>
                <button
                    class="px-5 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                    Unduh Rekap (Excel)
                </button>
            </div>
        </div>
    </main>

    <footer class="p-4 bg-white border-t border-gray-200 mt-10 dark:bg-gray-800">
        <p class="text-center text-gray-500 text-sm">© 2026 PBL Team - Sistem Manajemen Kehadiran Karyawan.</p>
    </footer>

</body>


</html>