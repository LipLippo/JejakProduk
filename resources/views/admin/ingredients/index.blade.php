@extends('layouts.admin')

@section('content')
<div x-data="{
    showAddModal: false,
    showEditModal: false,
    showDeleteModal: false,
    editData: { id: '', name: '', stock: '', min_stock: '', unit: '' },
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
<div class="flex justify-between items-start mb-8" data-aos="fade-down">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Bahan Baku</h1>
        <p class="text-base text-slate-500 mt-2">Pencatatan persediaan stok untuk keperluan produksi.</p>
    </div>
    <button @click="showAddModal = true" class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-6 py-3.5 rounded-2xl transition-all duration-300 hover:-translate-y-1 shadow-[0_8px_30px_rgb(16,185,129,0.2)] flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Stok Baru
    </button>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden" data-aos="fade-up" data-aos-delay="100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-400 text-xs uppercase tracking-wider font-extrabold">
                <th class="py-5 px-6 border-b border-slate-100 rounded-tl-3xl">Nama Bahan</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center">Stok Tersedia</th>
                <th class="py-5 px-6 border-b border-slate-100">Satuan</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center rounded-tr-3xl">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-600">
            @forelse($ingredients as $ing)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="py-4 px-6 border-b border-slate-50 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-500 font-bold shadow-sm shadow-slate-500/10 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <span class="text-slate-800 font-extrabold group-hover:text-slate-600 transition-colors text-base">{{ $ing->name }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    <span class="font-bold {{ $ing->stock <= $ing->min_stock ? 'text-red-600 bg-red-50/30' : 'text-slate-600 bg-slate-50/30' }} rounded-xl px-6 py-1.5 inline-block">{{ $ing->stock }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 font-semibold text-slate-500">{{ $ing->unit }}</td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    <button @click='openEdit(@json($ing))' class="text-slate-400 hover:text-green-500 transition-colors mx-1 p-2 hover:bg-green-50 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                    <button @click="openDelete({ id: {{ $ing->id }}, name: '{{ addslashes($ing->name) }}' })" class="text-slate-400 hover:text-red-500 transition-colors mx-1 p-2 hover:bg-red-50 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-8 text-center text-slate-500 font-medium">Belum ada bahan baku.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

    <!-- Add Modal -->
    <div x-show="showAddModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showAddModal=false"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl m-auto z-10"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-extrabold text-slate-800">Tambah Bahan Baku Baru</h2>
                <button @click="showAddModal=false" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form action="/admin/ingredients" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Bahan</label>
                        <input type="text" name="name" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required placeholder="Contoh: Teh Oolong">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok Awal</label>
                            <input type="number" name="stock" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required placeholder="0">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok Minimum</label>
                            <input type="number" name="min_stock" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required placeholder="0">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Satuan</label>
                        <input type="text" name="unit" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required placeholder="Contoh: gram, pcs">
                    </div>
                </div>
                <div class="flex gap-3 mt-8">
                    <button type="button" @click="showAddModal=false" class="w-1/3 px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Batal</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-green-500 text-white font-bold hover:bg-green-600 shadow-lg shadow-green-500/30">Tambah Stok</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showEditModal=false"></div>
        <div class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl m-auto z-10"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-extrabold text-slate-800">Edit Bahan Baku</h2>
                <button @click="showEditModal=false" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form :action="`/admin/ingredients/${editData.id}`" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Bahan</label>
                        <input type="text" name="name" x-model="editData.name" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok</label>
                            <input type="number" name="stock" x-model="editData.stock" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok Minimum</label>
                            <input type="number" name="min_stock" x-model="editData.min_stock" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Satuan</label>
                        <input type="text" name="unit" x-model="editData.unit" class="w-full rounded-xl border border-slate-200 py-3 px-4 focus:border-green-500 outline-none" required>
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
            <h3 class="text-xl font-extrabold text-slate-800 mb-2">Hapus Bahan Baku?</h3>
            <p class="text-slate-500 text-sm mb-6">Anda yakin ingin menghapus <span class="font-bold text-slate-700" x-text="deleteData.name"></span>? Data yang dihapus tidak bisa dikembalikan.</p>
            <form :action="`/admin/ingredients/${deleteData.id}`" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="showDeleteModal=false" class="w-1/2 px-4 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200">Batal</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600 shadow-lg shadow-red-500/30">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
