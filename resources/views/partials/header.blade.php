<header class="sticky top-0 z-[100] bg-white/95 backdrop-blur-md border-b border-kej-border shadow-sm"
    x-data="{ mobileMenu: false }">
    <div class="max-w-[1240px] mx-auto px-6 py-3 flex justify-between items-center gap-5">
        <!-- Brand Section -->
        <a class="flex items-center gap-4 group" href="/">
            <div
                class="w-[62px] h-[62px] bg-kej-navy rounded-xl flex items-center justify-center p-2 shadow-lg group-hover:bg-kej-green transition-colors duration-300">
                <svg viewBox="0 0 24 24" class="w-full h-full text-white fill-current"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    <circle cx="12" cy="10" r="3" class="text-kej-gold fill-current" />
                </svg>
            </div>
            <div class="hidden sm:block">
                <div class="font-serif font-black text-xl text-kej-green leading-[1.1] tracking-tight">E-PKS</div>
                <div class="text-kej-navy text-[13px] font-bold mt-0.5">Elektronik Pengawasan Kerja Sosial</div>
                <div class="text-[10px] uppercase tracking-[0.15em] text-kej-muted font-bold mt-0.5">Kejaksaan Republik
                    Indonesia</div>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:block">
            <ul class="flex items-center gap-1 list-none">
                <li><a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-kej-navy bg-kej-gold/10 border-b-2 border-kej-gold' : 'text-kej-ink hover:bg-kej-bg hover:text-kej-navy' }} rounded-t px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Beranda</a>
                </li>
                <li><a href="#absensi"
                        class="text-kej-ink hover:bg-kej-bg hover:text-kej-navy rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Absensi</a>
                </li>
                <li><a href="{{ route('pidana.list') }}"
                        class="{{ request()->routeIs('pidana.*') ? 'text-kej-navy bg-kej-gold/10 border-b-2 border-kej-gold' : 'text-kej-ink hover:bg-kej-bg hover:text-kej-navy' }} rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Monitoring</a>
                </li>
                <li><a href="{{ route('regulations') }}"
                        class="{{ request()->routeIs('regulations') ? 'text-kej-navy bg-kej-gold/10 border-b-2 border-kej-gold' : 'text-kej-ink hover:bg-kej-bg hover:text-kej-navy' }} rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Hukum</a>
                </li>
                <li><a href="{{ route('complaints.create') }}"
                        class="{{ request()->routeIs('complaints.*') ? 'text-kej-navy bg-kej-gold/10 border-b-2 border-kej-gold' : 'text-kej-ink hover:bg-kej-bg hover:text-kej-navy' }} rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Aduan</a>
                </li>
            </ul>
        </nav>

        <!-- Right Side Actions -->
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}"
                    class="hidden sm:flex items-center gap-3 bg-kej-bg text-kej-navy px-4 py-2 rounded-lg font-bold text-[13px] hover:bg-kej-border transition-all border border-kej-border/50">
                    <div
                        class="w-7 h-7 bg-kej-navy rounded-md flex items-center justify-center text-white text-[10px] font-black overflow-hidden shadow-sm">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="">
                        @else
                            {{ strtoupper(substr(trim(Auth::user()->name), 0, 1)) }}
                        @endif
                    </div>
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="hidden sm:flex items-center gap-2 bg-kej-green text-white px-5 py-2.5 rounded-lg font-bold text-[13px] border-2 border-kej-green hover:bg-kej-gold hover:text-kej-navy hover:border-kej-gold transition-all shadow-md">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Login E-PKS
                </a>
            @endauth

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenu = !mobileMenu"
                class="lg:hidden p-2 text-kej-navy hover:bg-kej-bg rounded-lg transition-all">
                <svg x-show="!mobileMenu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
                <svg x-show="mobileMenu" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <template x-if="true">
        <div x-show="mobileMenu" 
            class="fixed inset-0 z-[90] lg:hidden"
            @click="mobileMenu = false">
            <div class="absolute inset-0 bg-kej-navy/40 backdrop-blur-sm transition-opacity"
                x-show="mobileMenu"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>
            
            <div class="absolute top-[80px] left-6 right-6 bg-white rounded-2xl shadow-2xl border border-kej-border overflow-hidden transform transition-all"
                x-show="mobileMenu"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                @click.stop>
                <div class="p-6">
                    <ul class="space-y-1">
                        <li><a href="{{ route('home') }}"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold {{ request()->routeIs('home') ? 'text-kej-navy bg-kej-bg' : 'text-kej-ink hover:bg-kej-bg' }} transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                Beranda
                            </a></li>
                        <li><a href="#absensi" @click="mobileMenu = false"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold text-kej-ink hover:bg-kej-bg transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Sistem Absensi
                            </a></li>
                        <li><a href="{{ route('pidana.list') }}"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold {{ request()->routeIs('pidana.*') ? 'text-kej-navy bg-kej-bg' : 'text-kej-ink hover:bg-kej-bg' }} transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                Monitoring Terpidana
                            </a></li>
                        <li><a href="{{ route('regulations') }}"
                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold {{ request()->routeIs('regulations') ? 'text-kej-navy bg-kej-bg' : 'text-kej-ink hover:bg-kej-bg' }} transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                Dasar Hukum
                            </a></li>
                        <li class="pt-4 mt-2 border-t border-kej-border">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="w-full flex items-center justify-center gap-3 bg-kej-navy text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full flex items-center justify-center gap-3 bg-kej-green text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                    Login E-PKS
                                </a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </template>
</header>