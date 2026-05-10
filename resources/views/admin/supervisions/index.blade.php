@extends('layouts.app')

@section('title', 'Riwayat Pengawasan — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6">
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <a href="{{ route('admin.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                    <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                    </div>
                    Kembali ke Daftar User
                </a>
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Form PKS-03</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Catatan <span class="text-kej-green">Pengawasan</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Terpidana: <span class="font-black text-kej-navy">{{ $user->name }}</span> ({{ $user->pks02_case_number ?? 'Belum ada No. Perkara' }})</p>
            </div>
            <button onclick="document.getElementById('addSupervisionModal').classList.remove('hidden')" class="bg-kej-navy text-white px-6 py-3 rounded-xl font-black text-[11px] tracking-widest uppercase hover:bg-kej-green transition-all shadow-md flex items-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Pengawasan
            </button>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-kej-bg border-b border-kej-border">
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Tanggal & Tipe</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Status Evaluasi</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Catatan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kej-border">
                        @forelse($supervisions as $supervision)
                        <tr class="hover:bg-kej-bg/50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="text-xs font-black text-kej-navy">{{ $supervision->supervision_date->format('d M Y') }}</div>
                                <div class="inline-block mt-1 px-2 py-0.5 bg-kej-navy/10 rounded text-[9px] font-bold text-kej-navy uppercase">{{ $supervision->supervision_type }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-[10px] font-bold text-kej-muted uppercase mb-1">Perilaku: <span class="text-kej-navy font-black">{{ $supervision->behavior_status }}</span></div>
                                <div class="text-[10px] font-bold text-kej-muted uppercase">Kepatuhan: <span class="{{ $supervision->compliance_status === 'Patuh' ? 'text-kej-green' : 'text-red-500' }} font-black">{{ $supervision->compliance_status }}</span></div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs text-kej-muted max-w-[300px]">{!! nl2br(e($supervision->notes)) ?? '<span class="italic">Tidak ada catatan</span>' !!}</div>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="editSupervision({{ $supervision->toJson() }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.supervisions.destroy', $supervision->id) }}" method="POST" onsubmit="return confirm('Hapus catatan pengawasan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-20 text-center text-kej-muted italic text-sm">Belum ada riwayat pengawasan (Form PKS-03).</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add Supervision --}}
<div id="addSupervisionModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-kej-navy/50 backdrop-blur-sm" onclick="document.getElementById('addSupervisionModal').classList.add('hidden')"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[600px] bg-white rounded-2xl shadow-2xl p-6 sm:p-8 animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-black text-kej-navy uppercase tracking-tight">Tambah Pengawasan</h3>
            <button onclick="document.getElementById('addSupervisionModal').classList.add('hidden')" class="text-kej-muted hover:text-kej-navy">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        
        <form action="{{ route('admin.supervisions.store', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="supervision_date" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Tanggal</label>
                    <input type="date" name="supervision_date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold">
                </div>
                <div>
                    <label for="supervision_type" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Tipe</label>
                    <select name="supervision_type" required class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Reguler">Reguler</option>
                        <option value="Insidentil">Insidentil</option>
                        <option value="Evaluasi">Evaluasi</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="behavior_status" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Perilaku</label>
                    <select name="behavior_status" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik" selected>Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang">Kurang</option>
                    </select>
                </div>
                <div>
                    <label for="compliance_status" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Kepatuhan</label>
                    <select name="compliance_status" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Patuh" selected>Patuh</option>
                        <option value="Peringatan 1">Peringatan 1</option>
                        <option value="Peringatan 2">Peringatan 2</option>
                        <option value="Pelanggaran">Pelanggaran</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="notes" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Catatan Detail</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold"></textarea>
            </div>
            <button type="submit" class="w-full bg-kej-navy text-white py-3 rounded-xl font-black text-[10px] tracking-widest uppercase hover:bg-kej-green transition-all shadow-md">Simpan Data</button>
        </form>
    </div>
</div>

{{-- Modal Edit Supervision --}}
<div id="editSupervisionModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-kej-navy/50 backdrop-blur-sm" onclick="document.getElementById('editSupervisionModal').classList.add('hidden')"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[600px] bg-white rounded-2xl shadow-2xl p-6 sm:p-8 animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-black text-kej-navy uppercase tracking-tight">Edit Pengawasan</h3>
            <button onclick="document.getElementById('editSupervisionModal').classList.add('hidden')" class="text-kej-muted hover:text-kej-navy">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        
        <form id="editSupervisionForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Tanggal</label>
                    <input type="date" id="edit_supervision_date" name="supervision_date" required class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Tipe</label>
                    <select id="edit_supervision_type" name="supervision_type" required class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Reguler">Reguler</option>
                        <option value="Insidentil">Insidentil</option>
                        <option value="Evaluasi">Evaluasi</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Perilaku</label>
                    <select id="edit_behavior_status" name="behavior_status" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang">Kurang</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Kepatuhan</label>
                    <select id="edit_compliance_status" name="compliance_status" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold appearance-none">
                        <option value="Patuh">Patuh</option>
                        <option value="Peringatan 1">Peringatan 1</option>
                        <option value="Peringatan 2">Peringatan 2</option>
                        <option value="Pelanggaran">Pelanggaran</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-1.5">Catatan Detail</label>
                <textarea id="edit_notes" name="notes" rows="3" class="w-full px-4 py-2.5 bg-kej-bg border border-kej-border rounded-xl text-xs focus:outline-none focus:border-kej-green font-semibold"></textarea>
            </div>
            <button type="submit" class="w-full bg-kej-navy text-white py-3 rounded-xl font-black text-[10px] tracking-widest uppercase hover:bg-kej-green transition-all shadow-md">Update Data</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editSupervision(supervision) {
        document.getElementById('editSupervisionModal').classList.remove('hidden');
        document.getElementById('editSupervisionForm').action = `/admin/supervisions/${supervision.id}`;
        
        // Format date to YYYY-MM-DD
        const dateObj = new Date(supervision.supervision_date);
        const dateStr = dateObj.toISOString().split('T')[0];
        
        document.getElementById('edit_supervision_date').value = dateStr;
        document.getElementById('edit_supervision_type').value = supervision.supervision_type;
        document.getElementById('edit_behavior_status').value = supervision.behavior_status;
        document.getElementById('edit_compliance_status').value = supervision.compliance_status;
        document.getElementById('edit_notes').value = supervision.notes || '';
    }
</script>
@endpush
@endsection
