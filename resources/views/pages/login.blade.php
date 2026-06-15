<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Portal Absensi Internal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 font-sans antialiased min-h-screen overflow-x-hidden">

    <div class="grid grid-cols-1 lg:grid-cols-12 min-h-screen">
        
        <div class="lg:col-span-5 flex flex-col justify-between p-8 md:p-12 lg:p-16 bg-slate-900">
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-slate-200 tracking-wider uppercase">SISTEM MANAGEMEN KEHADIRAN</span>
                </div>
            </div>

            <div class="my-auto py-12 max-w-md w-full mx-auto space-y-8">
                <div class="space-y-2">
                    <h2 class="text-3xl font-extrabold text-slate-100 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-400 text-sm">Silakan masukkan akun Anda untuk mengakses sistem presensi.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-300">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                            </span>
                            <input type="email" name="email" id="email" required placeholder="nama@perusahaan.com"
                                   class="w-full bg-slate-950/50 border border-slate-800 focus:border-blue-500 rounded-2xl py-3.5 pl-12 pr-4 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition">
                        </div>
                        @error('email')
                            <span class="text-xs font-semibold text-red-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-xs font-bold uppercase tracking-wider text-slate-300">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" name="password" id="password" required placeholder="••••••••"
                                   class="w-full bg-slate-950/50 border border-slate-800 focus:border-blue-500 rounded-2xl py-3.5 pl-12 pr-4 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition">
                        </div>
                        @error('password')
                            <span class="text-xs font-semibold text-red-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-2xl transition duration-300 transform hover:-translate-y-0.5 shadow-xl shadow-blue-600/20 text-center text-sm mt-2">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

            <div class="text-xs text-slate-500 font-medium">
                PBL Team · IF-2MB-09
            </div>
        </div>

        <div class="hidden lg:block lg:col-span-7 relative bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-transparent to-transparent z-10"></div>
            
            <img class="w-full h-full object-cover opacity-40 filter grayscale-[30%] contrast-[115%]" 
                 src="https://www.polibatam.ac.id/wp-content/uploads/2023/02/DSC_3734-scaled.jpg" 
                 alt="Secure Dashboard Infrastructure">

        </div>

    </div>

</body>
</html>