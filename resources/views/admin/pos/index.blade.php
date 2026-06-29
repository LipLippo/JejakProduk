@extends('layouts.admin')

@section('content')
<div class="flex flex-col lg:flex-row h-auto min-h-[calc(100vh-4rem)] lg:-m-8 relative z-10" data-aos="fade-in" x-data="{
    showCategoryModal: false, 
    newCategoryName: '', 
    newCategoryType: 'Makanan', 
    cart: [],
    activeFilter: 'Semua',
    paymentMethod: 'Cash',
    paymentAmount: 0,
    get totalCart() { return this.cart.reduce((s,i)=>s+i.total,0); },
    get changeAmount() { return this.paymentAmount > this.totalCart ? this.paymentAmount - this.totalCart : 0; },
    addToCart(product){ 
        const index = this.cart.findIndex(i=>i.name===product.name); 
        if(index > -1){ 
            this.cart[index].qty++; 
            this.cart[index].total += product.price; 
        } else { 
            this.cart.push({name: product.name, price: product.price, qty: 1, total: product.price}); 
        } 
    },
    submitCheckout() {
        if (this.cart.length === 0) { alert('Keranjang masih kosong!'); return; }
        if (this.paymentMethod === 'Cash' && this.paymentAmount < this.totalCart) {
            alert('Uang yang dibayar kurang dari total belanja!'); return;
        }
        document.getElementById('checkoutForm').submit();
    }
}">
    
    <!-- Left Area: Menu -->
    <div class="flex-1 lg:p-8 p-4 overflow-y-auto bg-slate-50/50">
        <div class="mb-8 flex flex-col sm:flex-row justify-between sm:items-end gap-4" data-aos="fade-down" data-aos-delay="100">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Kasir UMKM</h1>
                <p class="text-base text-slate-500 mt-1">Pilih produk untuk ditambahkan ke keranjang belanja</p>
            </div>
            <button @click="showCategoryModal=true" class="px-5 py-2.5 rounded-xl bg-green-500 text-white font-bold text-sm shadow-lg shadow-green-500/30 hover:bg-green-600 hover:-translate-y-0.5 hover:shadow-green-500/40 transition-all active:scale-95 flex items-center justify-center gap-2 group">
                <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kategori
            </button>
        </div>
        
        <!-- Filters -->
        <div class="flex flex-wrap gap-3 mb-8" data-aos="fade-right" data-aos-delay="200">
            <button @click="activeFilter = 'Semua'" :class="activeFilter === 'Semua' ? 'bg-slate-900 text-white shadow-[0_4px_15px_rgba(0,0,0,0.15)]' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100 shadow-sm'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all hover:-translate-y-0.5">Semua</button>
            <button @click="activeFilter = 'Minuman'" :class="activeFilter === 'Minuman' ? 'bg-slate-900 text-white shadow-[0_4px_15px_rgba(0,0,0,0.15)]' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100 shadow-sm'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all hover:-translate-y-0.5">Minuman</button>
            <button @click="activeFilter = 'Makanan'" :class="activeFilter === 'Makanan' ? 'bg-slate-900 text-white shadow-[0_4px_15px_rgba(0,0,0,0.15)]' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100 shadow-sm'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all hover:-translate-y-0.5">Makanan</button>
            <button @click="activeFilter = 'Topping'" :class="activeFilter === 'Topping' ? 'bg-slate-900 text-white shadow-[0_4px_15px_rgba(0,0,0,0.15)]' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-100 shadow-sm'" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all hover:-translate-y-0.5">Topping</button>
        </div>
        
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8 lg:mb-0" data-aos="fade-up" data-aos-delay="300">
            @forelse($products as $prod)
            <!-- Card -->
            <div x-show="activeFilter === 'Semua' || '{{ $prod->category->name }}'.includes(activeFilter)" class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] cursor-pointer hover:shadow-[0_8px_30px_rgb(16,185,129,0.1)] transition-all duration-300 hover:border-{{ $prod->avatar_color ?? 'green' }}-500/30 hover:-translate-y-1 group" @click="addToCart({name: '{{ addslashes($prod->name) }}', price: {{ $prod->price }}})">
                <div class="w-14 h-14 rounded-2xl bg-{{ $prod->avatar_color ?? 'green' }}-50 text-{{ $prod->avatar_color ?? 'green' }}-500 flex items-center justify-center font-extrabold text-xl mb-5 group-hover:scale-110 transition-transform">{{ $prod->initials }}</div>
                <p class="text-[11px] font-bold text-slate-400 mb-1 uppercase tracking-wider">{{ $prod->category->name }}</p>
                <h3 class="text-base font-extrabold text-slate-800 mb-1 group-hover:text-{{ $prod->avatar_color ?? 'green' }}-600 transition-colors">{{ $prod->name }}</h3>
                <div class="flex justify-between items-end mt-5 pt-5 border-t border-slate-50">
                    <span class="text-slate-900 font-extrabold text-lg">Rp {{ number_format($prod->price, 0, ',', '.') }}</span>
                    <span class="text-[10px] font-bold {{ $prod->stock <= 10 ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50' }} px-2.5 py-1.5 rounded-lg uppercase tracking-wider">Stok: {{ $prod->stock }}</span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-slate-500 font-medium">Belum ada produk yang tersedia.</div>
            @endforelse
        </div>
    </div>
    
    <!-- Right Area: Cart -->
    <div class="w-full lg:w-[400px] flex-shrink-0 bg-white lg:border-l border-slate-100 flex flex-col shadow-[-10px_0_30px_rgba(0,0,0,0.02)] relative z-20 rounded-t-3xl lg:rounded-none">
        <div class="p-6 lg:p-8 border-b border-slate-100">
            <h2 class="text-xl font-extrabold text-slate-900 mb-5 flex items-center gap-3">
                <div class="p-2 bg-green-50 text-green-500 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                Keranjang Pesanan
            </h2>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input type="text" value="Sesi Kasir #01" class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none bg-slate-50 text-sm font-bold text-slate-700 transition-all" readonly>
            </div>
        </div>
        
        <div class="flex-1 p-8 overflow-y-auto flex flex-col items-center justify-center text-center bg-slate-50/50 min-h-[250px]" x-show="cart.length === 0">
            <div class="w-24 h-24 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-5 text-slate-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-base font-bold text-slate-400">Keranjang masih kosong</p>
            <p class="text-sm text-slate-400 mt-2 max-w-[200px] leading-relaxed">Pilih produk di sebelah kiri untuk menambah pesanan.</p>
        </div>

        <div class="flex-1 p-6 overflow-y-auto min-h-[250px]" x-show="cart.length > 0" style="display: none;">
            <template x-for="item in cart" :key="item.name">
                <div class="flex justify-between items-center p-4 bg-white border border-slate-100 rounded-2xl shadow-sm mb-3 group hover:border-green-200 transition-colors">
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm" x-text="item.name"></h4>
                        <p class="text-xs font-medium text-slate-400 mt-1" x-text="item.qty + ' × Rp ' + item.price"></p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <span class="font-extrabold text-slate-900 text-sm" x-text="'Rp ' + item.total"></span>
                        <button type="button" @click="cart = cart.filter(i=>i.name!==item.name)" class="text-[10px] font-bold text-red-400 hover:text-red-600 uppercase tracking-widest transition-colors opacity-100 lg:opacity-0 group-hover:opacity-100 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </template>
        </div>
        
        <div class="p-6 lg:p-8 border-t border-slate-100 bg-white shadow-[0_-10px_30px_rgba(0,0,0,0.02)]">
            <div class="flex justify-between items-end mb-6">
                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Belanja</span>
                <span class="font-extrabold text-4xl text-green-500 tracking-tight" x-text="'Rp ' + totalCart.toLocaleString('id-ID')">Rp 0</span>
            </div>
            
            <div class="mb-5 flex gap-2">
                <button @click="paymentMethod = 'Cash'; paymentAmount = 0" :class="paymentMethod === 'Cash' ? 'bg-green-50 text-green-600 border-green-500' : 'bg-white text-slate-500 border-slate-200'" class="flex-1 py-2.5 rounded-xl border-2 text-sm font-bold transition-all">Tunai (Cash)</button>
                <button @click="paymentMethod = 'QRIS'" :class="paymentMethod === 'QRIS' ? 'bg-green-50 text-green-600 border-green-500' : 'bg-white text-slate-500 border-slate-200'" class="flex-1 py-2.5 rounded-xl border-2 text-sm font-bold transition-all">QRIS E-Wallet</button>
            </div>
            
            <div x-show="paymentMethod === 'Cash'">
                <div class="mb-5">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2.5 uppercase tracking-widest">Uang Dibayar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-bold text-lg">Rp</span>
                        </div>
                        <input type="number" x-model.number="paymentAmount" placeholder="0" class="w-full pl-14 pr-5 py-4 text-xl rounded-2xl border border-slate-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none font-bold text-slate-800 transition-all bg-slate-50">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-8">
                    <button @click="paymentAmount = 10000" class="bg-white border border-slate-200 hover:border-green-500 hover:text-green-600 hover:bg-green-50 text-slate-600 text-sm font-bold py-3 rounded-xl transition-all">Rp 10.000</button>
                    <button @click="paymentAmount = 20000" class="bg-white border border-slate-200 hover:border-green-500 hover:text-green-600 hover:bg-green-50 text-slate-600 text-sm font-bold py-3 rounded-xl transition-all">Rp 20.000</button>
                    <button @click="paymentAmount = 50000" class="bg-white border border-slate-200 hover:border-green-500 hover:text-green-600 hover:bg-green-50 text-slate-600 text-sm font-bold py-3 rounded-xl transition-all">Rp 50.000</button>
                    <button @click="paymentAmount = 100000" class="bg-white border border-slate-200 hover:border-green-500 hover:text-green-600 hover:bg-green-50 text-slate-600 text-sm font-bold py-3 rounded-xl transition-all">Rp 100.000</button>
                </div>
                
                <div class="flex justify-between items-center mb-8 pt-6 border-t border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kembalian</span>
                    <span class="font-extrabold text-2xl text-slate-800" x-text="'Rp ' + changeAmount.toLocaleString('id-ID')">Rp 0</span>
                </div>
            </div>
            
            <div x-show="paymentMethod === 'QRIS'" class="mb-8 pt-4 flex flex-col items-center justify-center border-t border-slate-100" style="display: none;">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Scan QRIS Untuk Membayar</p>
                <div class="p-3 bg-white border-2 border-slate-200 rounded-2xl shadow-sm hover:scale-105 transition-transform">
                    <!-- Dynamic QRIS based on totalCart -->
                    <img :src="`https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=Total+Belanja+Rp+${totalCart}`" alt="QRIS" class="w-40 h-40 rounded-lg">
                </div>
                <p class="text-sm font-bold text-green-500 mt-4 animate-pulse">Menunggu Pembayaran...</p>
            </div>
            
            <!-- Checkout Form -->
            <form id="checkoutForm" action="{{ route('admin.checkout') }}" method="POST" @submit.prevent="submitCheckout()">
                @csrf
                <input type="hidden" name="items" :value="JSON.stringify(cart)">
                <input type="hidden" name="payment_method" :value="paymentMethod">
                <input type="hidden" name="amount_paid" :value="paymentAmount">
                <button type="submit" :disabled="cart.length === 0" class="w-full text-base font-bold py-5 rounded-2xl transition-all shadow-[0_8px_30px_rgb(0,0,0,0.15)] hover:-translate-y-1 flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0" :class="cart.length > 0 ? 'bg-slate-900 hover:bg-slate-800 text-white hover:shadow-[0_12px_40px_rgb(0,0,0,0.25)]' : 'bg-slate-200 text-slate-400'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span x-text="cart.length === 0 ? 'Pilih Produk Dulu' : 'Proses Pembayaran'">Proses Pembayaran</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Elegant Category Modal with Backdrop -->
    <div x-show="showCategoryModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden p-4"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showCategoryModal=false"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white rounded-3xl w-full max-w-md p-6 sm:p-8 shadow-[0_20px_60px_rgba(0,0,0,0.3)] m-auto"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             @click.stop>
             
            <!-- Close Button -->
            <button @click="showCategoryModal=false" class="absolute top-5 right-5 sm:top-6 sm:right-6 p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">Buat Kategori Baru</h2>
                    <p class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Tambahkan pengelompokan produk.</p>
                </div>
            </div>
            
            <form @submit.prevent="console.log('Simpan kategori', newCategoryName, newCategoryType); showCategoryModal=false;">
                <div class="space-y-5">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Nama Kategori</label>
                        <div class="relative">
                            <input type="text" x-model="newCategoryName" placeholder="Contoh: Minuman Dingin" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none font-medium text-slate-800 transition-all placeholder:text-slate-400 shadow-sm" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 mb-2 uppercase tracking-widest">Tipe / Induk</label>
                        <div class="relative">
                            <select x-model="newCategoryType" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none font-medium text-slate-800 transition-all appearance-none cursor-pointer shadow-sm">
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <button type="button" @click="showCategoryModal=false" class="w-full sm:w-1/3 px-4 py-3.5 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="w-full sm:w-2/3 px-4 py-3.5 rounded-xl bg-green-500 text-white font-bold hover:bg-green-600 transition-colors shadow-lg shadow-green-500/30 flex items-center justify-center gap-2 group">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
