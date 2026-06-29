@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-start mb-8" data-aos="fade-down">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Laporan Transaksi</h1>
        <p class="text-base text-slate-500 mt-2">Riwayat transaksi dan pendapatan dari penjualan Anda.</p>
    </div>
    <a href="{{ route('admin.pos') }}" class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold px-5 py-3 rounded-2xl transition-all duration-300 hover:-translate-y-1 shadow-lg shadow-green-500/30 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        Kasir POS
    </a>
</div>

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mb-6 bg-green-50 border border-green-200 rounded-2xl px-6 py-4 flex items-center justify-between gap-4" data-aos="fade-down">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="font-bold text-green-800 text-sm">Transaksi Berhasil!</p>
            <p class="text-green-600 text-xs mt-0.5">{{ session('success') }}</p>
        </div>
    </div>
    <button @click="show = false" class="text-green-400 hover:text-green-600 p-1 rounded-lg hover:bg-green-100 transition-colors flex-shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
@endif

<div class="bg-white rounded-3xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden" data-aos="fade-up" data-aos-delay="100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-400 text-xs uppercase tracking-wider font-extrabold">
                <th class="py-5 px-6 border-b border-slate-100 rounded-tl-3xl">No Invoice</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center">Tanggal</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center">Metode</th>
                <th class="py-5 px-6 border-b border-slate-100 text-right">Total Transaksi</th>
                <th class="py-5 px-6 border-b border-slate-100 text-center rounded-tr-3xl">Status</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-600">
            @forelse($transactions as $trx)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="py-4 px-6 border-b border-slate-50 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 font-bold shadow-sm shadow-blue-500/10 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="text-slate-800 font-extrabold text-base">{{ $trx->invoice_number }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-center text-slate-500 font-semibold">
                    {{ $trx->created_at->format('d M Y, H:i') }}
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl text-xs font-bold uppercase">{{ $trx->payment_method }}</span>
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-right font-extrabold text-slate-800">
                    Rp {{ number_format($trx->total, 0, ',', '.') }}
                </td>
                <td class="py-4 px-6 border-b border-slate-50 text-center">
                    @if($trx->status == 'completed')
                        <span class="font-bold text-green-600 bg-green-50/50 rounded-xl px-4 py-1.5 inline-block text-xs uppercase">Selesai</span>
                    @elseif($trx->status == 'cancelled')
                        <span class="font-bold text-red-600 bg-red-50/50 rounded-xl px-4 py-1.5 inline-block text-xs uppercase">Batal</span>
                    @else
                        <span class="font-bold text-yellow-600 bg-yellow-50/50 rounded-xl px-4 py-1.5 inline-block text-xs uppercase">{{ $trx->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-slate-500 font-medium">Belum ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
