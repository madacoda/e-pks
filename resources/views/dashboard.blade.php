@extends('layouts.app')

@section('title', 'Dashboard E-PKS')

@section('content')
    <div class="bg-kej-bg min-h-screen py-10">
        <div class="max-w-[1240px] mx-auto px-6">
            <!-- Dashboard Header -->
            <div class="flex flex-wrap justify-between items-end gap-5 mb-10">
                <div>
                    <div class="text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-2">Portal
                        Terpidana</div>
                    <h1 class="font-serif text-3xl font-black text-kej-navy tracking-tight">Selamat Datang, <span
                            class="text-kej-green">{{ Auth::user()->name }}</span></h1>
                </div>
                <div class="flex gap-3">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.index') }}"
                            class="bg-kej-navy text-white px-5 py-2.5 rounded-lg text-[13px] font-bold hover:bg-kej-green transition-all flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                            </svg>
                            Admin Panel
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-white border border-kej-border text-kej-navy px-5 py-2.5 rounded-lg text-[13px] font-bold hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm group">
                        <div
                            class="h-32 bg-gradient-to-br from-kej-navy via-kej-navy-2 to-kej-green relative overflow-hidden">
                            <div
                                class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--color-kej-gold)_1px,_transparent_1px)] [background-size:20px_20px]">
                            </div>
                        </div>
                        <div class="px-6 pb-8 relative">
                            <!-- Profile Header - Simplified without avatar -->
                            <div class="pt-8 pb-6 text-center mb-5">
                                <h3 class="font-serif text-2xl font-black text-kej-navy mb-1 leading-tight">
                                    {{ Auth::user()->name }}
                                </h3>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-kej-green/10 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-kej-green rounded-full"></span>
                                    <span
                                        class="text-[10px] font-black text-kej-green tracking-[0.15em] uppercase">{{ Auth::user()->role === 'admin' ? 'PETUGAS KEJAKSAAN' : 'TERPIDANA KERJA SOSIAL' }}</span>
                                </div>
                            </div>

                            <!-- Info Items -->
                            <div class="space-y-1.5 pt-6 border-t border-kej-border/60">
                                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-kej-bg transition-colors">
                                    <div
                                        class="w-10 h-10 bg-white border border-kej-border/50 rounded-lg grid place-items-center text-kej-muted shadow-sm">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span
                                            class="block text-[10px] text-kej-muted font-bold uppercase tracking-wider leading-none mb-1">Email
                                            Resmi</span>
                                        <span
                                            class="block font-semibold text-kej-ink truncate">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-kej-bg transition-colors">
                                    <div
                                        class="w-10 h-10 bg-white border border-kej-border/50 rounded-lg grid place-items-center text-kej-muted shadow-sm">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span
                                            class="block text-[10px] text-kej-muted font-bold uppercase tracking-wider leading-none mb-1">Tanggal
                                            Lahir</span>
                                        <span
                                            class="block font-semibold text-kej-ink">{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d F Y') : '-' }}</span>
                                    </div>
                                </div>

                                @if(Auth::user()->crime)
                                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-kej-bg transition-colors">
                                        <div
                                            class="w-10 h-10 bg-white border border-kej-border/50 rounded-lg grid place-items-center text-kej-muted shadow-sm">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <span
                                                class="block text-[10px] text-kej-muted font-bold uppercase tracking-wider leading-none mb-1">Klasifikasi
                                                Perkara</span>
                                            <span
                                                class="block font-semibold text-kej-ink leading-snug">{{ Auth::user()->crime }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Status Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-white border border-kej-border rounded-2xl p-6 shadow-sm flex items-center gap-5">
                            <div class="w-14 h-14 bg-kej-green/10 rounded-xl grid place-items-center text-kej-green">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-kej-muted uppercase tracking-widest mb-1">Total Kehadiran</div>
                                <div class="font-serif text-2xl font-black text-kej-navy leading-none">
                                    {{ $totalSessions }} <small class="text-xs font-bold text-kej-muted uppercase ml-2 tracking-normal">Hari</small>
                                </div>
                                <a href="{{ route('absences.index') }}"
                                    class="text-[10px] font-bold text-kej-green hover:underline mt-2 inline-block">LIHAT
                                    SEMUA RIWAYAT</a>
                            </div>
                        </div>
                        <div class="bg-white border border-kej-border rounded-2xl p-6 shadow-sm flex items-center gap-5">
                            <div class="w-14 h-14 bg-kej-gold/10 rounded-xl grid place-items-center text-kej-gold-dark">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-kej-muted uppercase tracking-widest mb-1">Status Hari
                                    Ini</div>
                                <div class="font-serif text-2xl font-black {{ $statusColor }} leading-none">{{ $status }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
                        <div class="px-6 py-4 border-b border-kej-border bg-kej-bg/30 flex justify-between items-center">
                            <h3 class="font-serif font-black text-kej-navy text-sm uppercase tracking-wider">Aktivitas
                                Terbaru</h3>
                            <a href="{{ route('absences.index') }}"
                                class="text-[11px] font-bold text-kej-green hover:underline">LIHAT SEMUA</a>
                        </div>
                        <div class="divide-y divide-kej-border">
                            @forelse($recentAbsences as $absence)
                                <div class="p-4 flex items-center gap-4 hover:bg-kej-bg/20 transition-colors">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 border border-kej-border">
                                        <img src="{{ Storage::disk('public')->url($absence->image_path) }}"
                                            class="w-full h-full object-cover" alt="Selfie">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start">
                                            <h4 class="font-bold text-kej-ink text-sm truncate">
                                                {{ $absence->location_name ?? 'Lokasi Terverifikasi' }}
                                            </h4>
                                            <span
                                                class="text-[10px] font-bold text-kej-muted whitespace-nowrap">{{ $absence->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="w-2 h-2 rounded-full bg-kej-green"></span>
                                            <span class="text-[11px] text-kej-muted">Presensi Berhasil —
                                                {{ $absence->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center text-kej-muted italic text-sm">
                                    Belum ada aktivitas presensi terbaru.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Action Card -->
                    <div
                        class="bg-white border border-kej-border rounded-2xl p-8 shadow-sm text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-10 opacity-[0.03]">
                            <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                        </div>
                        <div class="relative z-10">
                            <h3 class="font-serif text-xl font-black text-kej-navy mb-3">Lakukan Presensi Hari Ini</h3>
                            <p class="text-[15px] text-kej-muted mb-8 max-w-md mx-auto">Pastikan Anda berada di lokasi kerja
                                sosial sebelum menekan tombol presensi. Sistem akan memvalidasi selfie dan GPS Anda.</p>
                            <a href="{{ route('absences.create') }}"
                                class="inline-flex items-center gap-3 bg-kej-green text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-[0_10px_20px_rgba(26,110,48,0.2)] hover:bg-kej-gold hover:text-kej-navy transition-all transform hover:-translate-y-1">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                    <circle cx="12" cy="13" r="4" />
                                </svg>
                                Mulai Presensi Digital
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection