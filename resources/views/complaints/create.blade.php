@extends('layouts.app')

@section('title', 'Layanan Aduan — E-PKS Kejaksaan RI')

@section('content')
<div class="bg-kej-bg min-h-screen py-10 lg:py-16">
    <div class="max-w-[420px] mx-auto px-4 sm:px-6">
        <div class="mb-10 text-center animate-fade-in">
            <div class="text-[10px] sm:text-[11px] font-black text-kej-gold-dark tracking-[0.25em] uppercase mb-3 px-4 py-1.5 bg-kej-gold/10 rounded-full border border-kej-gold/30 inline-block">
                Public Service
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-black text-kej-navy tracking-tight leading-tight mb-4">
                Layanan <span class="text-kej-green">Aduan Masyarakat</span>
            </h1>
            <p class="text-sm text-kej-muted leading-relaxed">
                Sampaikan keluhan, masukan, atau laporan terkait pelaksanaan Pidana Kerja Sosial secara transparan dan akuntabel.
            </p>
        </div>

        <div class="bg-white border border-kej-border rounded-3xl overflow-hidden shadow-sm animate-fade-in" style="animation-delay: 0.1s">
            <div class="p-6 sm:p-8">
                <form action="{{ route('complaints.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    @guest
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Pengadu (Opsional)</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama Anda"
                                class="w-full px-4 py-3.5 bg-kej-bg border border-kej-border rounded-2xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat Email (Opsional)</label>
                            <input type="email" id="email" name="email" placeholder="Untuk menerima update status"
                                class="w-full px-4 py-3.5 bg-kej-bg border border-kej-border rounded-2xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                            <p class="text-[10px] text-kej-muted mt-2 font-bold uppercase tracking-tight">Email dibutuhkan jika Anda ingin menerima notifikasi status laporan</p>
                        </div>
                    </div>
                    @endguest

                    <div>
                        <label for="subject" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Subjek / Judul Aduan</label>
                        <input type="text" id="subject" name="subject" required placeholder="Contoh: Ketidakhadiran Terpidana, Masalah Lokasi, dll."
                            class="w-full px-4 py-3.5 bg-kej-bg border border-kej-border rounded-2xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                    </div>

                    <div>
                        <label for="content" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Detail Isi Aduan</label>
                        <textarea id="content" name="content" rows="6" required placeholder="Jelaskan secara detail laporan atau masukan Anda..."
                            class="w-full px-4 py-3.5 bg-kej-bg border border-kej-border rounded-2xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-kej-navy text-white py-4 rounded-2xl font-black text-sm tracking-widest uppercase hover:bg-kej-green transition-all shadow-lg active:scale-95 flex items-center justify-center gap-3">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            Kirim Aduan Sekarang
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-kej-bg px-6 sm:px-8 py-5 border-t border-kej-border flex items-center gap-4 text-[11px] text-kej-muted font-bold uppercase tracking-wider">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Layanan ini dijamin kerahasiaannya oleh Kejaksaan Republik Indonesia
            </div>
        </div>
    </div>
</div>
@endsection
