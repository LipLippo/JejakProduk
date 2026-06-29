@extends('layouts.admin')

@section('content')
<div x-data="{
    showEditModal: false,
    showDeleteModal: false,
    editData: { id: '', name: '', price: '', stock: '' },
    deleteData: { id: '', name: '' },
    openEdit(item) {
        this.editData = { ...item };
        this.showEditModal = true;
    },
    openDelete(item) {
        this.deleteData = { ...item };
        this.showDeleteModal = true;
    }
}">
<div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-8" data-aos="fade-down">
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Produk</h1>
        <p class="text-sm sm:text-base text-slate-500 mt-2">Kelola daftar produk UMKM Anda secara efisien.</p>
    </div>
    <button @click="$dispatch('open-modal', 'add-product')" class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-6 py-3.5 rounded-2xl transition-all duration-300 hover:-translate-y-1 shadow-[0_8px_30px_rgb(16,185,129,0.2)] flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Produk Baru
    </button>
</div>

<!-- Desktop Table View -->
<div class="hidden md:block bg-white rounded-3xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden" data-aos="fade-up" data-aos-delay="100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-400 text-xs uppercase tracking-wider font-extrabold">
                <th class="py-5 px-6 border-b border-slate-100 rounded-tl-3xl">Produk</th>
                <th class="py-5 px-6 border-b border-slate-100">Kategori</th>
                <th class="py-5 px-6 border-b border-slate-100 text-right">Harga</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center">Stok</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center rounded-tr-3xl">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-600">
            @forelse($products as $prod)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="py-4 px-6 border-b border-slate-50 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-{{ $prod->avatar_color ?? 'green' }}-50 flex items-center justify-center text-{{ $prod->avatar_color ?? 'green' }}-500 font-bold shadow-sm shadow-{{ $prod->avatar_color ?? 'green' }}-500/10 group-hover:scale-105 transition-transform">{{ $prod->initials }}</div>
                    <span class="text-slate-800 font-extrabold group-hover:text-{{ $prod->avatar_color ?? 'green' }}-600 transition-colors text-base">{{ $prod->name }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl text-xs font-bold">{{ $prod->category->name }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-right font-bold text-slate-800">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    <span class="font-bold {{ $prod->stock <= 10 ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50/50' }} rounded-xl px-4 py-1.5 inline-block">{{ $prod->stock }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    <button @click='openEdit(@json($prod))' class="text-slate-400 hover:text-green-500 transition-colors mx-1 p-2 hover:bg-green-50 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                    <button @click="openDelete({ id: {{ $prod->id }}, name: '{{ addslashes($prod->name) }}' })" class="text-slate-400 hover:text-red-500 transition-colors mx-1 p-2 hover:bg-red-50 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-slate-500 font-medium">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Mobile Card View -->
<div class="md:hidden space-y-4" data-aos="fade-up" data-aos-delay="100">
    @forelse($products as $prod)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgb(0,0,0,0.04)] p-5 hover:shadow-lg transition-shadow">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-{{ $prod->avatar_color ?? 'green' }}-50 flex items-center justify-center text-{{ $prod->avatar_color ?? 'green' }}-500 font-bold shadow-sm shadow-{{ $prod->avatar_color ?? 'green' }}-500/10 flex-shrink-0">{{ $prod->initials }}</div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-800">{{ $prod->name }}</h3>
                    <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg text-[11px] font-bold mt-1 inline-block">{{ $prod->category->name }}</span>
                </div>
            </div>
            <div class="flex gap-1">
                <button @click='openEdit(@json($prod))' class="text-slate-400 hover:text-green-500 transition-colors p-2 hover:bg-green-50 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
                <button @click="openDelete({ id: {{ $prod->id }}, name: '{{ addslashes($prod->name) }}' })" class="text-slate-400 hover:text-red-500 transition-colors p-2 hover:bg-red-50 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </div>
        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Harga</p>
                <p class="text-lg font-extrabold text-slate-800">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Stok</p>
                <span class="font-bold {{ $prod->stock <= 10 ? 'text-red-600 bg-red-50' : 'text-green-600 bg-green-50' }} rounded-xl px-4 py-1.5 inline-block text-sm">{{ $prod->stock }}</span>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-8 text-slate-500 font-medium">Belum ada produk.</div>
    @endforelse
</div>

<!-- Modal Tambah Produk (Redesigned) -->
<x-modal name="add-product">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800">Tambah Produk Baru</h2>
        <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors p-2 hover:bg-slate-100 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
    </div>
    
    <form class="space-y-5">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
            <input type="text" placeholder="Masukkan nama produk" class="w-full rounded-2xl border border-slate-200 py-3.5 px-4 text-sm focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none transition-all font-medium">
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
            <select class="w-full rounded-2xl border border-slate-200 py-3.5 px-4 text-sm focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none bg-white transition-all font-medium">
                <option>Minuman</option>
                <option>Makanan</option>
                <option>Topping</option>
            </select>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                <input type="number" placeholder="0" class="w-full rounded-2xl border border-slate-200 py-3.5 px-4 text-sm focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none transition-all font-medium">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Stok Awal</label>
                <input type="number" placeholder="0" class="w-full rounded-2xl border border-slate-200 py-3.5 px-4 text-sm focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none transition-all font-medium">
            </div>
        </div>
        
        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
            <button type="button" @click="show = false" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-2xl transition-colors text-center">Batal</button>
            <button type="button" @click="show = false" class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-8 py-3 rounded-2xl transition-all shadow-[0_8px_20px_rgb(16,185,129,0.3)] hover:-translate-y-1 text-center">Simpan Produk</button>
        </div>
    </form>
</x-modal>

    <!-- Edit Modal -->
    <div x-show="showEditModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showEditModal=false"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl m-auto z-10"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-extrabold text-slate-800">Edit Produk</h2>
                <button @click="showEditModal=false" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form :action="`/admin/products/${editData.id}`" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" x-model="editData.name" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="price" x-model="editData.price" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Stok</label>
                        <input type="number" name="stock" x-model="editData.stock" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                    </div>
                </div>
                <div class="flex gap-3 mt-8">
                    <button type="button" @click="showEditModal=false" class="w-1/3 px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Batal</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-green-500 text-white font-bold hover:bg-green-600 shadow-lg shadow-green-500/30">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showDeleteModal=false"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-sm p-6 text-center shadow-2xl m-auto z-10"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-800 mb-2">Hapus Produk?</h3>
            <p class="text-slate-500 text-sm mb-6">Anda yakin ingin menghapus <span class="font-bold text-slate-700" x-text="deleteData.name"></span>? Data yang dihapus tidak bisa dikembalikan.</p>
            <form :action="`/admin/products/${deleteData.id}`" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="showDeleteModal=false" class="w-1/2 px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Batal</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 shadow-lg shadow-red-500/30">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
