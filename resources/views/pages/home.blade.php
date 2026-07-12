<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Portal Absensi Internal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 font-sans antialiased min-h-screen overflow-x-hidden">

    <div class="grid grid-cols-1 lg:grid-cols-12 min-h-screen">
        
        <div class="lg:col-span-5 flex flex-col justify-between p-8 md:p-12 lg:p-16 bg-slate-900">
            
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-slate-200 tracking-wider uppercase">SISTEM MANAGEMEN KEHADIRAN</span>
            </div>

            <div class="my-auto py-12 space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-mono font-bold text-blue-500" id="clock">00:00:00</h2>
                    <p class="text-sm md:text-base text-slate-400 font-medium tracking-wide">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="text-3xl font-extrabold text-slate-100 tracking-tight leading-tight">
                        Portal Absensi <br class="hidden md:inline">Internal Karyawan
                    </h2>
                    <p class="text-slate-400 text-sm md:text-base leading-relaxed max-w-md">
                        Selamat datang di presensi digital. Silakan autentikasi akun Anda untuk melakukan pencatatan kehadiran, memantau jadwal kerja, atau mengajukan izin secara real-time.
                    </p>
                </div>

                <div class="pt-2">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-2xl transition duration-300 transform hover:-translate-y-0.5 shadow-xl shadow-blue-600/20 w-full sm:w-auto text-center">
                            Masuk ke Akun
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 px-10 rounded-2xl transition duration-300 transform hover:-translate-y-0.5 shadow-xl shadow-emerald-600/20 w-full sm:w-auto text-center">
                            Lanjut ke Dashboard
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        </a>
                    @endguest
                </div>
            </div>

            <div class="text-xs text-slate-500 font-medium">
                PBL Team · IF-2MB-09
            </div>
        </div>

        <div class="hidden lg:block lg:col-span-7 relative bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-transparent to-transparent z-10"></div>
            
            <img class="w-full h-full object-cover opacity-60 filter grayscale-[20%] contrast-[110%]" 
                 src="https://www.polibatam.ac.id/wp-content/uploads/2023/02/DSC_3689-scaled.jpg" 
                 alt="Workspace Collaboration">

        </div>

    </div>
    <script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
    }
    setInterval(updateClock, 1000);
    updateClock();

    function getLocation() {
        const status = document.getElementById('statusLokasi');
        const locationInput = document.getElementById('locationInput');
        const btn = document.getElementById('btnAbsen');
        const btnText = document.getElementById('btnText');

        if (!navigator.geolocation) {
            status.textContent = "Browser tidak mendukung GPS";
            return;
        }

        btn.disabled = true;
        btnText.textContent = "MENCARI GPS...";
        status.textContent = "Menunggu koordinat... ⏳";

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                locationInput.value = lat + "," + long;
                status.textContent = "Lokasi Terkunci! ✅";
                document.getElementById('formAbsen').submit();
            },
            (error) => {
                btn.disabled = false;
                btnText.textContent = "CHECK IN";
                status.textContent = "Gagal: Berikan izin lokasi!";
                alert("Izin lokasi diperlukan untuk absen.");
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }
    </script>
</body>
</html>
