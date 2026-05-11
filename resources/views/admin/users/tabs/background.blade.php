<div x-show="activeTab === 'background'" style="display: none;" class="p-8 space-y-6">
    <div class="mb-6 pb-2 border-b border-kej-border">
        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">II. Latar Belakang Terpidana</h3>
    </div>

    {{-- Sub-section A: Riwayat Pendidikan --}}
    <div class="space-y-4">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">A. Riwayat Pendidikan</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Institusi Terakhir</label>
                <input type="text" name="pks02_background[edu_institution]" value="{{ old('pks02_background.edu_institution', $user->pks02_background['edu_institution'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Tahun Lulus</label>
                <input type="text" name="pks02_background[edu_graduation_year]" value="{{ old('pks02_background.edu_graduation_year', $user->pks02_background['edu_graduation_year'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Prestasi Akademik</label>
            <div class="flex gap-4">
                @foreach(['Baik', 'Cukup', 'Kurang'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_background[edu_achievement]" value="{{ $val }}" {{ old('pks02_background.edu_achievement', $user->pks02_background['edu_achievement'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Catatan Khusus Pendidikan</label>
            <textarea name="pks02_background[edu_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.edu_notes', $user->pks02_background['edu_notes'] ?? '') }}</textarea>
        </div>
    </div>

    {{-- Sub-section B: Riwayat Pekerjaan --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">B. Riwayat Pekerjaan</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Penghasilan Rata-rata per Bulan</label>
                <input type="number" name="pks02_background[monthly_income]" value="{{ old('pks02_background.monthly_income', $user->pks02_background['monthly_income'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Lama Bekerja</label>
                <input type="text" name="pks02_background[work_duration]" value="{{ old('pks02_background.work_duration', $user->pks02_background['work_duration'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Status Pekerjaan</label>
            <select name="pks02_background[employment_status]" class="w-full md:w-1/2 px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                <option value="">-- Pilih Status Pekerjaan --</option>
                @foreach(['Tetap/PNS', 'Kontrak', 'Wiraswasta', 'Tidak Bekerja', 'Pensiun'] as $val)
                <option value="{{ $val }}" {{ old('pks02_background.employment_status', $user->pks02_background['employment_status'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Riwayat Pekerjaan Sebelumnya</label>
            <textarea name="pks02_background[work_history]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.work_history', $user->pks02_background['work_history'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Catatan Khusus Pekerjaan</label>
            <textarea name="pks02_background[work_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.work_notes', $user->pks02_background['work_notes'] ?? '') }}</textarea>
        </div>
    </div>

    {{-- Sub-section C: Riwayat Kesehatan --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">C. Riwayat Kesehatan</h4>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kondisi Fisik</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Sehat', 'Ada Keluhan Ringan', 'Sakit Kronik', 'Disabilitas'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_background[health_physical_status]" value="{{ $val }}" {{ old('pks02_background.health_physical_status', $user->pks02_background['health_physical_status'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Riwayat Penyakit Serius</label>
            <textarea name="pks02_background[health_disease_history]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.health_disease_history', $user->pks02_background['health_disease_history'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kondisi Mental</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Normal', 'Pernah Berobat', 'Diagnosis', 'Dalam Pengobatan'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_background[health_mental_status]" value="{{ $val }}" {{ old('pks02_background.health_mental_status', $user->pks02_background['health_mental_status'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Riwayat Pengobatan Jiwa</label>
            <textarea name="pks02_background[health_mental_history]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.health_mental_history', $user->pks02_background['health_mental_history'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Riwayat Ketergantungan</label>
            <div class="flex flex-wrap gap-4">
                @php $addictions = is_array(old('pks02_background.health_addiction_status', $user->pks02_background['health_addiction_status'] ?? [])) ? old('pks02_background.health_addiction_status', $user->pks02_background['health_addiction_status'] ?? []) : []; @endphp
                @foreach(['Tidak Ada', 'Alkohol', 'Narkotika', 'Lainnya'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="checkbox" name="pks02_background[health_addiction_status][]" value="{{ $val }}" {{ in_array($val, $addictions) ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green rounded">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Keterangan Ketergantungan</label>
            <textarea name="pks02_background[health_addiction_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.health_addiction_notes', $user->pks02_background['health_addiction_notes'] ?? '') }}</textarea>
        </div>
    </div>

    {{-- Sub-section D: Riwayat Hukum --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">D. Riwayat Hukum</h4>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pernah Dihukum</label>
            <div class="flex gap-4">
                @foreach(['Tidak Pernah', 'Pernah'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_background[has_criminal_record]" value="{{ $val }}" {{ old('pks02_background.has_criminal_record', $user->pks02_background['has_criminal_record'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Detail Riwayat Hukum (Jika Pernah)</label>
            <textarea name="pks02_background[criminal_record_details]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_background.criminal_record_details', $user->pks02_background['criminal_record_details'] ?? '') }}</textarea>
        </div>
    </div>
    
    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
            Simpan Latar Belakang
        </button>
    </div>
</div>
