@extends('layouts.app')

@section('title', 'Rekapitulasi Presensi — E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-10" x-data>
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="mb-10 flex flex-col lg:flex-row lg:justify-between lg:items-end gap-6">
            <div>
                <a href="{{ route('dashboard') }}" class="text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                    <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                    </div>
                    Kembali ke Dashboard
                </a>
                <div class="text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-2">Monitoring & Recap</div>
                <h1 class="font-serif text-3xl sm:text-4xl font-black text-kej-navy tracking-tight leading-tight">
                    Rekapitulasi <span class="text-kej-green">Presensi Digital</span>
                </h1>
                <p class="text-[15px] text-kej-muted mt-2 font-medium">Daftar lengkap riwayat kehadiran, pengawasan lokasi, dan kepatuhan sistem.</p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @if(Auth::user()->role === 'pidana')
                <a href="{{ route('absences.create') }}" class="bg-kej-green text-white px-6 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-kej-gold hover:text-kej-navy transition-all shadow-[0_10px_20px_rgba(26,110,48,0.2)] flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Presensi Baru
                </a>
                @endif
                
                @if(request()->filled('user_id'))
                    <a href="{{ route('admin.export.monthly', ['user' => request('user_id'), 'month' => request('month', now()->month), 'year' => request('year', now()->year)]) }}" class="bg-white border border-kej-border text-kej-navy px-6 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-kej-navy hover:text-white transition-all shadow-sm flex items-center gap-2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export Recap
                    </a>
                @endif
            </div>
        </div>

        <!-- Filter Panel -->
        <div class="bg-white border border-kej-border rounded-2xl p-6 mb-8 shadow-sm">
            <form action="{{ route('absences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                @if(Auth::user()->role !== 'pidana')
                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black text-kej-muted uppercase tracking-widest mb-2">Terpidana</label>
                    <select name="user_id" class="w-full bg-kej-bg border-kej-border rounded-xl px-4 py-2.5 text-xs font-bold text-kej-navy outline-none focus:border-kej-green transition-all">
                        <option value="">-- Semua Terpidana --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black text-kej-muted uppercase tracking-widest mb-2">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-kej-bg border-kej-border rounded-xl px-4 py-2.5 text-xs font-bold text-kej-navy outline-none focus:border-kej-green transition-all">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black text-kej-muted uppercase tracking-widest mb-2">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-kej-bg border-kej-border rounded-xl px-4 py-2.5 text-xs font-bold text-kej-navy outline-none focus:border-kej-green transition-all">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black text-kej-muted uppercase tracking-widest mb-2">Lokasi / Keyword</label>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Cari lokasi..." class="w-full bg-kej-bg border-kej-border rounded-xl px-4 py-2.5 text-xs font-bold text-kej-navy outline-none focus:border-kej-green transition-all placeholder:text-kej-muted/50">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-kej-navy text-white px-5 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-kej-green transition-all">
                        Filter
                    </button>
                    @if(request()->anyFilled(['user_id', 'start_date', 'end_date', 'location', 'flagged']))
                        <a href="{{ route('absences.index') }}" class="bg-kej-bg text-kej-muted px-4 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-50 hover:text-red-600 transition-all grid place-items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
            
            {{-- Flagged filter hidden as per request --}}
            {{-- @if(Auth::user()->role !== 'pidana')
            <div class="mt-4 pt-4 border-t border-kej-border flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="flagged" value="1" {{ request('flagged') ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 rounded border-kej-border text-kej-green focus:ring-kej-green">
                    <span class="text-[11px] font-bold text-kej-muted group-hover:text-red-600 transition-colors">Tampilkan Hanya Pelanggaran Radius (Flagged)</span>
                </label>
            </div>
            @endif --}}
        </div>

        <!-- Absence List -->
        <div class="space-y-6">
            @forelse($absences as $absence)
                <x-absence-card :absence="$absence" />
            @empty
            <div class="bg-white border border-kej-border rounded-[32px] p-12 sm:p-24 text-center shadow-sm overflow-hidden relative">
                <!-- Decorative background elements -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-64 h-64 bg-kej-bg/50 rounded-full blur-3xl -z-0"></div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-kej-bg rounded-full grid place-items-center mx-auto mb-6 sm:mb-8 text-kej-muted/40 border border-kej-border shadow-inner">
                        <svg width="40" height="40" sm-width="48" sm-height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="font-serif text-xl sm:text-2xl font-black text-kej-navy mb-3">Tidak Ada Data Ditemukan</h3>
                    <p class="text-kej-muted text-sm sm:text-base max-w-sm mx-auto mb-8 sm:mb-10 font-medium leading-relaxed">Sistem tidak menemukan riwayat presensi yang sesuai dengan kriteria filter saat ini.</p>
                    <a href="{{ route('absences.index') }}" class="inline-block bg-kej-navy text-white px-8 sm:px-10 py-3.5 sm:py-4 rounded-xl font-black text-[10px] sm:text-xs uppercase tracking-widest hover:bg-kej-green transition-all shadow-lg shadow-kej-navy/20 active:scale-95">Reset Semua Filter</a>
                </div>
            </div>
            @endforelse
        </div>

        @if($absences->hasPages())
            <div class="mt-12 bg-white border border-kej-border rounded-2xl p-6 shadow-sm">
                {{ $absences->links() }}
            </div>
        @endif
        
        <div class="mt-10 text-center">
            <p class="text-kej-muted text-[11px] font-extrabold uppercase tracking-[0.2em] opacity-60">
                &copy; {{ date('Y') }} Kejaksaan Republik Indonesia — E-PKS Digital Reporting
            </p>
        </div>
    </div>
</div>
@endsection
