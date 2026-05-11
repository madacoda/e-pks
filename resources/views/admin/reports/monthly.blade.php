@extends('layouts.app')

@section('title', 'Laporan Bulanan — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6">
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <a href="{{ route('admin.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                    <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                    </div>
                    Kembali ke Daftar User
                </a>
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Monitoring Kehadiran</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Laporan <span class="text-kej-green">Bulanan</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Terpidana: <span class="font-black text-kej-navy">{{ $user->name }}</span></p>
            </div>
            
            <form action="{{ route('admin.reports.monthly', $user) }}" method="GET" class="flex gap-2 bg-white p-2 rounded-xl border border-kej-border shadow-sm">
                <select name="month" class="text-xs font-bold text-kej-navy bg-kej-bg border-none rounded-lg px-3 py-2 outline-none">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                    @endfor
                </select>
                <select name="year" class="text-xs font-bold text-kej-navy bg-kej-bg border-none rounded-lg px-3 py-2 outline-none">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="bg-kej-navy text-white px-4 py-2 rounded-lg font-black text-[10px] uppercase tracking-widest hover:bg-kej-green transition-all">Filter</button>
            </form>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm mb-6">
            <div class="p-6 border-b border-kej-border flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-kej-bg rounded-xl flex items-center justify-center text-kej-navy">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-kej-navy">Rekapitulasi Kehadiran</h3>
                        <p class="text-[10px] text-kej-muted font-bold uppercase tracking-tight">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.export.monthly', ['user' => $user, 'month' => $month, 'year' => $year]) }}" class="bg-kej-green/10 text-kej-green px-4 py-2 rounded-lg font-black text-[10px] uppercase tracking-widest hover:bg-kej-green hover:text-white transition-all flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export PDF
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-kej-bg/50">
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Tanggal</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Waktu</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Lokasi</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em] text-center">Foto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kej-border">
                        @forelse($absences as $absence)
                        <tr class="hover:bg-kej-bg/30 transition-colors">
                            <td class="px-6 py-5">
                                <div class="text-xs font-black text-kej-navy">{{ $absence->created_at->format('d M Y') }}</div>
                                <div class="text-[10px] text-kej-muted font-bold">{{ $absence->created_at->translatedFormat('l') }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-kej-navy">{{ $absence->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-kej-navy">{{ $absence->location_name ?? 'Lokasi tidak terdeteksi' }}</div>
                                <div class="text-[9px] text-kej-muted font-mono mt-1">{{ $absence->latitude }}, {{ $absence->longitude }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-2 py-1 rounded-md text-[9px] font-black uppercase tracking-wider {{ $absence->status === 'hadir' ? 'bg-kej-green/10 text-kej-green' : 'bg-kej-red/10 text-kej-red' }}">
                                    {{ $absence->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($absence->image_path)
                                    <button onclick="window.open('{{ asset('storage/' . $absence->image_path) }}', '_blank')" class="w-10 h-10 rounded-lg overflow-hidden border border-kej-border hover:border-kej-navy transition-all mx-auto">
                                        <img src="{{ asset('storage/' . $absence->image_path) }}" class="w-full h-full object-cover">
                                    </button>
                                @else
                                    <span class="text-[9px] text-kej-muted font-bold italic">No Photo</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 bg-kej-bg rounded-full flex items-center justify-center text-kej-muted">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </div>
                                    <div class="text-xs font-bold text-kej-muted uppercase tracking-widest">Tidak ada data kehadiran di bulan ini</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
