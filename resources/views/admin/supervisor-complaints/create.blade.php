@extends('layouts.app')

@section('title', 'Tambah Aduan Pembimbing — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[800px] mx-auto px-4 sm:px-6">
        <div class="mb-8">
            <a href="{{ route('admin.supervisor-complaints.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </div>
                Kembali ke Daftar Aduan
            </a>
            <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Admin Panel</div>
            <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                Tambah <span class="text-kej-green">Aduan Pembimbing</span>
            </h1>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm font-bold">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm p-6 sm:p-8">
            <form action="{{ route('admin.supervisor-complaints.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="pidana_id" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Terpidana</label>
                    <select name="pidana_id" id="pidana_id" required class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                        <option value="">-- Pilih Terpidana --</option>
                        @foreach($pidanas as $pidana)
                        <option value="{{ $pidana->id }}" {{ old('pidana_id') == $pidana->id ? 'selected' : '' }}>
                            {{ $pidana->name }} (NIK: {{ $pidana->national_id }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="supervisor_name" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Nama Pembimbing</label>
                    <input type="text" name="supervisor_name" id="supervisor_name" value="{{ old('supervisor_name') }}" required 
                        class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                </div>

                <div>
                    <label for="compliance_notes" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Catatan Kepatuhan</label>
                    <textarea name="compliance_notes" id="compliance_notes" rows="5" required 
                        class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('compliance_notes') }}</textarea>
                </div>

                <div class="pt-6 border-t border-kej-border flex justify-end">
                    <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Simpan Aduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
