@extends('layouts.app')

@section('title', 'Login E-PKS — Elektronik Pengawasan Kerja Sosial')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-20 bg-kej-bg relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-40">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-kej-green rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-kej-gold rounded-full blur-[120px]"></div>
    </div>

    <div class="w-full max-w-md px-6 relative z-10">
        <div class="bg-white border border-kej-border shadow-[0_20px_50px_rgba(12,45,94,0.12)] rounded-2xl overflow-hidden">
            <div class="bg-kej-navy p-8 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-kej-navy to-kej-green opacity-40"></div>
                <div class="relative z-10">
                    <img src="{{ asset('assets/apple-touch-icon.png') }}" class="w-20 h-20 mx-auto mb-4 object-contain filter drop-shadow-lg rounded-xl" alt="Kejaksaan Logo">
                    <h2 class="font-serif font-black text-2xl text-kej-gold tracking-tight mb-1">E-PKS LOGIN</h2>
                    <p class="text-white/70 text-xs font-semibold tracking-widest uppercase">Kejaksaan Republik Indonesia</p>
                </div>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    {{ $errors->first() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-kej-muted">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-11 pr-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green focus:ring-4 focus:ring-kej-green/10 transition-all font-semibold"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold text-kej-navy uppercase tracking-widest">Kata Sandi</label>
                            <a href="#" class="text-[11px] font-bold text-kej-green hover:text-kej-navy transition-colors">Lupa Sandi?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-kej-muted">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="w-full pl-11 pr-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green focus:ring-4 focus:ring-kej-green/10 transition-all font-semibold"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 border-kej-border rounded text-kej-green focus:ring-kej-green/20">
                        <label for="remember" class="ml-2.5 text-[12px] font-semibold text-kej-muted cursor-pointer">Ingat Saya</label>
                    </div>

                    <button type="submit" class="w-full bg-kej-green text-white py-3.5 rounded-xl font-black text-sm tracking-widest uppercase shadow-[0_10px_25px_rgba(26,110,48,0.3)] hover:bg-kej-gold hover:text-kej-navy hover:shadow-[0_10px_25px_rgba(245,178,0,0.3)] transition-all transform hover:-translate-y-0.5">
                        Masuk Sistem
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-kej-border text-center">
                    <p class="text-[12px] text-kej-muted">
                        Bukan Petugas? <a href="/" class="text-kej-green font-bold hover:underline">Kembali ke Beranda</a>
                    </p>
                </div>
            </div>
        </div>
        
        <p class="text-center mt-8 text-[11px] text-kej-muted font-bold tracking-wider uppercase">
            &copy; 2026 PUSDANTIN KEJAKSAAN AGUNG RI
        </p>
    </div>
</div>
@endsection
