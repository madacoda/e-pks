<div class="p-5 hover:bg-kej-bg/20 transition-all group border-b border-kej-border last:border-0">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 rounded-lg overflow-hidden shrink-0 border border-kej-border shadow-sm">
            <img src="{{ Storage::disk('public')->url($absence->image_path) }}"
                class="w-full h-full object-cover" alt="Selfie">
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start mb-1">
                <h4 class="font-bold text-kej-navy text-[15px] truncate leading-tight">
                    {{ $absence->location_name ?? 'Presensi Terverifikasi' }}
                </h4>
                <span class="text-[10px] font-bold text-kej-muted whitespace-nowrap">{{ $absence->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full {{ $absence->status === 'present' ? 'bg-kej-green' : 'bg-red-500' }}"></span>
                    <span class="text-[11px] font-black {{ $absence->status === 'present' ? 'text-kej-green' : 'text-red-600' }} tracking-wider uppercase">
                        {{ $absence->latitude }}, {{ $absence->longitude }}
                    </span>
                    <span class="text-[10px] text-kej-muted font-bold ml-1">— {{ $absence->created_at->format('H:i') }} WIB</span>
                </div>
                
                <button 
                    x-on:click="$dispatch('open-absence-modal', { 
                        image: '{{ addslashes(Storage::disk('public')->url($absence->image_path)) }}',
                        location: '{{ addslashes($absence->location_name ?? 'Presensi Terverifikasi') }}',
                        time: '{{ $absence->created_at->format('d F Y, H:i') }} WIB',
                        lat: '{{ $absence->latitude }}',
                        lng: '{{ $absence->longitude }}',
                        status: '{{ $absence->status }}'
                    })"
                    class="text-[10px] font-black text-kej-navy bg-white border border-kej-border px-3 py-1.5 rounded-lg hover:bg-kej-navy hover:text-white transition-all shadow-sm">
                    DETAIL
                </button>
            </div>
        </div>
    </div>
</div>
