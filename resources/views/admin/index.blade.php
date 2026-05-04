@extends('layouts.app')

@section('title', 'Manajemen User — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Sistem Administrasi</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Manajemen <span class="text-kej-green">Database User</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Kelola akses dan data terpidana dalam satu panel terintegrasi.</p>
            </div>
            
            @if(session('success'))
            <div class="bg-kej-green/10 text-kej-green border border-kej-green/20 px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 animate-fade-in">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Stats Overview (New for "WOW" and Utility) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-navy/5 rounded-xl flex items-center justify-center text-kej-navy">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Total User</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ count($users) }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-green/5 rounded-xl flex items-center justify-center text-kej-green">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Admin</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $users->where('role', 'admin')->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-kej-border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-kej-gold/5 rounded-xl flex items-center justify-center text-kej-gold-dark">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="17" y1="11" x2="23" y2="11"/></svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-kej-muted uppercase tracking-wider mb-0.5">Terpidana</div>
                        <div class="text-2xl font-black text-kej-navy leading-none">{{ $users->where('role', 'pidana')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-6 animate-fade-in">
            <form action="{{ route('admin.index') }}" method="GET" class="flex items-center gap-4">
                <select name="placement_id" onchange="this.form.submit()" class="px-4 py-2.5 bg-white border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none min-w-[250px] shadow-sm">
                    <option value="">-- Semua Lokasi Penempatan --</option>
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
                            <th class="px-6 py-4 text-[10px] sm:text-[11px] font-black text-kej-muted uppercase tracking-[0.15em] text-right">Manajemen</th>
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
                                <div class="text-sm font-semibold text-kej-ink max-w-[240px] truncate italic text-kej-muted">
                                    {{ $user->crime ?? '—' }}
                                </div>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end items-center gap-1 sm:gap-2">
                                    <a href="{{ route('admin.edit', $user->id) }}" class="p-2 sm:p-2.5 text-kej-muted hover:text-kej-green hover:bg-kej-green/10 rounded-xl transition-all" title="Edit User">
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

