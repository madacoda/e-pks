@props(['absence', 'showUser' => true, 'compact' => false])

@php
    $isAdmin = auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'jaksa_pengawas');
    $showUserLabel = $showUser && $isAdmin && $absence->user;
@endphp

<div class="bg-white border border-kej-border rounded-2xl {{ $compact ? 'p-4' : 'p-4 sm:p-5' }} shadow-sm hover:shadow-md transition-all flex items-center gap-4 {{ $compact ? 'sm:gap-4' : 'sm:gap-6' }} group relative">
{{-- Flagged badge hidden as per request --}}

    <!-- Compact Thumbnail -->
    <div class="{{ $compact ? 'w-16 h-16 sm:w-20 sm:h-20' : 'w-20 h-20 sm:w-32 sm:h-32' }} shrink-0 bg-kej-bg rounded-2xl overflow-hidden border border-kej-border shadow-sm">
        <img src="{{ Storage::disk('public')->url($absence->image_path) }}" alt="Selfie" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
    </div>

    <div class="flex-1 min-w-0">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
            <div class="min-w-0">
                @if($showUserLabel)
                    <div class="text-[10px] font-black text-kej-green uppercase tracking-[0.1em] mb-0.5">Terpidana</div>
                    <h3 class="font-serif {{ $compact ? 'text-base' : 'text-lg sm:text-xl' }} font-black text-kej-navy truncate leading-tight">
                        {{ $absence->user->name }}
                    </h3>
                    <div class="flex items-center gap-1.5 mt-1">
                        <p class="text-[11px] {{ $compact ? '' : 'sm:text-[12px]' }} font-bold text-kej-muted truncate">
                            {{ $absence->location_name ?? 'Lokasi Kerja Terverifikasi' }}
                        </p>
                        <svg class="text-kej-green shrink-0" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"><polyline points="20 6 9 17 4 12"/></svg>
                        <span class="text-[9px] font-black text-kej-green uppercase tracking-widest leading-none">Terverifikasi</span>
                    </div>
                @else
                    <div class="text-[10px] font-black text-kej-muted uppercase tracking-[0.1em] mb-0.5">
                        {{ $absence->created_at->translatedFormat('l, d F Y') }}
                        @if($compact)
                            <span class="text-kej-green opacity-60 ml-1">• {{ $absence->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <h3 class="font-serif {{ $compact ? 'text-base' : 'text-lg sm:text-xl' }} font-black text-kej-navy truncate leading-tight">
                            {{ $absence->location_name ?? 'Lokasi Kerja Terverifikasi' }}
                        </h3>
                        <svg class="text-kej-green shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    @if(!$compact)
                        <p class="text-[10px] font-black text-kej-green uppercase tracking-widest mt-1">Terverifikasi Sistem</p>
                    @endif
                @endif
            </div>
            
            <div class="flex items-center gap-2 shrink-0">
                <span class="inline-flex px-3 py-1 rounded-lg text-[9px] font-black tracking-widest uppercase {{ $absence->status === 'present' ? 'bg-kej-green/10 text-kej-green border border-kej-green/20' : 'bg-red-50 text-red-600 border border-red-100' }}">
                    {{ $absence->status }}
                </span>
                <div class="text-[10px] font-bold text-kej-muted bg-kej-bg px-2 py-1 rounded-lg whitespace-nowrap">
                    {{ $absence->created_at->translatedFormat('d/m/y H:i') }} WIB
                    @if(!$compact)
                        <span class="text-kej-green/60 ml-1 font-black">• {{ $absence->created_at->diffForHumans() }}</span>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Violation alert hidden as per request --}}

        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 pt-3 border-t border-kej-border/50">
            <div class="flex items-center gap-1.5 text-[10px] {{ $compact ? '' : 'sm:text-[11px]' }} font-bold text-kej-muted">
                <div class="w-6 h-6 bg-kej-bg rounded-md flex items-center justify-center text-kej-muted">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <span class="font-mono tracking-tight">{{ $absence->latitude }}, {{ $absence->longitude }}</span>
            </div>
            
            <div class="ml-auto flex gap-2">
                <button 
                    x-on:click="$dispatch('open-absence-modal', { 
                        image: '{{ addslashes(Storage::disk('public')->url($absence->image_path)) }}',
                        location: '{{ addslashes($absence->location_name ?? 'Presensi Terverifikasi') }}',
                        time: '{{ $absence->created_at->format('d F Y, H:i') }} WIB ({{ $absence->created_at->diffForHumans() }})',
                        lat: '{{ $absence->latitude }}',
                        lng: '{{ $absence->longitude }}',
                        status: '{{ $absence->status }}'
                    })"
                    class="px-4 {{ $compact ? 'py-1' : 'py-1.5' }} bg-white border border-kej-border rounded-lg text-[10px] font-black text-kej-navy uppercase tracking-widest hover:bg-kej-navy hover:text-white transition-all shadow-sm">
                    DETAIL
                </button>
            </div>
        </div>
    </div>
</div>
