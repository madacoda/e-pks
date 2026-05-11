@extends('layouts.app')

@section('title', 'Penilaian Ketersediaan Layanan Pendukung')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="mb-6 sm:mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('admin.index') }}" class="text-[11px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali ke Daftar Terpidana
                </a>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy mb-1 leading-tight">Penilaian Ketersediaan Layanan (PKS-03)</h1>
                <p class="text-xs sm:text-sm text-kej-muted">Penilaian awal untuk ketersediaan layanan pendukung bagi terpidana <span class="font-bold text-kej-navy">{{ $user->name }}</span>.</p>
            </div>
            
            @if($assessment)
            <a href="{{ route('admin.pks03-assessment.pdf', $user) }}" target="_blank" class="bg-kej-navy hover:bg-kej-navy-light text-white px-4 py-2.5 rounded-xl text-xs font-black tracking-widest uppercase transition-colors shadow-sm flex items-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                Export PDF
            </a>
            @endif
        </div>

        @if($errors->any())
        <div class="bg-red-50 text-red-800 border border-red-200 rounded-xl p-4 mb-6 text-sm">
            <div class="font-bold mb-2 flex items-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                Terdapat kesalahan dalam pengisian form:
            </div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div id="successModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-kej-navy/60 backdrop-blur-sm" onclick="document.getElementById('successModal').remove()"></div>
            <div class="relative bg-white rounded-[24px] shadow-2xl w-[90vw] max-w-[340px] p-6 text-center animate-fade-in transform transition-all">
                <div class="w-16 h-16 bg-kej-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="text-kej-green" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <h3 class="text-lg font-black text-kej-navy mb-2">Berhasil Disimpan</h3>
                <p class="text-[13px] text-kej-muted font-medium mb-6 leading-relaxed">
                    {{ session('success') }}
                </p>
                <button onclick="document.getElementById('successModal').remove()" class="w-full bg-kej-navy text-white py-3.5 rounded-xl font-black text-xs tracking-widest uppercase hover:bg-kej-green transition-colors shadow-md">
                    Tutup
                </button>
            </div>
        </div>
        @endif

        <form action="{{ $assessment ? route('admin.pks03-assessment.update', $user) : route('admin.pks03-assessment.store', $user) }}" method="POST">
            @csrf
            @if($assessment)
                @method('PUT')
            @endif

            <div class="bg-white border border-kej-border rounded-2xl shadow-sm mb-6 overflow-hidden">
                <div class="p-6 sm:p-8 space-y-8">
                    {{-- Informasi Dasar --}}
                    <div>
                        <h3 class="text-sm font-bold text-kej-navy uppercase tracking-widest mb-4 border-b border-kej-border pb-2">Informasi Penilaian</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-kej-muted uppercase mb-2">Penilai (Penuntut Umum/Jaksa)</label>
                                <input type="text" name="assessed_by" value="{{ old('assessed_by', $assessment->assessed_by ?? '') }}" required class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-2.5">
                                @error('assessed_by') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-kej-muted uppercase mb-2">Tanggal Penilaian</label>
                                <input type="date" name="assessed_at" value="{{ old('assessed_at', $assessment ? $assessment->assessed_at->format('Y-m-d') : date('Y-m-d')) }}" required class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-2.5">
                                @error('assessed_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bagian A: Lembaga Dukungan --}}
                    <div x-data="institutionRepeater()">
                        <div class="flex justify-between items-center mb-4 border-b border-kej-border pb-2">
                            <h3 class="text-sm font-bold text-kej-navy uppercase tracking-widest">A. Ketersediaan Lembaga / Fasilitas Dukungan</h3>
                            <button type="button" @click="addInstitution" class="text-xs font-bold text-kej-navy hover:text-kej-green bg-kej-bg px-3 py-1.5 rounded-lg border border-kej-border flex items-center gap-1">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Tambah
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[700px]">
                                <thead>
                                    <tr class="bg-kej-bg/50">
                                        <th class="p-3 text-[10px] font-bold text-kej-muted uppercase w-8">No</th>
                                        <th class="p-3 text-[10px] font-bold text-kej-muted uppercase">Nama Lembaga/Fasilitas</th>
                                        <th class="p-3 text-[10px] font-bold text-kej-muted uppercase w-48">Jenis Layanan</th>
                                        <th class="p-3 text-[10px] font-bold text-kej-muted uppercase w-64">Alamat/Kontak</th>
                                        <th class="p-3 text-[10px] font-bold text-kej-muted uppercase w-28 text-center">Tersedia</th>
                                        <th class="p-3 w-12"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(inst, index) in institutions" :key="index">
                                        <tr class="border-b border-kej-border/50 hover:bg-kej-bg/30 transition-colors">
                                            <td class="p-3 text-sm text-kej-navy text-center" x-text="index + 1"></td>
                                            <td class="p-2">
                                                <select x-model="inst.institution_name" @change="updateFromLocation($event.target.value, index)" :name="`institutions[${index}][institution_name]`" required class="w-full bg-white border-kej-border rounded text-xs px-3 py-2">
                                                    <option value="">Pilih Lembaga / Lokasi Baksos...</option>
                                                    @foreach($locations as $l)
                                                        <option value="{{ $l->name }}">{{ $l->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2">
                                                <select x-model="inst.service_type" :name="`institutions[${index}][service_type]`" required class="w-full bg-white border-kej-border rounded text-xs px-3 py-2">
                                                    <option value="rumah_sakit">Rumah Sakit/Klinik</option>
                                                    <option value="panti_asuhan">Panti Asuhan</option>
                                                    <option value="panti_lansia">Panti Lansia/Jompo</option>
                                                    <option value="sekolah">Sekolah/Institusi Pendidikan</option>
                                                    <option value="lembaga_sosial_lain">Lembaga Sosial Lain</option>
                                                </select>
                                            </td>
                                            <td class="p-2">
                                                <input type="text" x-model="inst.address_contact" :name="`institutions[${index}][address_contact]`" class="w-full bg-white border-kej-border rounded text-xs px-3 py-2">
                                            </td>
                                            <td class="p-2 text-center">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" x-model="inst.is_available" class="sr-only peer">
                                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-kej-green"></div>
                                                </label>
                                                <input type="hidden" :name="`institutions[${index}][is_available]`" :value="inst.is_available ? 1 : 0">
                                            </td>
                                            <td class="p-2 text-center">
                                                <button type="button" @click="removeInstitution(index)" class="text-red-400 hover:text-red-600 p-1">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="institutions.length === 0">
                                        <td colspan="6" class="p-4 text-center text-xs text-kej-muted italic bg-kej-bg/30">
                                            Belum ada data lembaga. Klik "Tambah" untuk memasukkan data.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Bagian B: Pembimbing Kemasyarakatan --}}
                    <div x-data="{ bapasAvailable: {{ old('bapas_available', $assessment->bapas_available ?? 0) ? 'true' : 'false' }} }">
                        <h3 class="text-sm font-bold text-kej-navy uppercase tracking-widest mb-4 border-b border-kej-border pb-2">B. Ketersediaan Pembimbing Kemasyarakatan (BAPAS)</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <input type="hidden" name="bapas_available" value="0">
                                <input type="checkbox" name="bapas_available" id="bapas_available" value="1" x-model="bapasAvailable" class="mt-1 rounded border-kej-border text-kej-navy focus:ring-kej-navy">
                                <div>
                                    <label for="bapas_available" class="text-sm font-bold text-kej-navy block">Pembimbing Kemasyarakatan tersedia di wilayah tersebut</label>
                                    <p class="text-[11px] text-kej-muted mt-0.5">Centang jika terdapat BAPAS yang dapat membimbing terpidana.</p>
                                </div>
                            </div>
                            
                            <div x-show="bapasAvailable" class="pl-7 space-y-4 transition-all duration-300">
                                <div>
                                    <label class="block text-xs font-bold text-kej-muted uppercase mb-2">Nama BAPAS / Lembaga</label>
                                    <input type="text" name="bapas_institution_name" value="{{ old('bapas_institution_name', $assessment->bapas_institution_name ?? '') }}" class="w-full md:w-1/2 bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy px-4 py-2">
                                </div>
                                <div class="flex items-start gap-3 mt-4">
                                    <input type="hidden" name="guidance_program_available" value="0">
                                    <input type="checkbox" name="guidance_program_available" id="guidance_program_available" value="1" {{ old('guidance_program_available', $assessment->guidance_program_available ?? false) ? 'checked' : '' }} class="mt-1 rounded border-kej-border text-kej-navy focus:ring-kej-navy">
                                    <label for="guidance_program_available" class="text-sm font-bold text-kej-navy">Program pembimbingan sesuai dengan kebutuhan terpidana</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian C: Kesimpulan --}}
                    <div>
                        <h3 class="text-sm font-bold text-kej-navy uppercase tracking-widest mb-4 border-b border-kej-border pb-2">C. Kesimpulan Penilaian</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <label class="relative flex flex-col border border-kej-border rounded-xl p-4 cursor-pointer hover:bg-kej-bg/50 transition-colors [&:has(input:checked)]:border-green-500 [&:has(input:checked)]:bg-green-50/50">
                                <input type="radio" name="conclusion" value="tersedia_memadai" {{ old('conclusion', $assessment->conclusion ?? '') === 'tersedia_memadai' ? 'checked' : '' }} class="absolute right-4 top-4 text-green-600 focus:ring-green-500" required>
                                <span class="text-sm font-bold text-kej-navy mb-1 pr-6">Tersedia & Memadai</span>
                                <span class="text-[11px] text-kej-muted leading-relaxed">Fasilitas dan pembimbing siap mendukung pelaksanaan PKS.</span>
                            </label>
                            
                            <label class="relative flex flex-col border border-kej-border rounded-xl p-4 cursor-pointer hover:bg-kej-bg/50 transition-colors [&:has(input:checked)]:border-yellow-500 [&:has(input:checked)]:bg-yellow-50/50">
                                <input type="radio" name="conclusion" value="tersedia_terbatas" {{ old('conclusion', $assessment->conclusion ?? '') === 'tersedia_terbatas' ? 'checked' : '' }} class="absolute right-4 top-4 text-yellow-600 focus:ring-yellow-500" required>
                                <span class="text-sm font-bold text-kej-navy mb-1 pr-6">Tersedia Terbatas</span>
                                <span class="text-[11px] text-kej-muted leading-relaxed">Ada fasilitas namun dengan keterbatasan (jarak, kapasitas).</span>
                            </label>

                            <label class="relative flex flex-col border border-kej-border rounded-xl p-4 cursor-pointer hover:bg-kej-bg/50 transition-colors [&:has(input:checked)]:border-red-500 [&:has(input:checked)]:bg-red-50/50">
                                <input type="radio" name="conclusion" value="tidak_tersedia" {{ old('conclusion', $assessment->conclusion ?? '') === 'tidak_tersedia' ? 'checked' : '' }} class="absolute right-4 top-4 text-red-600 focus:ring-red-500" required>
                                <span class="text-sm font-bold text-kej-navy mb-1 pr-6">Tidak Tersedia</span>
                                <span class="text-[11px] text-kej-muted leading-relaxed">Tidak ada fasilitas atau pembimbing yang memadai.</span>
                            </label>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-kej-muted uppercase mb-2">Catatan / Keterangan Tambahan</label>
                            <textarea name="notes" rows="3" class="w-full bg-kej-bg border-kej-border rounded-lg text-sm text-kej-navy focus:ring-kej-navy focus:border-kej-navy px-4 py-3">{{ old('notes', $assessment->notes ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-kej-bg border-t border-kej-border flex justify-end">
                    <button type="submit" class="bg-kej-navy hover:bg-kej-navy-light text-white px-8 py-3 rounded-xl text-xs font-black tracking-widest uppercase transition-colors shadow-sm flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Simpan Penilaian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('institutionRepeater', () => ({
            locations: {!! $locations->toJson() !!},
            institutions: {!! json_encode(old('institutions', $assessment ? $assessment->institutions->map(function($i) { return ['institution_name' => $i->institution_name, 'service_type' => $i->service_type, 'address_contact' => $i->address_contact, 'is_available' => (bool)$i->is_available]; })->toArray() : [])) !!},
            addInstitution() {
                this.institutions.push({
                    institution_name: '',
                    service_type: 'lembaga_sosial_lain',
                    address_contact: '',
                    is_available: true
                });
            },
            removeInstitution(index) {
                this.institutions.splice(index, 1);
            },
            updateFromLocation(name, index) {
                const location = this.locations.find(l => l.name === name);
                if (location) {
                    let contactStr = location.address || '';
                    if (location.phone) {
                        contactStr += ' - Telp: ' + location.phone;
                    }
                    if (location.pic_name) {
                        contactStr += ' (PIC: ' + location.pic_name + ')';
                    }
                    this.institutions[index].address_contact = contactStr;
                }
            }
        }));
    });
</script>
@endpush
@endsection
