<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JejakProduk - Dashboard UMKM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @endif
    <!-- Alpine.js for modals and interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F4F7F6; } /* Cooler gray/green bg */
        .sidebar-item.active { color: #10B981; font-weight: 700; }
        .sidebar-item.active svg { color: #10B981; }
        .sidebar-item:not(.active) { color: #64748B; transition: all 0.3s ease; }
        .sidebar-item:not(.active):hover { color: #10B981; transform: translateX(4px); }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="text-slate-800 antialiased h-screen overflow-hidden flex flex-col selection:bg-green-100 selection:text-green-900" x-data="{ sidebarOpen: false }">

    <!-- Top Navbar -->
    <header class="bg-white shadow-sm z-50 h-16 flex items-center justify-between flex-shrink-0 transition-all duration-300">
        <!-- Logo Area (Width of Sidebar) -->
        <div class="w-16 lg:w-64 flex-shrink-0 flex items-center justify-center lg:justify-start lg:pl-8 h-full border-r border-slate-100 transition-all duration-300">
            <div class="flex items-center gap-2">
                <div class="bg-green-500 text-white p-1.5 rounded-lg shadow-sm hover:scale-105 transition-transform duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                <span class="font-extrabold text-xl text-green-600 tracking-tight hidden lg:block">JejakProduk</span>
            </div>
        </div>

        <!-- Right Navbar -->
        <div class="flex-1 flex items-center justify-between px-4 lg:px-8">
            <!-- Mobile Menu Toggle & Search -->
            <div class="flex items-center gap-2 sm:gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-400 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <div class="hidden md:flex items-center gap-2 text-slate-400 focus-within:text-green-500 transition-colors bg-slate-50 px-3 py-1.5 rounded-xl border border-transparent focus-within:border-green-100 focus-within:bg-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Cari data..." class="bg-transparent border-none outline-none text-sm placeholder-slate-400 text-slate-700 w-48 lg:w-64 focus:ring-0">
                </div>
            </div>

            <!-- Profile & Icons -->
            <div class="flex items-center gap-4 lg:gap-6">
                <!-- User Profile (Avatar visible on mobile) -->
                <div class="flex items-center gap-2 sm:gap-3 border-r border-slate-200 pr-3 sm:pr-4 lg:pr-6 cursor-pointer group transition-opacity">
                    <img src="https://ui-avatars.com/api/?name=Admin+UMKM&background=10b981&color=fff" alt="Profile" class="w-8 h-8 rounded-full border border-green-200 group-hover:shadow-md transition-shadow">
                    <div class="hidden sm:flex items-center gap-1">
                        <span class="text-sm font-semibold text-slate-700 group-hover:text-green-600 transition-colors">Admin UMKM</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

                <!-- Icons -->
                <div class="flex items-center gap-3 text-slate-400">
                    <button class="hover:text-green-500 transition-colors hidden lg:block" title="Fullscreen"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg></button>
                    <button class="hover:text-green-500 transition-colors hidden sm:block" title="Messages"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></button>
                    <button class="hover:text-green-500 transition-colors relative" title="Notifications">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-green-500 rounded-full border border-white"></span>
                    </button>
                    <a href="{{ url('/') }}" class="p-1.5 sm:p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all ml-0 sm:ml-2 flex items-center justify-center" title="Kembali ke Halaman Utama">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 lg:hidden"
             style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed lg:static inset-y-0 left-0 w-64 bg-white border-r border-slate-100 flex flex-col flex-shrink-0 z-40 transform transition-transform duration-300 ease-in-out lg:translate-x-0 h-full overflow-y-auto">
            
            <!-- User Profile Snippet -->
            <div class="p-6 mb-2 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+UMKM&background=10b981&color=fff" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Admin UMKM</h3>
                        <p class="text-xs text-slate-500">Manager</p>
                    </div>
                </div>
                <div class="w-2.5 h-2.5 rounded-full bg-green-500 border-2 border-white shadow-sm flex-shrink-0" title="Online"></div>
                <!-- Close Mobile Menu -->
                <button @click="sidebarOpen = false" class="lg:hidden absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </div>
                    @if(request()->routeIs('admin.dashboard'))
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                    @endif
                </a>
                
                <a href="{{ route('admin.pos') }}" class="sidebar-item {{ request()->routeIs('admin.pos') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-200 mt-4 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Kasir POS
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:translate-x-1 group-hover:text-green-500 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                
                <a href="{{ route('admin.products') }}" class="sidebar-item {{ request()->routeIs('admin.products') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Produk
                    </div>
                </a>
                
                <a href="{{ route('admin.ingredients') }}" class="sidebar-item {{ request()->routeIs('admin.ingredients') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Bahan Baku
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:translate-x-1 group-hover:text-green-500 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.reports') }}" class="sidebar-item {{ request()->routeIs('admin.reports') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </div>
                </a>
            </nav>

            <!-- Actions & Categories -->
            <div class="px-4 pb-6 mt-4">
                <a href="{{ route('admin.products') }}" class="w-full bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2.5 rounded-lg transition-colors shadow-sm shadow-green-500/30 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk
                </a>
                
                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 mt-6 px-3">Kategori</h4>
                <div class="space-y-3 px-3">
                    <label class="flex items-center gap-3 text-sm text-slate-600 cursor-pointer group">
                        <div class="w-4 h-4 rounded-full border border-green-500 flex items-center justify-center group-hover:border-green-600">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        </div>
                        <span>Penjualan Lokal</span>
                    </label>
                    <label class="flex items-center gap-3 text-sm text-slate-600 cursor-pointer group">
                        <div class="w-4 h-4 rounded-full border border-teal-500 flex items-center justify-center group-hover:border-teal-600"></div>
                        <span>Pesanan Online</span>
                    </label>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto relative p-6 lg:p-8 w-full z-10">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ 
                duration: 700, 
                once: true, 
                offset: 30,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
