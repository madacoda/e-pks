@extends('layouts.app')

@section('title', 'Kelola User — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Sistem Administrasi</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Kelola <span class="text-kej-green">Database User</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Kelola akses dan data terpidana dalam satu panel terintegrasi.</p>
            </div>
            
            @if(session('success'))
            <div class="bg-kej-green/10 text-kej-green border border-kej-green/20 px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 animate-fade-in">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.settings.index') }}" class="bg-white border border-kej-border text-kej-navy px-4 py-2.5 rounded-lg text-[13px] font-bold hover:bg-kej-navy hover:text-white transition-all flex items-center gap-2 shadow-sm" title="Pengaturan CMS">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </a>
                <a href="{{ route('admin.placements.index') }}" class="bg-white border border-kej-border text-kej-navy px-5 py-2.5 rounded-lg text-[13px] font-bold hover:bg-kej-green hover:text-white transition-all flex items-center gap-2 shadow-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Kelola Satker
                </a>
            </div>
        </div>

        <!-- Monitoring Stats (Enhanced for Phase 2) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-navy/5 rounded-xl flex items-center justify-center text-kej-navy">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Total Terpidana</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $stats['total_pidana'] }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-green/5 rounded-xl flex items-center justify-center text-kej-green">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Aktivitas Absensi</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $stats['total_absences'] }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-gold/5 rounded-xl flex items-center justify-center text-kej-gold-dark">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Form PKS-03</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $stats['total_supervisions'] }}</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.complaints.index') }}" class="block bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md hover:border-red-200 transition-all group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5 group-hover:text-red-600 transition-colors">Laporan Aduan</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $stats['total_complaints'] }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 mb-8">
            <div class="lg:col-span-1">
                <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-kej-border bg-kej-bg/30 flex justify-between items-center">
                        <h3 class="font-serif font-black text-kej-navy text-sm uppercase tracking-wider">Aktivitas Presensi Terbaru</h3>
                        <span class="text-[10px] font-bold text-kej-muted uppercase tracking-widest animate-pulse">Live Monitoring</span>
                    </div>
                    <div class="divide-y divide-kej-border">
                        @forelse($stats['recent_absences'] as $absence)
                            <div class="p-4 flex items-center justify-between hover:bg-kej-bg/20 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-kej-navy/10 rounded-lg flex items-center justify-center text-kej-navy text-[10px] font-black">
                                        {{ strtoupper(substr($absence->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-xs font-black text-kej-navy">{{ $absence->user->name }}</div>
                                        <div class="text-[10px] text-kej-muted font-bold">{{ $absence->created_at->diffForHumans() }} • {{ $absence->location_name ?? 'Lokasi Terverifikasi' }}</div>
                                    </div>
                                </div>
                                <div class="px-3 py-1 bg-kej-green/10 text-kej-green rounded-full text-[9px] font-black uppercase">Hadir</div>
                            </div>
                        @empty
                            <div class="p-10 text-center text-kej-muted italic text-xs">Belum ada aktivitas hari ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- 
            <div class="lg:col-span-1">
                <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm h-full flex flex-col">
                    <div class="px-6 py-4 border-b border-kej-border bg-kej-bg/30 flex justify-between items-center">
                        <h3 class="font-serif font-black text-kej-navy text-sm uppercase tracking-wider">Compliance Rate</h3>
                        <span class="text-[10px] font-bold text-kej-muted uppercase tracking-widest">7 Days</span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div class="flex items-end justify-between h-40 gap-2 relative">
                            @foreach($stats['compliance_chart'] as $data)
                                <div class="flex-1 flex flex-col items-center gap-2 group relative">
                                    <div class="relative w-full bg-kej-bg rounded-t-lg overflow-hidden flex items-end h-32">
                                        <div class="w-full bg-kej-green transition-all duration-1000 ease-out group-hover:bg-kej-gold-dark" 
                                             style="height: {{ $data['rate'] }}%">
                                        </div>
                                    </div>
                                    <div class="text-[9px] font-black text-kej-navy uppercase">{{ $data['day'] }}</div>
                                    
                                    <!-- Tooltip -->
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-kej-navy text-white text-[9px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-10">
                                        {{ $data['rate'] }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-8 pt-6 border-t border-kej-border">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-[10px] font-bold text-kej-muted uppercase tracking-widest">Avg. Compliance</span>
                                <span class="text-sm font-black text-kej-navy">
                                    {{ round(collect($stats['compliance_chart'])->avg('rate')) }}%
                                </span>
                            </div>
                            <div class="w-full bg-kej-bg h-1.5 rounded-full overflow-hidden">
                                <div class="bg-kej-green h-full" style="width: {{ collect($stats['compliance_chart'])->avg('rate') }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
        </div>

        <!-- Filters -->
        <div class="mb-6 animate-fade-in">
            <form action="{{ route('admin.index') }}" method="GET" class="flex items-center gap-4">
                <select name="placement_id" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2.5 bg-white border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none sm:min-w-[250px] shadow-sm">
                    <option value="">-- Semua Satker Yang Menangani --</option>
                    @foreach($placements as $placement)
                        <option value="{{ $placement->id }}" {{ request('placement_id') == $placement->id ? 'selected' : '' }}>
                            {{ $placement->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Main Database Table -->
        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left border-collapse min-w-[640px] lg:min-w-0">
                    <thead>
                        <tr class="bg-kej-bg border-b border-kej-border">
                            <th class="px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em]">User & Identitas</th>
                            <th class="px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em]">Akses</th>
                            <th class="hidden md:table-cell px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em]">Data Personal</th>
                            <th class="hidden lg:table-cell px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em]">Keterangan Perkara</th>
                            <th class="px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em] text-right">Opsi Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kej-border">
                        @foreach($users as $user)
                        <tr class="hover:bg-kej-bg/50 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-10 h-10 bg-kej-navy rounded-xl flex items-center justify-center text-white text-sm font-black shadow-sm group-hover:scale-105 transition-transform overflow-hidden">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                                        @else
                                            {{ strtoupper(substr(trim($user->name), 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-kej-navy truncate max-w-[150px] sm:max-w-none">{{ $user->name }}</div>
                                        <div class="text-[11px] sm:text-xs text-kej-muted truncate max-w-[150px] sm:max-w-none">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex px-2.5 py-1 rounded-md text-[10px] font-black tracking-widest uppercase {{ $user->role === 'admin' ? 'bg-kej-gold/10 text-kej-gold-dark' : 'bg-kej-green/10 text-kej-green' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="hidden md:table-cell px-6 py-5">
                                <div class="text-sm font-semibold text-kej-ink flex items-center gap-2">
                                    <svg class="text-kej-muted/50" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $user->date_of_birth ?? 'Belum Diatur' }}
                                </div>
                            </td>
                            <td class="hidden lg:table-cell px-6 py-5">
                                @if($user->role === 'pidana')
                                    <div class="max-w-[200px]">
                                        <div class="text-[11px] font-black text-kej-navy leading-tight mb-1" title="{{ $user->crime }}">{{ $user->crime ?? '—' }}</div>
                                        <div class="text-[10px] font-bold text-kej-muted leading-tight italic line-clamp-2" title="{{ $user->sentence }}">{{ $user->sentence ?? '—' }}</div>
                                    </div>
                                @else
                                    <div class="text-xs font-bold text-kej-muted italic text-center">— System Admin —</div>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end items-center gap-1 sm:gap-2">
                                    @if($user->role === 'pidana')
                                    <a href="{{ route('absences.index', ['user_id' => $user->id]) }}" class="p-2 sm:p-2.5 text-kej-muted hover:text-kej-green hover:bg-kej-green/10 rounded-xl transition-all" title="Rekapitulasi Presensi Digital">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </a>
                                    <a href="{{ route('admin.pks03-assessment.show', $user->id) }}" class="p-2 sm:p-2.5 text-kej-muted hover:text-kej-gold-dark hover:bg-kej-gold/10 rounded-xl transition-all" title="Penilaian Ketersediaan (PKS-03 Halaman 1)">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                    </a>
                                    <a href="{{ route('admin.supervisions.index', $user->id) }}" class="p-2 sm:p-2.5 text-kej-muted hover:text-kej-navy hover:bg-kej-navy/10 rounded-xl transition-all" title="Catatan Pengawasan (PKS-03 Log)">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><line x1="9" y1="14" x2="15" y2="14"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                                    </a>
                                    @endif
                                    <a href="{{ route('admin.edit', $user->id) }}" class="p-2 sm:p-2.5 text-kej-muted hover:text-kej-green hover:bg-kej-green/10 rounded-xl transition-all" title="Edit Profiling & User">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if(count($users) === 0)
            <div class="py-20 text-center">
                <div class="w-16 h-16 bg-kej-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="text-kej-muted" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="text-kej-navy font-bold">Belum Ada Data</h3>
                <p class="text-kej-muted text-sm">Database user saat ini masih kosong.</p>
            </div>
            @endif
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-kej-muted text-[11px] font-medium uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} Kejaksaan Republik Indonesia — E-PKS Digital Panel
            </p>
        </div>
    </div>
</div>
@endsection

