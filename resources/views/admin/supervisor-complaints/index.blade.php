@extends('layouts.app')

@section('title', 'Layanan Aduan Pembimbing — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6">
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Admin Panel</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Aduan <span class="text-kej-green">Pembimbing</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Catatan kepatuhan terpidana dari pembimbing kemasyarakatan.</p>
            </div>
            <a href="{{ route('admin.supervisor-complaints.create') }}" class="bg-kej-navy text-white px-6 py-3 rounded-xl font-black text-[11px] tracking-widest uppercase hover:bg-kej-green transition-all shadow-md flex items-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Aduan
            </a>
        </div>

        @if(session('success'))
        <div class="bg-kej-green/10 border border-kej-green text-kej-green px-4 py-3 rounded-xl mb-6 text-sm font-bold flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-kej-bg border-b border-kej-border">
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Tanggal & Pembimbing</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Terpidana</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Catatan Kepatuhan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kej-border">
                        @forelse($complaints as $complaint)
                        <tr class="hover:bg-kej-bg/50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="text-xs font-black text-kej-navy">{{ $complaint->created_at->format('d M Y H:i') }}</div>
                                <div class="text-[10px] font-bold text-kej-muted mt-1 uppercase">{{ $complaint->supervisor_name }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-black text-kej-navy">{{ $complaint->pidana->name }}</div>
                                <div class="text-[10px] font-bold text-kej-muted mt-1">NIK: {{ $complaint->pidana->national_id }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs text-kej-muted max-w-[300px]">{!! nl2br(e($complaint->compliance_notes)) !!}</div>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <form action="{{ route('admin.supervisor-complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Hapus catatan aduan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center text-kej-muted italic text-sm">Belum ada catatan aduan pembimbing.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
