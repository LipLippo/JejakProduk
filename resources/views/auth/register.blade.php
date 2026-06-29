<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - JejakProduk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @endif
    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-slide-up { animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in { animation: fadeIn 1.5s ease-out forwards; opacity: 0; }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
    </style>
</head>
<body class="bg-slate-200 text-slate-800 selection:bg-green-100 selection:text-green-900 min-h-screen relative overflow-hidden flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    <!-- Back Button -->
    <div class="absolute top-6 left-6 sm:top-8 sm:left-8 z-20 animate-fade-in">
        <a href="/" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 transition-colors bg-white/80 backdrop-blur-md px-4 py-2.5 rounded-full shadow-sm border border-slate-200 font-semibold text-sm hover:shadow-md hover:-translate-y-0.5 transform duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>
    <!-- Fluid Background -->
    <div class="absolute inset-0 z-0 flex items-center justify-center pointer-events-none animate-fade-in">
        <div class="absolute top-[10%] left-[20%] w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-[60px] opacity-60 animate-blob"></div>
        <div class="absolute top-[20%] right-[20%] w-80 h-80 bg-emerald-200 rounded-full mix-blend-multiply filter blur-[60px] opacity-60 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[20%] left-[30%] w-96 h-96 bg-teal-100 rounded-full mix-blend-multiply filter blur-[60px] opacity-60 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Auth Card -->
    <div class="relative z-10 sm:mx-auto sm:w-full sm:max-w-md animate-slide-up">
        <div class="bg-white py-10 px-4 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] border border-slate-100 sm:rounded-3xl sm:px-10">
            
            <div class="flex justify-center items-center gap-2 mb-8 cursor-pointer animate-slide-up delay-100" onclick="window.location.href='/'">
                <div class="bg-green-500 text-white p-1.5 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-800">JejakProduk</span>
            </div>

            <div class="text-center mb-8 animate-slide-up delay-200">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Akun Baru</h2>
                <p class="text-sm text-slate-500 mt-2">Mulai transparansi produk Anda sekarang.</p>
            </div>

            <form class="space-y-5 animate-slide-up delay-300" action="/register" method="POST">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700">Nama Lengkap / Bisnis</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm transition">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm transition">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 6 karakter" required class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm transition">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-xl bg-green-500 px-3 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition hover:-translate-y-0.5">Daftar Sekarang</button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-slate-600 animate-slide-up delay-400">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-green-600 hover:text-green-500 transition">Masuk di sini.</a>
            </div>
        </div>
    </div>
</body>
</html>
