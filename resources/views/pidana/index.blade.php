@extends('layouts.app')

@section('title', 'Daftar Terpidana Kerja Sosial — E-PKS')

@section('content')
    <div class="bg-kej-bg min-h-screen py-10 lg:py-16">
        <div class="max-w-[1240px] mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
                <div class="animate-fade-in">
                    <div
                        class="text-[11px] font-black text-kej-gold-dark tracking-[0.25em] uppercase mb-3 px-4 py-1.5 bg-kej-gold/10 rounded-full border border-kej-gold/30 inline-block">
                        Transparansi Pengawasan</div>
                    <h1 class="font-serif text-4xl lg:text-5xl font-black text-kej-navy tracking-tight">Monitoring <span
                            class="text-kej-green">Terpidana</span></h1>
                    <p class="text-[16px] text-kej-muted max-w-2xl mt-4 leading-relaxed">Sistem integrasi data publik untuk
                        memantau progres pelaksanaan pidana kerja sosial di seluruh Satker Kejaksaan RI.</p>
                </div>

                    <form action="" method="GET" class="relative group flex flex-col md:flex-row gap-3 items-center w-full">
                        <select name="placement_id" onchange="this.form.submit()" class="w-full md:w-auto px-4 py-4 bg-white border-2 border-kej-border rounded-2xl text-sm font-bold text-kej-navy focus:outline-none focus:border-kej-green transition-all shadow-sm appearance-none">
                            <option value="">Semua Lokasi Penempatan</option>
                            @foreach($placements as $placement)
                                <option value="{{ $placement->id }}" {{ request('placement_id') == $placement->id ? 'selected' : '' }}>
                                    {{ $placement->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="relative flex-1 w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Terpidana..."
                                class="w-full bg-white border-2 border-kej-border rounded-2xl pl-12 pr-24 py-4 text-sm font-bold text-kej-navy placeholder:text-kej-muted/60 focus:outline-none focus:ring-4 focus:ring-kej-green/10 focus:border-kej-green transition-all shadow-sm group-hover:shadow-md">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-kej-muted group-focus-within:text-kej-green transition-colors"
                                width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-kej-navy text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-kej-green transition-all shadow-lg active:scale-95">
                                CARI
                            </button>
                        </div>
                    </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($pidanas as $pidana)
                    <div
                        class="flex flex-col h-full bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group animate-fade-in">
                        <div class="h-1.5 bg-kej-navy group-hover:bg-kej-green transition-colors"></div>
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex gap-5 mb-8">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 bg-kej-bg rounded-2xl grid place-items-center text-kej-navy text-2xl font-serif font-black shrink-0 group-hover:bg-kej-navy transition-all duration-500 transform group-hover:rotate-6">
                                        {{ substr($pidana->name, 0, 1) }}
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-kej-gold rounded-full border-2 border-white flex items-center justify-center hidden">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white"
                                            stroke-width="3">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3
                                        class="font-serif text-xl font-black text-kej-navy group-hover:text-kej-green transition-colors leading-tight mb-1.5">
                                        {{ $pidana->name }}</h3>
                                    <div class="flex items-center gap-2">
                                        <p class="text-[10px] font-black text-kej-muted uppercase tracking-widest">ID:
                                            PKS-{{ str_pad($pidana->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4 mb-8 flex-1">
                                <div class="bg-kej-bg/50 rounded-xl p-4 border border-kej-border/50 h-full flex flex-col">
                                    <div class="flex justify-between items-center text-[12px] mb-3">
                                        <span class="text-kej-muted font-bold uppercase tracking-wider">Perkara</span>
                                        <span
                                            class="text-kej-navy font-black text-right">{{ $pidana->crime ?? 'Pidana Umum' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-[12px]">
                                        <span class="text-kej-muted font-bold uppercase tracking-wider">Satker</span>
                                        <span class="text-kej-navy font-black text-right">{{ $pidana->placement->name ?? 'Tidak Diketahui' }}</span>
                                    </div>
                                    <div class="flex-1 flex flex-col justify-center items-center text-[12px] mt-3">
                                        <span class="text-kej-navy font-bold text-center">{{ $pidana->sentence ?? 'Kerja Sosial' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-kej-border flex justify-between items-center">
                                <span class="text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Total Kehadiran</span>
                                <div class="flex items-center gap-2 bg-kej-green/10 px-3 py-1 rounded-lg border border-kej-green/20">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-kej-green"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    <span class="text-[13px] font-black text-kej-green">{{ $pidana->absences_count }} Hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-8 pb-8 flex gap-3">
                            <a href="{{ route('pidana.show', $pidana->id) }}"
                                class="group/btn relative flex-1 block w-full bg-kej-navy py-4 rounded-xl text-[11px] font-black text-white text-center uppercase tracking-[0.2em] overflow-hidden transition-all hover:bg-kej-green shadow-lg">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Aktivitas Digital
                                    <svg class="group-hover/btn:translate-x-1 transition-transform" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </span>
                            </a>
                            
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('admin.edit', $pidana->id) }}" 
                                    class="flex items-center justify-center px-5 bg-white border-2 border-kej-navy text-kej-navy rounded-xl hover:bg-kej-navy hover:text-white transition-all shadow-sm"
                                    title="Edit Profil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-kej-border">
                        <div class="w-20 h-20 bg-kej-bg rounded-full grid place-items-center mx-auto mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                class="text-kej-muted">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                        </div>
                        <h3 class="font-serif text-xl font-black text-kej-navy mb-2">Data Tidak Ditemukan</h3>
                        <p class="text-kej-muted">Belum ada data terpidana yang terdaftar dalam sistem pengawasan ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection