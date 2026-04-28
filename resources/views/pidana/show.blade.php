@extends('layouts.app')

@section('title', $user->name . ' — Monitoring E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-10">
    <div class="max-w-[1000px] mx-auto px-6">
        <div class="mb-10">
            <a href="{{ route('pidana.list') }}" class="text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-6">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Daftar Terpidana
            </a>
            
            <div class="bg-white border border-kej-border rounded-3xl p-8 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03]">
                    <svg width="240" height="240" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                
                <div class="flex flex-col md:flex-row gap-10 relative z-10">
                    <div class="w-32 h-32 bg-kej-navy rounded-2xl grid place-items-center text-white text-5xl font-serif font-black shrink-0">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                            <div>
                                <h1 class="font-serif text-3xl font-black text-kej-navy mb-1">{{ $user->name }}</h1>
                                <p class="text-sm font-bold text-kej-green tracking-widest uppercase">TERPIDANA KERJA SOSIAL</p>
                            </div>
                            <div class="bg-kej-green/10 text-kej-green border border-kej-green/20 px-4 py-2 rounded-xl text-xs font-black tracking-widest uppercase">
                                STATUS: AKTIF
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-kej-border/50">
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Perkara</span>
                                <span class="font-bold text-kej-navy">{{ $user->crime ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Tanggal Lahir</span>
                                <span class="font-bold text-kej-navy">{{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d F Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="font-serif text-2xl font-black text-kej-navy mb-1">Aktivitas & Progress</h2>
            <p class="text-sm text-kej-muted">Riwayat presensi dan pengawasan lokasi real-time.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white border border-kej-border rounded-2xl p-6 shadow-sm">
                    <h3 class="text-xs font-bold text-kej-navy uppercase tracking-widest mb-6 border-b border-kej-border pb-4">Ringkasan Kehadiran</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-2xl font-serif font-black text-kej-navy">{{ $absences->count() }} <small class="text-xs text-kej-muted">Kehadiran</small></span>
                                <span class="text-[11px] font-bold text-kej-muted uppercase">Total Dijalani</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-2xl font-serif font-black text-kej-navy">{{ $absences->first() ? $absences->first()->created_at->format('d M Y') : '-' }}</span>
                                <span class="text-[11px] font-bold text-kej-muted uppercase">Terakhir Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-4">
                @forelse($absences as $absence)
                <div class="bg-white border border-kej-border rounded-2xl p-5 shadow-sm flex items-center gap-6">
                    <div class="w-20 h-20 bg-kej-bg rounded-xl overflow-hidden shrink-0 border border-kej-border">
                        <img src="{{ Storage::url($absence->image_path) }}" alt="Selfie" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <div class="text-[10px] font-bold text-kej-muted uppercase tracking-widest mb-0.5">{{ $absence->created_at->format('d F Y') }}</div>
                                <h4 class="font-bold text-kej-navy">{{ $absence->location_name ?? 'Lokasi Kerja' }}</h4>
                            </div>
                            <span class="text-[9px] font-black bg-kej-bg px-2 py-1 rounded border border-kej-border text-kej-muted uppercase tracking-widest">{{ $absence->created_at->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="https://www.google.com/maps?q={{ $absence->latitude }},{{ $absence->longitude }}" target="_blank" class="text-[11px] font-bold text-kej-green flex items-center gap-1.5 hover:underline">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                VALIDASI GPS OK
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border border-kej-border rounded-2xl p-10 text-center">
                    <p class="text-sm font-bold text-kej-muted">Belum ada riwayat aktivitas yang tercatat untuk periode ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
