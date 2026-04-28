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
                <li><a href="#simulasi"
                        class="text-kej-ink hover:bg-kej-bg hover:text-kej-navy rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Simulasi</a>
                </li>
                <li><a href="#dasar-hukum"
                        class="text-kej-ink hover:bg-kej-bg hover:text-kej-navy rounded px-4 py-2.5 text-[13px] font-bold transition-all uppercase tracking-wider">Hukum</a>
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
    <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-white border-t border-kej-border shadow-xl absolute w-full left-0 py-4 px-6 z-50"
        style="display: none;">
        <ul class="space-y-2">
            <li><a href="{{ route('home') }}"
                    class="block px-4 py-3 rounded-lg font-bold text-kej-navy bg-kej-bg">Beranda</a></li>
            <li><a href="#absensi"
                    class="block px-4 py-3 rounded-lg font-bold text-kej-ink hover:bg-kej-bg transition-all">Sistem
                    Absensi</a></li>
            <li><a href="{{ route('pidana.list') }}"
                    class="block px-4 py-3 rounded-lg font-bold text-kej-ink hover:bg-kej-bg transition-all">Monitoring
                    Terpidana</a></li>
            <li><a href="#simulasi"
                    class="block px-4 py-3 rounded-lg font-bold text-kej-ink hover:bg-kej-bg transition-all">Simulasi
                    Peta</a></li>
            <li><a href="#dasar-hukum"
                    class="block px-4 py-3 rounded-lg font-bold text-kej-ink hover:bg-kej-bg transition-all">Dasar
                    Hukum</a></li>
            <li class="pt-4 border-t border-kej-border">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="w-full flex items-center justify-center gap-2 bg-kej-navy text-white py-3 rounded-xl font-bold">Dashboard
                        Sistem</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center gap-2 bg-kej-green text-white py-3 rounded-xl font-bold">Login
                        E-PKS</a>
                @endauth
            </li>
        </ul>
    </div>
</header>