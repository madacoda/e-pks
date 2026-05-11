<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'E-PKS — Elektronik Pengawasan Kerja Sosial | Kejaksaan Republik Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'Platform resmi pengawasan pelaksanaan Pidana Kerja Sosial berbasis elektronik sesuai Pedoman Jaksa Agung Nomor 1 Tahun 2025.')" />
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Open+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes blink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0.3; } }
        @keyframes ticker-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        @keyframes scan { 0%, 100% { top: 5%; } 50% { top: 90%; } }
        @keyframes pulse-ring { 0% { transform: translate(-50%, -50%) rotate(-45deg) scale(1); opacity: 0.8; } 100% { transform: translate(-50%, -50%) rotate(-45deg) scale(3); opacity: 0; } }
        @keyframes pinDrop { 0% { transform: translate(-50%, -150%); opacity: 0; } 60% { transform: translate(-50%, -95%); } 100% { transform: translate(-50%, -100%); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes shimmer { 100% { transform: translateX(100%); } }

        .animate-blink { animation: blink 1.2s infinite; }
        .animate-ticker { animation: ticker-scroll 55s linear infinite; }
        .animate-scan { animation: scan 2s ease-in-out infinite; }
        .animate-pulse-ring { animation: pulse-ring 2s infinite; }
        .animate-pin-drop { animation: pinDrop .6s ease-out; }
        .animate-fade-in { animation: fadeIn .4s; }
    </style>
</head>
<body class="font-sans bg-white text-kej-ink antialiased overflow-x-hidden leading-relaxed text-[15px]">
    @include('partials.gov-bar')
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    
    @include('partials.absence-modal')

    @if(session('complaint_success'))
    <div id="complaintSuccessModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-kej-navy/60 backdrop-blur-sm" onclick="document.getElementById('complaintSuccessModal').remove()"></div>
        <div class="relative bg-white rounded-[24px] shadow-2xl w-[90vw] max-w-[340px] p-6 text-center animate-fade-in transform transition-all">
            <div class="w-16 h-16 bg-kej-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="text-kej-green" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <h3 class="text-lg font-black text-kej-navy mb-2">Laporan Diterima</h3>
            <p class="text-[13px] text-kej-muted font-medium mb-6 leading-relaxed">
                {{ session('complaint_success') }}
            </p>
            <button onclick="document.getElementById('complaintSuccessModal').remove()" class="w-full bg-kej-navy text-white py-3.5 rounded-xl font-black text-xs tracking-widest uppercase hover:bg-kej-green transition-colors shadow-md">
                Tutup Jendela
            </button>
        </div>
    </div>
    @endif

    @stack('scripts')
    
    <div class="fixed bottom-5 right-5 sm:bottom-8 sm:right-8 z-[9999]">
        <a href="{{ route('complaints.create') }}" class="flex items-center justify-center gap-2.5 bg-kej-navy text-white px-5 py-3.5 sm:px-6 sm:py-4 rounded-full shadow-2xl hover:bg-kej-green hover:shadow-kej-green/40 transition-all transform hover:-translate-y-1 group border-2 border-white/10 relative overflow-hidden">
            <svg class="group-hover:rotate-12 transition-transform w-5 h-5 relative z-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest relative z-10">Layanan Aduan</span>
        </a>
    </div>
</body>
</html>
