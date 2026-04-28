<!-- TERPIDANA GRID -->
<section class="py-20 bg-white" id="terpidana">
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="text-center mb-14">
            <div class="inline-block text-kej-gold-dark font-extrabold text-[11px] tracking-[0.2em] uppercase mb-3.5 px-4 py-1.5 bg-kej-gold/10 rounded-full border border-kej-gold/30">Data Terpidana Aktif</div>
            <h2 class="sec-title">Status Pelaksanaan <span class="accent">Kerja Sosial</span></h2>
            <p class="sec-lead">Daftar terpidana yang sedang menjalani masa pidana kerja sosial di berbagai instansi pemerintah dan sosial.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($pidanas as $index => $pidana)
            <!-- Convict Card {{ $index + 1 }} -->
            <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group animate-fade-in" style="animation-delay: {{ $index * 100 }}ms;">
                <div class="h-1.5 bg-kej-navy group-hover:bg-kej-green transition-colors"></div>
                <div class="p-8">
                    <div class="flex gap-5 mb-8">
                        <div class="relative">
                            <div class="w-16 h-16 bg-kej-bg rounded-2xl grid place-items-center text-kej-navy text-2xl font-serif font-black shrink-0 group-hover:bg-kej-navy transition-all duration-500 transform group-hover:rotate-6">
                                {{ substr($pidana->name, 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-black text-kej-navy group-hover:text-kej-green transition-colors leading-tight mb-1.5">{{ $pidana->name }}</h3>
                            <div class="flex items-center gap-2">
                                <p class="text-[10px] font-black text-kej-muted uppercase tracking-widest">ID: PKS-{{ str_pad($pidana->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="bg-kej-bg/50 rounded-xl p-4 border border-kej-border/50">
                            <div class="flex justify-between items-center text-[12px] mb-3">
                                <span class="text-kej-muted font-bold uppercase tracking-wider">Perkara</span>
                                <span class="text-kej-navy font-black text-right">{{ $pidana->crime ?? 'Pidana Umum' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[12px]">
                                <span class="text-kej-muted font-bold uppercase tracking-wider">Satker</span>
                                <span class="text-kej-navy font-black">KEJARI JAKSEL</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-kej-border flex justify-between items-center">
                        <span class="text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Total Kehadiran</span>
                        <div class="flex items-center gap-2 bg-kej-green/10 px-3 py-1 rounded-lg border border-kej-green/20">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-kej-green"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span class="text-[13px] font-black text-kej-green">{{ $pidana->absences_count }} Hari</span>
                        </div>
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <a href="{{ route('pidana.show', $pidana->id) }}" class="group/btn relative block w-full bg-kej-navy py-4 rounded-xl text-[11px] font-black text-white text-center uppercase tracking-[0.2em] overflow-hidden transition-all hover:bg-kej-green shadow-lg">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Aktivitas Digital
                            <svg class="group-hover/btn:translate-x-1 transition-transform" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
