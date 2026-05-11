@extends('layouts.app')

@section('title', 'Pengaturan CMS — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('admin.index') }}" class="text-[11px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy mb-1 leading-tight">Pengaturan Sistem & Konten</h1>
                <p class="text-xs sm:text-sm text-kej-muted">Kelola konten statis seperti Aturan PKS-06a langsung dari panel ini.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-50 text-green-800 border border-green-200 rounded-xl p-4 mb-6 text-sm flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        <form action="{{ route('admin.settings.store') }}" method="POST">
            @csrf

            <div class="bg-white border border-kej-border rounded-2xl shadow-sm mb-6 overflow-hidden">
                <div class="p-6 sm:p-8 space-y-8">
                    
                    <div>
                        <h3 class="text-sm font-bold text-kej-navy uppercase tracking-widest mb-4 border-b border-kej-border pb-2">A. Konten Halaman Peraturan (PKS-06a)</h3>
                        <p class="text-xs text-kej-muted mb-4">Gunakan setiap baris (enter) sebagai satu poin list untuk Kewajiban dan Larangan.</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-kej-navy uppercase mb-2">1. Kewajiban Terpidana</label>
                                @php
                                    $kewajibanArray = json_decode($regulations_kewajiban, true) ?? [];
                                    $kewajibanText = implode("\n", $kewajibanArray);
                                @endphp
                                <textarea name="regulations_kewajiban" rows="6" class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-3" required>{{ old('regulations_kewajiban', $kewajibanText) }}</textarea>
                                @error('regulations_kewajiban') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-kej-navy uppercase mb-2">2. Larangan & Sanksi</label>
                                @php
                                    $laranganArray = json_decode($regulations_larangan, true) ?? [];
                                    $laranganText = implode("\n", $laranganArray);
                                @endphp
                                <textarea name="regulations_larangan" rows="6" class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-3" required>{{ old('regulations_larangan', $laranganText) }}</textarea>
                                @error('regulations_larangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-kej-navy uppercase mb-2">3. Penjelasan Monitoring Digital</label>
                                <textarea name="regulations_monitoring" rows="4" class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-3" required>{{ old('regulations_monitoring', $regulations_monitoring) }}</textarea>
                                @error('regulations_monitoring') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="px-6 py-4 bg-kej-bg border-t border-kej-border flex justify-end">
                    <button type="submit" class="bg-kej-navy hover:bg-kej-navy-light text-white px-8 py-3 rounded-xl text-xs font-black tracking-widest uppercase transition-colors shadow-sm flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
