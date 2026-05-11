@extends('layouts.app')

@section('title', (isset($placement) ? 'Edit' : 'Tambah') . ' Satker — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[600px] mx-auto px-4 sm:px-6">
        <div class="mb-8 animate-fade-in">
            <a href="{{ route('admin.placements.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Daftar Satker
            </a>
            <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                {{ isset($placement) ? 'Edit' : 'Tambah' }} <span class="text-kej-green">Satker</span>
            </h1>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="p-6 sm:p-8">
                <form action="{{ isset($placement) ? route('admin.placements.update', $placement) : route('admin.placements.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if(isset($placement)) @method('PUT') @endif
                    
                    <div>
                        <label for="name" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Satker / Instansi</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $placement->name ?? '') }}" required
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Contoh: Kejaksaan Negeri Jakarta Pusat">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Masukkan alamat lengkap Satker...">{{ old('address', $placement->address ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pic_name" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama PIC / Kontak</label>
                            <input type="text" id="pic_name" name="pic_name" value="{{ old('pic_name', $placement->pic_name ?? '') }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Nama Penanggung Jawab">
                        </div>
                        <div>
                            <label for="phone" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $placement->phone ?? '') }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="0812-xxxx-xxxx">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-kej-navy text-white py-4 rounded-xl font-black text-xs tracking-widest uppercase hover:bg-kej-green transition-all shadow-lg active:scale-95">
                            {{ isset($placement) ? 'Simpan Perubahan' : 'Daftarkan Satker' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
