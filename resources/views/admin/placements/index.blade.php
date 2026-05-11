@extends('layouts.app')

@section('title', 'Kelola Satker — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6">
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <a href="{{ route('admin.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                    <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                    </div>
                    Kembali ke Kelola User
                </a>
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Administrasi Wilayah</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Daftar <span class="text-kej-green">Satker Penempatan</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Kelola lokasi penempatan kerja sosial di seluruh wilayah hukum.</p>
            </div>
            
            <a href="{{ route('admin.placements.create') }}" class="bg-kej-navy text-white px-6 py-3 rounded-xl font-black text-xs tracking-widest uppercase hover:bg-kej-green transition-all shadow-lg flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Satker Baru
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-kej-green/10 text-kej-green border border-kej-green/20 px-4 py-3 rounded-xl text-xs font-bold flex items-center gap-2 animate-fade-in">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 text-red-600 border border-red-100 px-4 py-3 rounded-xl text-xs font-bold flex items-center gap-2 animate-fade-in">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($placements as $placement)
            <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-kej-bg rounded-xl flex items-center justify-center text-kej-navy group-hover:bg-kej-green group-hover:text-white transition-all">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.placements.edit', $placement) }}" class="p-2 text-kej-muted hover:text-kej-navy hover:bg-kej-bg rounded-lg transition-all">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.placements.destroy', $placement) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Satker ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-kej-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="text-lg font-black text-kej-navy mb-1">{{ $placement->name }}</h3>
                    <div class="text-[10px] font-black text-kej-green uppercase tracking-[0.15em] mb-4">{{ $placement->users_count }} Terpidana Terdaftar</div>
                    
                    <div class="space-y-3 pt-4 border-t border-kej-border/50">
                        <div class="flex items-start gap-3">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-kej-muted shrink-0 mt-0.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="text-xs font-medium text-kej-ink leading-relaxed">{{ $placement->address ?? 'Alamat belum diatur' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-kej-muted"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span class="text-xs font-bold text-kej-navy">PIC: {{ $placement->pic_name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-kej-muted"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span class="text-xs font-bold text-kej-navy">{{ $placement->phone ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
