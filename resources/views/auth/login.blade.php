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
                    <img src="data:image/jpeg;base64,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" class="w-20 h-20 mx-auto mb-4 object-contain filter drop-shadow-lg" alt="Kejaksaan Logo">
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
