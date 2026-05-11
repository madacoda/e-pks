<div x-show="activeTab === 'work_capability'" style="display: none;" class="p-8 space-y-6">
    <div class="mb-6 pb-2 border-b border-kej-border">
        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">VI. Kemampuan PKS</h3>
    </div>

    {{-- Sub-section VI-A: Kemampuan Fisik --}}
    <div class="space-y-4">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">A. Kemampuan Fisik</h4>
        
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kemampuan Fisik untuk PKS</label>
            <div class="flex gap-4">
                @foreach(['Mampu Penuh', 'Ada Pembatasan', 'Tidak Mampu'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_work_capability[physical_capability]" value="{{ $val }}" {{ old('pks02_work_capability.physical_capability', $user->pks02_work_capability['physical_capability'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Uraian Pembatasan Fisik</label>
                <textarea name="pks02_work_capability[physical_limitation_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_work_capability.physical_limitation_notes', $user->pks02_work_capability['physical_limitation_notes'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Rencana Jenis PKS</label>
                <textarea name="pks02_work_capability[recommended_work_type]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_work_capability.recommended_work_type', $user->pks02_work_capability['recommended_work_type'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Sub-section VI-B: Profesi & Keahlian --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">B. Profesi & Keahlian</h4>
        
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Keahlian/Keterampilan</label>
            <textarea name="pks02_work_capability[skills]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_work_capability.skills', $user->pks02_work_capability['skills'] ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Sertifikasi/Lisensi</label>
                <input type="text" name="pks02_work_capability[certifications]" value="{{ old('pks02_work_capability.certifications', $user->pks02_work_capability['certifications'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Bahasa yang Dikuasai</label>
                <input type="text" name="pks02_work_capability[languages_spoken]" value="{{ old('pks02_work_capability.languages_spoken', $user->pks02_work_capability['languages_spoken'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
        </div>
    </div>

    {{-- Sub-section VI-C: Kesesuaian Lokasi --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">C. Kesesuaian Lokasi & Kesimpulan</h4>
        
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Alasan Pemilihan Lokasi</label>
            <div class="flex flex-wrap gap-4 mb-2">
                @foreach(['Dekat Tempat Tinggal', 'Sesuai Keahlian', 'Kebutuhan Mendesak', 'Lainnya'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_work_capability[location_reason_type]" value="{{ $val }}" {{ old('pks02_work_capability.location_reason_type', $user->pks02_work_capability['location_reason_type'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
            <textarea name="pks02_work_capability[location_reason_notes]" rows="2" placeholder="Catatan alasan pemilihan lokasi..." class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_work_capability.location_reason_notes', $user->pks02_work_capability['location_reason_notes'] ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Perkiraan Kemampuan Selesaikan PKS</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Sangat Mampu', 'Mampu', 'Cukup', 'Kurang'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_work_capability[estimated_completion_ability]" value="{{ $val }}" {{ old('pks02_work_capability.estimated_completion_ability', $user->pks02_work_capability['estimated_completion_ability'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Rekomendasi JPU Akhir</label>
                <select name="pks02_work_capability[jpu_recommendation]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Rekomendasi --</option>
                    @foreach(['Sangat Direkomendasikan', 'Direkomendasikan', 'Tidak Direkomendasikan'] as $val)
                    <option value="{{ $val }}" {{ old('pks02_work_capability.jpu_recommendation', $user->pks02_work_capability['jpu_recommendation'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
            Simpan Kemampuan PKS
        </button>
    </div>
</div>
