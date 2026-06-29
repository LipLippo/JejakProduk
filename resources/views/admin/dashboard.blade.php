@extends('layouts.admin')

@section('content')

<!-- Top Banner -->
<div class="bg-gradient-to-r from-slate-100 to-slate-200 rounded-xl p-4 mb-8 flex flex-col sm:flex-row items-center justify-between shadow-sm border border-slate-200" data-aos="fade-down">
    <p class="text-slate-600 text-sm font-medium mb-3 sm:mb-0">
        Selamat datang di versi terbaru Dashboard JejakProduk. Nikmati pengalaman mengelola UMKM yang lebih baik.
    </p>
    <div class="flex items-center gap-3">
        <button class="bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg border border-slate-200 transition-colors shadow-sm">
            Pelajari Fitur Baru
        </button>
        <button class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors shadow-sm shadow-green-500/30">
            Tingkatkan ke Pro
        </button>
        <button class="text-slate-400 hover:text-slate-600 ml-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>

<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6" data-aos="fade-right">
    <div class="flex items-center gap-3">
        <div class="bg-green-100 text-green-600 p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
    </div>
    <div class="flex items-center gap-2 text-slate-500 mt-3 sm:mt-0 cursor-pointer hover:text-slate-800 transition-colors">
        <span class="text-sm font-medium">Ringkasan</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card 1: Emerald/Green -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-400 to-green-500 rounded-xl p-6 text-white shadow-lg shadow-green-500/20 hover:-translate-y-1 hover:shadow-xl hover:shadow-green-500/30 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
        <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute right-0 bottom-0 w-32 h-32 bg-white/10 rounded-full -mr-8 -mb-16 transition-transform duration-500 delay-75 group-hover:scale-110"></div>
        
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-green-50 font-medium text-sm mb-1">Total Pendapatan</p>
                <h3 class="text-3xl font-bold tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
            <div class="text-white/80">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
        </div>
        <div class="relative z-10 mt-6">
            <p class="text-sm font-medium text-green-50">Meningkat sebesar 15%</p>
        </div>
    </div>
    
    <!-- Card 2: Teal -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-teal-400 to-emerald-500 rounded-xl p-6 text-white shadow-lg shadow-teal-500/20 hover:-translate-y-1 hover:shadow-xl hover:shadow-teal-500/30 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute right-0 bottom-0 w-32 h-32 bg-white/10 rounded-full -mr-8 -mb-16 transition-transform duration-500 delay-75 group-hover:scale-110"></div>
        
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-teal-50 font-medium text-sm mb-1">Total Pesanan</p>
                <h3 class="text-3xl font-bold tracking-tight">{{ number_format($totalOrders, 0, ',', '.') }}</h3>
            </div>
            <div class="text-white/80">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
        <div class="relative z-10 mt-6">
            <p class="text-sm font-medium text-teal-50">Menurun sebesar 2%</p>
        </div>
    </div>
    
    <!-- Card 3: Cyan -->
    <div class="group relative overflow-hidden bg-gradient-to-br from-cyan-400 to-teal-500 rounded-xl p-6 text-white shadow-lg shadow-cyan-500/20 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/30 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
        <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute right-0 bottom-0 w-32 h-32 bg-white/10 rounded-full -mr-8 -mb-16 transition-transform duration-500 delay-75 group-hover:scale-110"></div>
        
        <div class="relative z-10 flex justify-between items-start">
            <div>
                <p class="text-cyan-50 font-medium text-sm mb-1">Pengunjung Online</p>
                <h3 class="text-3xl font-bold tracking-tight">18</h3>
            </div>
            <div class="text-white/80">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
        <div class="relative z-10 mt-6">
            <p class="text-sm font-medium text-cyan-50">Meningkat sebesar 5%</p>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="400">
    <!-- Bar Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex flex-col">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-base font-bold text-slate-800">Statistik Kunjungan & Penjualan</h3>
            <div class="flex items-center gap-4 text-xs font-semibold">
                <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-green-400"></span>Kunjungan</div>
                <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-teal-400"></span>Penjualan</div>
            </div>
        </div>
        
        <!-- CSS Mock Bar Chart -->
        <div class="flex-1 min-h-[250px] relative mt-auto flex items-end justify-between px-2 pb-6 border-b border-slate-100">
            <!-- Grid Lines -->
            <div class="absolute inset-0 flex flex-col justify-between pb-6 pointer-events-none">
                <div class="w-full h-px bg-slate-100"></div>
                <div class="w-full h-px bg-slate-100"></div>
                <div class="w-full h-px bg-slate-100"></div>
                <div class="w-full h-px bg-slate-100"></div>
                <div class="w-full h-px bg-transparent"></div>
            </div>
            
            <!-- Bars (Mon-Sun) -->
            <div class="relative z-10 flex gap-1 items-end h-[80%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[60%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[40%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[90%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[75%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[50%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[60%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[80%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[45%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[100%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[100%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[85%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[70%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[50%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[30%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[85%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[90%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[70%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            <div class="relative z-10 flex gap-1 items-end h-[50%] group">
                <div class="w-2 sm:w-3 bg-green-400 rounded-t-sm h-[70%] group-hover:opacity-80 transition-opacity"></div>
                <div class="w-2 sm:w-3 bg-teal-400 rounded-t-sm h-[60%] group-hover:opacity-80 transition-opacity"></div>
            </div>
            
            <!-- X Axis Labels -->
            <div class="absolute bottom-0 left-0 right-0 flex justify-between px-2 text-[10px] sm:text-xs text-slate-400 font-semibold pt-2">
                <span>Sen</span>
                <span>Sel</span>
                <span>Rab</span>
                <span>Kam</span>
                <span>Jum</span>
                <span>Sab</span>
                <span>Min</span>
            </div>
        </div>
    </div>
    
    <!-- Donut Chart -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex flex-col">
        <h3 class="text-base font-bold text-slate-800 mb-6">Sumber Trafik</h3>
        
        <div class="flex-1 flex flex-col items-center justify-center">
            <!-- CSS Mock Donut Chart -->
            <div class="relative w-48 h-48 rounded-full mb-8" style="background: conic-gradient(#34d399 0% 45%, #2dd4bf 45% 75%, #0ea5e9 75% 100%);">
                <!-- Inner Circle for Donut effect -->
                <div class="absolute inset-4 bg-white rounded-full shadow-[inset_0px_2px_4px_rgba(0,0,0,0.05)]"></div>
            </div>
            
            <div class="w-full space-y-3">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2 text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-green-400"></span>
                        Penelusuran Organik
                    </div>
                    <span class="font-bold text-slate-800">45%</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2 text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-teal-400"></span>
                        Trafik Langsung
                    </div>
                    <span class="font-bold text-slate-800">30%</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2 text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-sky-500"></span>
                        Sosial Media
                    </div>
                    <span class="font-bold text-slate-800">25%</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
