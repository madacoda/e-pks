<section
    class="relative overflow-hidden bg-gradient-to-br from-kej-green via-[#1a5c2e] to-kej-navy-dark text-white pt-24 pb-28 lg:pt-40 lg:pb-48"
    id="beranda">
    <!-- Background Accents -->
    <div class="absolute inset-0 pointer-events-none opacity-40">
        <div class="absolute top-[10%] left-[5%] w-[30%] h-[30%] bg-kej-gold/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[10%] right-[5%] w-[30%] h-[30%] bg-kej-navy/40 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-[1240px] mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-16 lg:gap-24 xl:gap-32 items-center">
            <!-- Left Column: Text Content -->
            <div class="text-left flex flex-col items-start mt-10 mb-10 px-10">
                <div
                    class="inline-flex items-center gap-2.5 bg-kej-gold/15 border border-kej-gold/30 text-kej-gold px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-[0.2em] mb-12 mt-8 lg:mt-16">
                    <span
                        class="w-1.5 h-1.5 bg-kej-gold rounded-full animate-pulse shadow-[0_0_8px_var(--color-kej-gold)]"></span>
                    Pedoman JA No. 1 Tahun 2025
                </div>

                <h1
                    class="font-serif text-5xl sm:text-6xl lg:text-6xl xl:text-7xl font-black leading-[1.05] tracking-tight mb-8">
                    Sistem <span class="text-kej-gold">E-PKS</span><br>
                    <span class="opacity-90">Pengawasan Pidana</span><br>
                    <span class="text-white/70">Kerja Sosial Digital</span>
                </h1>

                <p class="text-lg lg:text-xl text-white/70 leading-relaxed mb-14 max-w-xl">
                    Platform elektronik resmi Kejaksaan RI untuk pengawasan, absensi real-time, dan pelaporan Pidana
                    Kerja Sosial di seluruh Satuan Kerja se-Indonesia.
                </p>

                <div class="flex flex-col sm:flex-row gap-5 w-full sm:w-auto">
                    <a href="#absensi"
                        class="group bg-kej-gold text-kej-navy-dark px-10 py-5 rounded-xl font-black text-xs uppercase tracking-widest flex items-center justify-center gap-3 transition-all hover:bg-kej-gold-soft hover:-translate-y-1 shadow-[0_15px_30px_rgba(245,178,0,0.25)] min-w-[220px]">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        Absensi Digital
                    </a>

                    <a href="{{ route('pidana.list') }}"
                        class="group bg-white/5 backdrop-blur-md text-white border border-white/20 px-10 py-5 rounded-xl font-black text-xs uppercase tracking-widest flex items-center justify-center gap-3 transition-all hover:bg-white/10 hover:-translate-y-1 shadow-[0_15px_30px_rgba(0,0,0,0.1)] min-w-[220px]">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <line x1="3" y1="9" x2="21" y2="9" />
                            <line x1="9" y1="21" x2="9" y2="9" />
                        </svg>
                        Monitoring
                    </a>
                </div>
            </div>

            <!-- Right Column: Statistics -->
            <div class="flex items-center justify-center md:justify-end h-full mb-10 md:mb-0 px-10">
                <div
                    class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-10 lg:p-14 w-full max-w-[420px]">
                    <div class="grid grid-cols-1 gap-12">
                        <div class="flex items-center gap-8">
                            <div
                                class="w-20 h-20 bg-kej-gold rounded-2xl flex items-center justify-center text-kej-navy transform rotate-3">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-serif text-5xl font-black text-white leading-none mb-2">1.247</div>
                                <div class="text-[11px] font-black text-white/40 uppercase tracking-[0.25em]">Terpidana
                                    Aktif</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div
                                class="w-20 h-20 bg-white/10 border border-white/20 rounded-2xl flex items-center justify-center text-kej-gold transform -rotate-3">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-serif text-5xl font-black text-white leading-none mb-2">514</div>
                                <div class="text-[11px] font-black text-white/40 uppercase tracking-[0.25em]">Kejaksaan
                                    Negeri</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div
                                class="w-20 h-20 bg-white/10 border border-white/20 rounded-2xl flex items-center justify-center text-kej-gold transform rotate-2">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-serif text-5xl font-black text-white leading-none mb-2">34</div>
                                <div class="text-[11px] font-black text-white/40 uppercase tracking-[0.25em]">Kantor
                                    Wilayah
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>