<div x-show="activeTab === 'family'" style="display: none;" class="p-8 space-y-6">
    <div class="mb-6 pb-2 border-b border-kej-border">
        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">III. Profil Keluarga & Dukungan</h3>
    </div>

    {{-- Sub-section A: Data Orang Tua --}}
    <div class="space-y-4">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">A. Data Orang Tua</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Ayah</label>
                <input type="text" name="pks02_family_profile[father_name]" value="{{ old('pks02_family_profile.father_name', $user->pks02_family_profile['father_name'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pekerjaan Ayah</label>
                <input type="text" name="pks02_family_profile[father_occupation]" value="{{ old('pks02_family_profile.father_occupation', $user->pks02_family_profile['father_occupation'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Status Ayah</label>
                <select name="pks02_family_profile[father_status]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Status --</option>
                    @foreach(['Hidup', 'Meninggal'] as $val)
                    <option value="{{ $val }}" {{ old('pks02_family_profile.father_status', $user->pks02_family_profile['father_status'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Ibu</label>
                <input type="text" name="pks02_family_profile[mother_name]" value="{{ old('pks02_family_profile.mother_name', $user->pks02_family_profile['mother_name'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pekerjaan Ibu</label>
                <input type="text" name="pks02_family_profile[mother_occupation]" value="{{ old('pks02_family_profile.mother_occupation', $user->pks02_family_profile['mother_occupation'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Status Ibu</label>
                <select name="pks02_family_profile[mother_status]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Status --</option>
                    @foreach(['Hidup', 'Meninggal'] as $val)
                    <option value="{{ $val }}" {{ old('pks02_family_profile.mother_status', $user->pks02_family_profile['mother_status'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Hubungan dengan Orang Tua</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Dekat', 'Renggang', 'Tidak Ada Komunikasi'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_family_profile[parent_relationship]" value="{{ $val }}" {{ old('pks02_family_profile.parent_relationship', $user->pks02_family_profile['parent_relationship'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Sub-section B: Kondisi Keluarga Inti --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">B. Kondisi Keluarga Inti</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Status Pernikahan Orang Tua</label>
                <select name="pks02_family_profile[parents_marital_status]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Status --</option>
                    @foreach(['Utuh', 'Bercerai', 'Lainnya'] as $val)
                    <option value="{{ $val }}" {{ old('pks02_family_profile.parents_marital_status', $user->pks02_family_profile['parents_marital_status'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kondisi Ekonomi Keluarga</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Mampu', 'Menengah', 'Kurang Mampu', 'Sangat Miskin'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_family_profile[economic_status]" value="{{ $val }}" {{ old('pks02_family_profile.economic_status', $user->pks02_family_profile['economic_status'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Anggota Serumah (Nama & Hubungan)</label>
            <textarea name="pks02_family_profile[family_members]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_family_profile.family_members', $user->pks02_family_profile['family_members'] ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Hubungan dalam Keluarga</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Harmonis', 'Cukup', 'Sering Konflik', 'Disfungsional'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_family_profile[family_relationship_quality]" value="{{ $val }}" {{ old('pks02_family_profile.family_relationship_quality', $user->pks02_family_profile['family_relationship_quality'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Catatan Kondisi Keluarga</label>
            <textarea name="pks02_family_profile[family_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_family_profile.family_notes', $user->pks02_family_profile['family_notes'] ?? '') }}</textarea>
        </div>
    </div>

    {{-- Sub-section C: Dukungan Keluarga --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">C. Dukungan Keluarga</h4>
        
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Keluarga Mengetahui Kasus</label>
            <div class="flex gap-4">
                @foreach(['Ya', 'Tidak'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_family_profile[family_knows_case]" value="{{ $val }}" {{ old('pks02_family_profile.family_knows_case', $user->pks02_family_profile['family_knows_case'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Sikap Keluarga Terhadap Pidana</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Mendukung Penuh', 'Sebagian', 'Acuh', 'Menolak'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_family_profile[family_attitude]" value="{{ $val }}" {{ old('pks02_family_profile.family_attitude', $user->pks02_family_profile['family_attitude'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Bersedia Dampingi Pelaksanaan PKS</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Ya', 'Tidak', 'Belum Diketahui'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_family_profile[family_willing_to_accompany]" value="{{ $val }}" {{ old('pks02_family_profile.family_willing_to_accompany', $user->pks02_family_profile['family_willing_to_accompany'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Keterangan Dukungan</label>
            <textarea name="pks02_family_profile[family_support_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_family_profile.family_support_notes', $user->pks02_family_profile['family_support_notes'] ?? '') }}</textarea>
        </div>
    </div>
    
    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
            Simpan Profil Keluarga
        </button>
    </div>
</div>
