@extends('layouts.app')

@section('title', 'Daftar Aduan — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6">
        <div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
            <div class="animate-fade-in">
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase mb-1 sm:mb-2">Monitoring Feedback</div>
                <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">
                    Laporan <span class="text-kej-green">Aduan Masuk</span>
                </h1>
                <p class="text-kej-muted text-xs sm:text-sm mt-1 font-medium">Tinjau dan tindaklanjuti laporan dari masyarakat secara berkala.</p>
            </div>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-kej-bg border-b border-kej-border">
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Tanggal & Pengadu</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Subjek</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Isi Aduan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black text-kej-muted uppercase tracking-[0.15em]">Aksi & Respon</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-kej-border">
                        @forelse($complaints as $complaint)
                        <tr class="hover:bg-kej-bg/50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="text-xs font-black text-kej-navy">{{ $complaint->created_at->format('d/m/Y H:i') }}</div>
                                <div class="text-[10px] text-kej-muted font-bold uppercase mt-1">{{ $complaint->name ?? 'Anonim' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs font-bold text-kej-navy">{{ $complaint->subject }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs text-kej-muted line-clamp-2 max-w-[300px]">{{ $complaint->content }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest
                                    {{ $complaint->status === 'baru' ? 'bg-red-100 text-red-600' : ($complaint->status === 'diproses' ? 'bg-blue-100 text-blue-600' : 'bg-kej-green/10 text-kej-green') }}">
                                    {{ $complaint->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST" class="flex flex-col gap-2 min-w-[200px]">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="admin_response" rows="2" class="text-[10px] border border-kej-border rounded p-2 w-full focus:outline-none focus:border-kej-green transition-colors resize-none" placeholder="Ketik respon resmi...">{{ $complaint->admin_response }}</textarea>
                                    <div class="flex justify-between items-center gap-2">
                                        <select name="status" class="text-[10px] font-bold border border-kej-border rounded bg-white px-2 py-1.5 focus:outline-none flex-1 cursor-pointer">
                                            <option value="baru" {{ $complaint->status === 'baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="diproses" {{ $complaint->status === 'diproses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ $complaint->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-kej-navy text-white text-[9px] font-black px-3 py-1.5 rounded uppercase tracking-wider hover:bg-kej-green transition-colors">Simpan</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center text-kej-muted italic text-sm">Tidak ada aduan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($complaints->hasPages())
            <div class="px-6 py-4 border-t border-kej-border">
                {{ $complaints->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
