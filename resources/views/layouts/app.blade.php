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
    
    <div class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('complaints.create') }}" class="flex items-center gap-3 bg-kej-navy text-white pl-5 pr-6 py-3 rounded-full shadow-2xl hover:bg-kej-green transition-all transform hover:-translate-y-1 group">
            <svg class="group-hover:rotate-12 transition-transform" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span class="text-xs font-black uppercase tracking-widest">Aduan</span>
        </a>
    </div>

    @include('partials.absence-modal')

    @stack('scripts')
</body>
</html>
