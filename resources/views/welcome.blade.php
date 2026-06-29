@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div data-aos="fade-right">
                <div class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-semibold mb-6 border border-green-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Untuk UMKM Indonesia
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-[4rem] font-extrabold tracking-tight text-slate-900 leading-[1.1] mb-6">
                    Transparansi Rantai<br>Pasok<br>
                    <span class="text-green-500">untuk UMKM Indonesia.</span>
                </h1>
                
                <p class="text-lg text-slate-600 mb-8 max-w-lg leading-relaxed">
                    Setiap produk Anda mendapat jejak digital yang dicatat secara transparan dan tidak dapat diubah — cukup dengan scan QR code.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3.5 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                        Daftarkan Produk Anda Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#" class="bg-white hover:bg-slate-50 text-slate-700 font-semibold px-6 py-3.5 rounded-xl transition border border-slate-200 shadow-sm flex items-center justify-center">
                        Lihat Cara Kerja
                    </a>
                </div>
            </div>
            
            <!-- Image -->
            <div class="relative" data-aos="fade-left" data-aos-delay="200">
                <div class="absolute inset-0 bg-green-200 blur-3xl opacity-30 rounded-full"></div>
                <img src="{{ asset('images/hero-image.png') }}" alt="Ilustrasi Kopi dan QR Code" class="relative z-10 w-full h-auto rounded-3xl shadow-xl border border-slate-100 object-cover" onerror="this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Image+Not+Found'">
            </div>
        </div>
    </section>

    <!-- Urgensi Section -->
    <section class="bg-[#FFF5ED] py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-aos="fade-up">
                <div class="inline-flex items-center gap-1.5 bg-white text-orange-500 px-3 py-1 rounded-full text-sm font-semibold mb-6 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Urgensi
                </div>
                
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Konsumen Indonesia kehilangan<br>kepercayaan</h2>
                <p class="text-lg text-slate-600 mb-12 max-w-2xl mx-auto">Produk UMKM yang luar biasa sering kalah karena tidak ada cara membuktikan keasliannya.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-extrabold text-orange-500 mb-4">65%+</div>
                    <p class="text-slate-600 font-medium">konsumen Indonesia pernah menerima produk UMKM yang tidak sesuai klaim.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-extrabold text-orange-500 mb-4">Miliaran</div>
                    <p class="text-slate-600 font-medium">rupiah kerugian UMKM setiap tahun akibat pemalsuan produk.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-extrabold text-orange-500 mb-4">0</div>
                    <p class="text-slate-600 font-medium">cara mudah bagi konsumen untuk memverifikasi keaslian produk yang mereka beli.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Solusi Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <div class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-semibold mb-6 border border-green-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Solusi
            </div>
            
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight leading-tight">JejakProduk — Transparansi Rantai Pasok untuk UMKM Indonesia.</h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Setiap produk mendapat <span class="font-bold text-slate-800">jejak digital</span> yang dicatat secara transparan dan permanen. Konsumen cukup memindai QR code untuk melihat seluruh perjalanan produk — dari bahan baku sampai ke tangan mereka.<br><br>
                Tidak perlu daftar akun. Tidak ada rekaman yang bisa diubah.
            </p>
        </div>
    </section>

    <!-- Comparison Table Section -->
    <section class="pb-24 bg-white overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-max">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">
                                <th class="py-6 px-8 font-bold text-slate-800 w-1/3 uppercase tracking-wider text-sm">
                                    Aspek
                                </th>
                                <th class="py-6 px-8 font-bold text-slate-500 w-1/3 uppercase tracking-wider text-sm">
                                    Sistem Lama (Manual)
                                </th>
                                <th class="py-6 px-8 font-bold text-green-700 bg-green-50 border-b-2 border-green-500 w-1/3 uppercase tracking-wider text-sm relative shadow-inner">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        JejakProduk
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-base">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="py-5 px-8 font-semibold text-slate-800">Bukti keaslian produk</td>
                                <td class="py-5 px-8 text-slate-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span>Tidak ada atau mudah dipalsukan</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 bg-green-50/30">
                                    <div class="flex items-center gap-3 text-green-800 font-medium">
                                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 shadow-sm border border-green-200">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span>QR code terverifikasi digital</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="py-5 px-8 font-semibold text-slate-800">Akses informasi produk</td>
                                <td class="py-5 px-8 text-slate-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span>Hanya dari mulut ke mulut</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 bg-green-50/30">
                                    <div class="flex items-center gap-3 text-green-800 font-medium">
                                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 shadow-sm border border-green-200">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span>Transparan, bisa diakses siapapun</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="py-5 px-8 font-semibold text-slate-800">Biaya implementasi</td>
                                <td class="py-5 px-8 text-slate-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span>Cetak dokumen, membutuhkan biaya</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 bg-green-50/30">
                                    <div class="flex items-center gap-3 text-green-800 font-medium">
                                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 shadow-sm border border-green-200">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span>Gratis, cukup menggunakan smartphone</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="py-5 px-8 font-semibold text-slate-800">Kemudahan konsumen</td>
                                <td class="py-5 px-8 text-slate-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span>Harus tanya langsung ke penjual</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 bg-green-50/30">
                                    <div class="flex items-center gap-3 text-green-800 font-medium">
                                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 shadow-sm border border-green-200">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span>Scan QR, langsung tahu</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 5 -->
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="py-5 px-8 font-semibold text-slate-800 rounded-bl-3xl">Risiko pemalsuan</td>
                                <td class="py-5 px-8 text-slate-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                        <span>Sangat tinggi</span>
                                    </div>
                                </td>
                                <td class="py-5 px-8 bg-green-50/30 rounded-br-3xl">
                                    <div class="flex items-center gap-3 text-green-800 font-medium">
                                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 shadow-sm border border-green-200">
                                            <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span>Sangat rendah, data tidak bisa diubah</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja & Fitur Utama Section -->
    <section class="bg-slate-50 py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Cara Kerja -->
            <div class="mb-24 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-12 tracking-tight" data-aos="fade-up">Bagaimana Cara Kerjanya?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <!-- Step 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 transition-transform hover:-translate-y-1" data-aos="fade-right" data-aos-delay="100">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <div class="text-green-500 font-semibold text-sm mb-2">Langkah 1</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Daftarkan Produk</h3>
                        <p class="text-slate-600">UMKM mendaftarkan produk dan langsung mendapat QR code unik.</p>
                    </div>
                    <!-- Step 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 transition-transform hover:-translate-y-1" data-aos="fade-right" data-aos-delay="200">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div class="text-green-500 font-semibold text-sm mb-2">Langkah 2</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Catat Setiap Tahap</h3>
                        <p class="text-slate-600">Setiap aktor rantai pasok mencatat tahapan produksi secara real-time.</p>
                    </div>
                    <!-- Step 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 transition-transform hover:-translate-y-1" data-aos="fade-right" data-aos-delay="300">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="text-green-500 font-semibold text-sm mb-2">Langkah 3</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Konsumen Verifikasi</h3>
                        <p class="text-slate-600">Konsumen scan QR dan melihat seluruh perjalanan produk secara transparan.</p>
                    </div>
                </div>
            </div>
            
            <!-- Fitur Utama -->
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-12 tracking-tight" data-aos="fade-up">Fitur Utama</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">
                    <!-- Fitur 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">QR Code Otomatis</h3>
                        <p class="text-slate-600 text-sm">Setiap produk mendapat QR code unik yang bisa diunduh dan dicetak.</p>
                    </div>
                    <!-- Fitur 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Timeline Rantai Pasok</h3>
                        <p class="text-slate-600 text-sm">Rekaman perjalanan produk dari hulu ke hilir, mudah dibaca.</p>
                    </div>
                    <!-- Fitur 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Dashboard UMKM</h3>
                        <p class="text-slate-600 text-sm">Kelola semua produk dan pantau status dalam satu tempat.</p>
                    </div>
                    <!-- Fitur 4 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Verifikasi Publik Tanpa Login</h3>
                        <p class="text-slate-600 text-sm">Konsumen cukup scan QR — tidak perlu daftar akun.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-green-500 py-24 text-center overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight" data-aos="fade-up">Siap memberi jejak digital pada produk Anda?</h2>
            <p class="text-green-50 text-lg mb-10" data-aos="fade-up" data-aos-delay="100">Mulai gratis. Tanpa wallet, tanpa token, tanpa ribet.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-white text-green-600 font-bold px-8 py-4 rounded-xl hover:bg-slate-50 transition shadow-sm gap-2" data-aos="zoom-in" data-aos-delay="200">
                Daftarkan Produk Anda Sekarang
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

@endsection
