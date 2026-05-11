<div x-show="activeTab === 'environment'" style="display: none;" class="p-8 space-y-6">
    <div class="mb-6 pb-2 border-b border-kej-border">
        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">IV. Lingkungan & V. Rutinitas Kepribadian</h3>
    </div>

    {{-- Sub-section IV: Lingkungan Tempat Tinggal --}}
    <div class="space-y-4">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">A. Lingkungan Tempat Tinggal</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kelurahan</label>
                <input type="text" name="pks02_environment[village]" value="{{ old('pks02_environment.village', $user->pks02_environment['village'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kecamatan</label>
                <input type="text" name="pks02_environment[district]" value="{{ old('pks02_environment.district', $user->pks02_environment['district'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Klasifikasi Wilayah</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Perkotaan Padat', 'Menengah', 'Pinggiran', 'Pedesaan'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_environment[area_classification]" value="{{ $val }}" {{ old('pks02_environment.area_classification', $user->pks02_environment['area_classification'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kondisi Ekonomi Masyarakat</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Tinggi', 'Menengah Atas', 'Menengah Bawah', 'Rendah'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_environment[community_economy]" value="{{ $val }}" {{ old('pks02_environment.community_economy', $user->pks02_environment['community_economy'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Tingkat Kriminalitas</label>
                <div class="flex gap-4">
                    @foreach(['Rendah', 'Sedang', 'Tinggi'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_environment[crime_rate]" value="{{ $val }}" {{ old('pks02_environment.crime_rate', $user->pks02_environment['crime_rate'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kepadatan Penduduk</label>
                <div class="flex gap-4">
                    @foreach(['Padat', 'Sedang', 'Jarang'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_environment[population_density]" value="{{ $val }}" {{ old('pks02_environment.population_density', $user->pks02_environment['population_density'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Karakteristik Sosial Budaya</label>
                <textarea name="pks02_environment[socio_cultural_characteristics]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_environment.socio_cultural_characteristics', $user->pks02_environment['socio_cultural_characteristics'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Sarana Prasarana</label>
                <textarea name="pks02_environment[facilities]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_environment.facilities', $user->pks02_environment['facilities'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Persepsi Masyarakat</label>
                <textarea name="pks02_environment[community_perception]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_environment.community_perception', $user->pks02_environment['community_perception'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Sub-section IV-B: Lingkungan TKP --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">B. Lingkungan TKP</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Lokasi TKP</label>
                <input type="text" name="pks02_environment[tkp_location]" value="{{ old('pks02_environment.tkp_location', $user->pks02_environment['tkp_location'] ?? '') }}"
                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Hubungan TKP dengan Tempat Tinggal</label>
                <select name="pks02_environment[tkp_relationship]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                    <option value="">-- Pilih Hubungan --</option>
                    @foreach(['Satu Lingkungan', 'Beda Desa', 'Beda Kecamatan', 'Jauh'] as $val)
                    <option value="{{ $val }}" {{ old('pks02_environment.tkp_relationship', $user->pks02_environment['tkp_relationship'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kondisi Sosial TKP</label>
                <textarea name="pks02_environment[tkp_social_condition]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_environment.tkp_social_condition', $user->pks02_environment['tkp_social_condition'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pengaruh Lingkungan TKP</label>
                <textarea name="pks02_environment[tkp_environment_effect]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_environment.tkp_environment_effect', $user->pks02_environment['tkp_environment_effect'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Sub-section V-A: Rutinitas Harian --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">C. Rutinitas Harian</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Deskripsi Rutinitas</label>
                <textarea name="pks02_daily_life[daily_routine]" rows="3" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_daily_life.daily_routine', $user->pks02_daily_life['daily_routine'] ?? '') }}</textarea>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kegiatan Sosial</label>
                    <div class="flex gap-4">
                        @foreach(['Aktif', 'Kadang', 'Pasif'] as $val)
                        <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                            <input type="radio" name="pks02_daily_life[social_activity_level]" value="{{ $val }}" {{ old('pks02_daily_life.social_activity_level', $user->pks02_daily_life['social_activity_level'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                            {{ $val }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Organisasi/Komunitas</label>
                    <input type="text" name="pks02_daily_life[organizations]" value="{{ old('pks02_daily_life.organizations', $user->pks02_daily_life['organizations'] ?? '') }}"
                        class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kegiatan Keagamaan</label>
                <textarea name="pks02_daily_life[religious_activities]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_daily_life.religious_activities', $user->pks02_daily_life['religious_activities'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Hobi</label>
                <textarea name="pks02_daily_life[hobbies]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_daily_life.hobbies', $user->pks02_daily_life['hobbies'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Sub-section V-B: Gambaran Kepribadian --}}
    <div class="space-y-4 pt-6 border-t border-kej-border">
        <h4 class="text-[11px] font-bold text-kej-green uppercase tracking-wider">D. Gambaran Kepribadian</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Sikap thd Otoritas</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Patuh', 'Cenderung Menentang', 'Pemberontak'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_daily_life[attitude_towards_authority]" value="{{ $val }}" {{ old('pks02_daily_life.attitude_towards_authority', $user->pks02_daily_life['attitude_towards_authority'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kemampuan Sosialisasi</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Mudah Bergaul', 'Pemalu', 'Tertutup/Menarik Diri'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_daily_life[socialization_ability]" value="{{ $val }}" {{ old('pks02_daily_life.socialization_ability', $user->pks02_daily_life['socialization_ability'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kestabilan Emosi</label>
                <div class="flex flex-col gap-2">
                    @foreach(['Stabil', 'Labil', 'Mudah Marah'] as $val)
                    <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                        <input type="radio" name="pks02_daily_life[emotional_stability]" value="{{ $val }}" {{ old('pks02_daily_life.emotional_stability', $user->pks02_daily_life['emotional_stability'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                        {{ $val }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Motivasi Rehabilitasi</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Tinggi', 'Sedang', 'Rendah', 'Tidak Ada'] as $val)
                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                    <input type="radio" name="pks02_daily_life[rehabilitation_motivation]" value="{{ $val }}" {{ old('pks02_daily_life.rehabilitation_motivation', $user->pks02_daily_life['rehabilitation_motivation'] ?? '') === $val ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green">
                    {{ $val }}
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Catatan Kepribadian</label>
            <textarea name="pks02_daily_life[personality_notes]" rows="2" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_daily_life.personality_notes', $user->pks02_daily_life['personality_notes'] ?? '') }}</textarea>
        </div>
    </div>
    
    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
            Simpan Lingkungan & Kepribadian
        </button>
    </div>
</div>
