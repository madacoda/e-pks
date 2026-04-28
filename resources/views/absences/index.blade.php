@extends('layouts.app')

@section('title', 'Riwayat Absensi — E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-10">
    <div class="max-w-[1000px] mx-auto px-6">
        <div class="mb-8 flex justify-between items-end">
            <div>
                <a href="{{ route('dashboard') }}" class="text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="font-serif text-3xl font-black text-kej-navy tracking-tight">Riwayat <span class="text-kej-green">Presensi</span></h1>
                <p class="text-[15px] text-kej-muted mt-2">Daftar lengkap kehadiran dan pengawasan lokasi Anda.</p>
            </div>
            <a href="{{ route('absences.create') }}" class="bg-kej-green text-white px-6 py-3 rounded-xl font-bold text-sm tracking-wide hover:bg-kej-gold hover:text-kej-navy transition-all shadow-md flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Presensi Baru
            </a>
        </div>

        <div class="space-y-4">
            @forelse($absences as $absence)
            <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm flex flex-col md:flex-row">
                <div class="w-full md:w-[200px] aspect-[4/3] md:aspect-square shrink-0 bg-kej-bg relative">
                    <img src="{{ Storage::disk('public')->url($absence->image_path) }}" alt="Selfie" class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 bg-black/60 text-white text-[9px] font-bold px-2 py-1 rounded backdrop-blur-sm">
                        {{ $absence->created_at->format('H:i') }} WIB
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div class="flex justify-between items-start gap-4 mb-4">
                        <div>
                            <div class="text-[11px] font-bold text-kej-muted uppercase tracking-widest mb-1">{{ $absence->created_at->format('d F Y') }}</div>
                            <h3 class="font-serif text-lg font-bold text-kej-navy">{{ $absence->location_name ?? 'Lokasi Kerja Terverifikasi' }}</h3>
                        </div>
                        <div class="px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase {{ $absence->status === 'present' ? 'bg-kej-green/10 text-kej-green border border-kej-green/20' : 'bg-kej-red/10 text-kej-red border border-kej-red/20' }}">
                            {{ $absence->status }}
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-6 items-center pt-4 border-t border-kej-border">
                        <div class="flex items-center gap-2 text-[12px] text-kej-ink">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-kej-muted"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="font-mono text-kej-muted">{{ $absence->latitude }}, {{ $absence->longitude }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-[12px] text-kej-ink">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-kej-muted"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>Terverifikasi Otomatis</span>
                        </div>
                        <a href="https://www.google.com/maps?q={{ $absence->latitude }},{{ $absence->longitude }}" target="_blank" class="ml-auto text-[11px] font-bold text-kej-green hover:underline">LIHAT DI PETA</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white border border-kej-border rounded-2xl p-20 text-center">
                <div class="w-20 h-20 bg-kej-bg rounded-full grid place-items-center mx-auto mb-6 text-kej-muted">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h3 class="font-serif text-xl font-bold text-kej-navy mb-2">Belum Ada Riwayat</h3>
                <p class="text-kej-muted max-w-xs mx-auto mb-8">Anda belum melakukan presensi sama sekali dalam sistem E-PKS.</p>
                <a href="{{ route('absences.create') }}" class="bg-kej-green text-white px-8 py-3.5 rounded-xl font-bold text-sm">Mulai Presensi Pertama</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
