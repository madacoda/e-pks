@extends('layouts.app')

@section('title', 'Edit User — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[800px] mx-auto px-4 sm:px-6">
        <div class="mb-8 animate-fade-in">
            <a href="{{ route('admin.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </div>
                Kembali ke Daftar User
            </a>
            <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Update Informasi</div>
            <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">Edit Data <span class="text-kej-green">User</span></h1>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <form action="{{ route('admin.update', $user->id) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                    </div>
                    <div>
                        <label for="email" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="role" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Role Sistem</label>
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                            <option value="pidana" {{ $user->role === 'pidana' ? 'selected' : '' }}>Terpidana</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin Kejaksaan</option>
                        </select>
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Tanggal Lahir</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="crime" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Perkara / Kejahatan</label>
                        <textarea id="crime" name="crime" rows="2"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('crime', $user->crime) }}</textarea>
                    </div>
                    <div>
                        <label for="sentence" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Masa Hukuman (Vonis)</label>
                        <textarea id="sentence" name="sentence" rows="2"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('sentence', $user->sentence) }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="placement_id" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Lokasi Penempatan</label>
                    <select id="placement_id" name="placement_id"
                        class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                        <option value="">-- Pilih Lokasi Penempatan --</option>
                        @foreach($placements as $placement)
                            <option value="{{ $placement->id }}" {{ old('placement_id', $user->placement_id) == $placement->id ? 'selected' : '' }}>
                                {{ $placement->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
                    <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
