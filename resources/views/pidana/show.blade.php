@extends('layouts.app')

@section('title', $user->name . ' — Monitoring E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-10">
            <a href="{{ route('pidana.list') }}" class="text-[11px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-6">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Daftar Terpidana
            </a>
            
            <div class="bg-white border border-kej-border rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03] hidden sm:block">
                    <svg width="240" height="240" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-10 relative z-10">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-kej-navy rounded-2xl grid place-items-center text-white text-4xl sm:text-5xl font-serif font-black shrink-0 shadow-lg">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="flex-1 text-center sm:text-left w-full">
                        <div class="flex flex-col sm:flex-row justify-between items-center sm:items-start gap-4 mb-6 sm:mb-4">
                            <div>
                                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy mb-1 leading-tight">{{ $user->name }}</h1>
                                <p class="text-[10px] sm:text-sm font-bold text-kej-green tracking-widest uppercase">TERPIDANA KERJA SOSIAL</p>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                                @if(auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.edit', $user->id) }}" class="w-full sm:w-auto bg-kej-gold/10 text-kej-gold-dark hover:bg-kej-gold hover:text-white border border-kej-gold/50 px-4 py-2 rounded-xl text-[10px] sm:text-xs font-black tracking-widest uppercase transition-colors text-center">
                                        EDIT PROFIL
                                    </a>
                                @endif
                                <div class="w-full sm:w-auto bg-kej-green/10 text-kej-green border border-kej-green/20 px-4 py-2 rounded-xl text-[10px] sm:text-xs font-black tracking-widest uppercase text-center">
                                    STATUS: AKTIF
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 pt-6 border-t border-kej-border/50 text-left">
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">No. Register Perkara</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->pks02_case_number ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">NIK</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->national_id ? substr($user->national_id, 0, 4) . '********' . substr($user->national_id, -4) : '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Tempat, Tgl Lahir</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->place_of_birth ?? '-' }}, {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d M Y') : '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Jenis Kelamin & Agama</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->gender ?? '-' }} / {{ $user->religion ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Pendidikan & Pekerjaan</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->education ?? '-' }} - {{ $user->occupation ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Alamat Lengkap</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base line-clamp-1" title="{{ $user->address }}">{{ $user->address ?? '-' }}</span>
                            </div>
                            <div class="sm:col-span-3 border-t border-kej-border/50 pt-4 mt-2"></div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Perkara</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->crime ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Satker Penempatan</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->placement->name ?? 'Belum Ditentukan' }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Masa Hukuman (Vonis)</span>
                                <span class="font-bold text-kej-navy text-sm sm:text-base">{{ $user->sentence ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="font-serif text-xl sm:text-2xl font-black text-kej-navy mb-1">Aktivitas & Progress</h2>
            <p class="text-xs sm:text-sm text-kej-muted">Riwayat presensi dan pengawasan lokasi real-time.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white border border-kej-border rounded-2xl p-6 shadow-sm">
                    <h3 class="text-xs font-bold text-kej-navy uppercase tracking-widest mb-6 border-b border-kej-border pb-4">Ringkasan Kehadiran</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-xl sm:text-2xl font-serif font-black text-kej-navy">{{ $absences->count() }} <small class="text-[10px] sm:text-xs text-kej-muted uppercase">Kehadiran</small></span>
                                <span class="text-[10px] sm:text-[11px] font-bold text-kej-muted uppercase">Total Dijalani</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-xl sm:text-2xl font-serif font-black text-kej-navy">{{ $absences->first() ? $absences->first()->created_at->format('d M Y') : '-' }}</span>
                                <span class="text-[10px] sm:text-[11px] font-bold text-kej-muted uppercase">Terakhir Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PKS-02 Info --}}
                @if($user->pks02_opinion_analysis)
                <div class="bg-white border border-kej-border rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6 border-b border-kej-border pb-4">
                        <div class="w-8 h-8 bg-kej-gold/20 rounded flex items-center justify-center text-kej-gold-dark">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <h3 class="text-xs font-bold text-kej-navy uppercase tracking-widest">Pendapat Penuntut Umum</h3>
                    </div>
                    
                    <div class="space-y-6">
                        @if($user->pks02_prosecutor_name)
                        <div>
                            <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Jaksa Penuntut Umum</span>
                            <span class="font-bold text-kej-navy text-sm">{{ $user->pks02_prosecutor_name }}</span>
                        </div>
                        @endif
                        
                        @if($user->pks02_opinion_analysis)
                        <div>
                            <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Analisis Hukum</span>
                            <div class="text-kej-navy text-xs leading-relaxed">{!! nl2br(e($user->pks02_opinion_analysis)) !!}</div>
                        </div>
                        @endif

                        @if($user->pks02_opinion_recommendation)
                        <div>
                            <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Rekomendasi</span>
                            <div class="text-kej-navy text-xs leading-relaxed italic">{!! nl2br(e($user->pks02_opinion_recommendation)) !!}</div>
                        </div>
                        @endif

                        @if($user->pks02_opinion_conclusion)
                        <div>
                            <span class="block text-[10px] text-kej-muted font-bold uppercase tracking-widest mb-1">Kesimpulan</span>
                            <div class="text-kej-navy text-xs font-bold leading-relaxed">{!! nl2br(e($user->pks02_opinion_conclusion)) !!}</div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm" x-data>
                    <div class="px-6 py-4 border-b border-kej-border bg-kej-bg/30">
                        <h3 class="font-serif font-black text-kej-navy text-sm uppercase tracking-wider">Aktivitas Terbaru</h3>
                    </div>
                    <div class="divide-y divide-kej-border">
                        @forelse($absences as $absence)
                            @include('partials.absence-card', ['absence' => $absence])
                        @empty
                            <div class="p-10 sm:p-16 text-center text-kej-muted italic text-sm">
                                Belum ada riwayat aktivitas yang tercatat.
                            </div>
                        @endforelse
                    </div>
                </div>

                @if($user->supervisions->count() > 0)
                <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-kej-border bg-kej-navy/5">
                        <h3 class="font-serif font-black text-kej-navy text-sm uppercase tracking-wider">Catatan Pengawasan (PKS-03)</h3>
                    </div>
                    <div class="divide-y divide-kej-border">
                        @foreach($user->supervisions()->latest()->get() as $supervision)
                            <div class="p-6 hover:bg-kej-bg/30 transition-colors">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-xs font-black text-kej-navy uppercase">{{ $supervision->supervision_date->format('d F Y') }}</span>
                                            <span class="px-2 py-0.5 bg-kej-navy text-white rounded text-[9px] font-black uppercase tracking-tighter">{{ $supervision->supervision_type }}</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <span class="text-[10px] font-bold text-kej-muted uppercase">Perilaku: <span class="text-kej-navy">{{ $supervision->behavior_status ?? '-' }}</span></span>
                                            <span class="text-[10px] font-bold text-kej-muted uppercase">Kepatuhan: <span class="text-kej-green">{{ $supervision->compliance_status ?? '-' }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xs text-kej-muted leading-relaxed">{{ $supervision->notes }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
