@extends('layouts.app')

@section('title', 'Pedoman & Aturan PKS-06a — E-PKS Kejaksaan RI')

@section('content')
<div class="bg-kej-bg min-h-screen py-10 lg:py-16">
    <div class="max-w-[1000px] mx-auto px-6">
        <div class="mb-12 animate-fade-in">
            <div class="text-[10px] sm:text-[11px] font-black text-kej-gold-dark tracking-[0.25em] uppercase mb-3 px-4 py-1.5 bg-kej-gold/10 rounded-full border border-kej-gold/30 inline-block">
                Legalitas & Pedoman
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-black text-kej-navy tracking-tight leading-tight mb-4">
                Aturan & <span class="text-kej-green">Ketentuan</span> (PKS-06a)
            </h1>
            <p class="text-sm sm:text-lg text-kej-muted max-w-3xl leading-relaxed">
                Berdasarkan Pedoman Jaksa Agung Nomor 1 Tahun 2025 tentang Pelaksanaan Pidana Kerja Sosial.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8">
            {{-- Document Card --}}
            <div class="bg-white border border-kej-border rounded-3xl overflow-hidden shadow-sm">
                <div class="p-8 lg:p-12">
                    <div class="flex items-center gap-4 mb-10 border-b border-kej-border pb-8">
                        <div class="w-16 h-16 bg-kej-navy rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-serif text-xl sm:text-2xl font-black text-kej-navy">Pedoman Pelaksanaan PKS</h2>
                            <p class="text-xs font-bold text-kej-muted uppercase tracking-widest">Kode Dokumen: PKS-06a</p>
                        </div>
                    </div>

                    <div class="space-y-32">
                        {{-- Section 1 --}}
                        <div class="animate-fade-in mb-3" style="animation-delay: 0.1s">
                            <h3 class="flex items-center gap-3 text-sm font-black text-kej-navy uppercase tracking-widest mb-4">
                                <span class="w-8 h-8 bg-kej-green text-white rounded-lg flex items-center justify-center text-[10px]">01</span>
                                Kewajiban Terpidana
                            </h3>
                            <ul class="space-y-2 ml-11">
                                <li class="flex gap-4">
                                    <div class="mt-1.5 w-1.5 h-1.5 bg-kej-gold rounded-full shrink-0"></div>
                                    <p class="text-sm text-kej-muted leading-relaxed font-semibold">Wajib hadir tepat waktu di lokasi kerja sosial yang telah ditentukan (Satker) sesuai jadwal yang disepakati.</p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="mt-1.5 w-1.5 h-1.5 bg-kej-gold rounded-full shrink-0"></div>
                                    <p class="text-sm text-kej-muted leading-relaxed font-semibold">Melakukan presensi digital secara real-time menggunakan aplikasi E-PKS (Selfie & GPS) pada saat mulai dan selesai kegiatan.</p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="mt-1.5 w-1.5 h-1.5 bg-kej-gold rounded-full shrink-0"></div>
                                    <p class="text-sm text-kej-muted leading-relaxed font-semibold">Menjaga sikap, perilaku, dan etika selama menjalankan tugas kerja sosial di lingkungan masyarakat atau instansi terkait.</p>
                                </li>
                                <li class="flex gap-4">
                                    <div class="mt-1.5 w-1.5 h-1.5 bg-kej-gold rounded-full shrink-0"></div>
                                    <p class="text-sm text-kej-muted leading-relaxed font-semibold">Dilarang meninggalkan wilayah hukum tempat pelaksanaan PKS tanpa izin tertulis dari Jaksa Pengawas.</p>
                                </li>
                            </ul>
                        </div>

                        {{-- Section 2 --}}
                        <div class="animate-fade-in mb-3" style="animation-delay: 0.2s">
                            <h3 class="flex items-center gap-3 text-sm font-black text-kej-navy uppercase tracking-widest mb-4">
                                <span class="w-8 h-8 bg-kej-green text-white rounded-lg flex items-center justify-center text-[10px]">02</span>
                                Larangan & Sanksi
                            </h3>
                            <div class="bg-kej-bg rounded-2xl p-6 border border-kej-border ml-11">
                                <p class="text-xs text-kej-navy font-bold leading-relaxed mb-4 italic">Setiap pelanggaran terhadap pedoman ini akan dicatat dalam Form PKS-03 dan dapat berakibat pada:</p>
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-[13px] font-bold text-red-600">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                        Pemberian Surat Peringatan (SP 1, 2, dan 3).
                                    </li>
                                    <li class="flex items-center gap-3 text-[13px] font-bold text-red-600">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                        Penambahan durasi jam kerja sosial sebagai bentuk penalti.
                                    </li>
                                    <li class="flex items-center gap-3 text-[13px] font-bold text-red-600">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                        Pelaporan kepada Pengadilan untuk evaluasi status pidana (Kemungkinan eksekusi pidana penjara).
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Section 3 --}}
                        <div class="animate-fade-in mb-3" style="animation-delay: 0.3s">
                            <h3 class="flex items-center gap-3 text-sm font-black text-kej-navy uppercase tracking-widest mb-4">
                                <span class="w-8 h-8 bg-kej-green text-white rounded-lg flex items-center justify-center text-[10px]">03</span>
                                Monitoring Digital
                            </h3>
                            <p class="text-sm text-kej-muted leading-relaxed font-semibold ml-11 mb-4">
                                Jaksa Pengawas menggunakan dashboard E-PKS untuk memantau keberadaan dan aktivitas Terpidana. Sistem secara otomatis memberikan notifikasi jika Terpidana berada di luar radius lokasi yang ditentukan atau tidak melakukan presensi sesuai jadwal.
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ml-11 mb-10">
                                <div class="p-4 bg-kej-bg border border-kej-border rounded-xl flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-kej-green shadow-sm">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    </div>
                                    <span class="text-[11px] font-black text-kej-navy uppercase tracking-wider">Geofencing Lokasi</span>
                                </div>
                                <div class="p-4 bg-kej-bg border border-kej-border rounded-xl flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-kej-navy shadow-sm">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                    </div>
                                    <span class="text-[11px] font-black text-kej-navy uppercase tracking-wider">Verifikasi Wajah</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 pt-10 border-t border-kej-border text-center">
                        <p class="text-[10px] font-black text-kej-muted uppercase tracking-[0.3em] mb-4 mt-3">Ditetapkan oleh</p>
                        <h4 class="font-serif text-lg font-black text-kej-navy">Jaksa Agung Republik Indonesia</h4>
                        <div class="w-24 h-1 bg-kej-gold mx-auto mt-4 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
