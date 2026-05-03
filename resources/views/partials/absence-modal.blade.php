<div 
    x-data="{ 
        isOpen: false, 
        data: { image: '', location: '', time: '', lat: '', lng: '', status: '' } 
    }"
    x-on:open-absence-modal.window="isOpen = true; data = $event.detail"
    x-show="isOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] overflow-y-auto"
>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-kej-navy/80 backdrop-blur-sm transition-opacity" x-on:click="isOpen = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div 
            class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-5xl animate-fade-in"
            x-on:click.away="isOpen = false"
        >
            <!-- Close Button -->
            <button x-on:click="isOpen = false" class="absolute top-5 right-5 z-20 w-12 h-12 bg-kej-navy/40 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-kej-navy transition-all border border-white/20 shadow-lg">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-5 h-full max-h-[90vh]">
                <!-- Image Side -->
                <div class="lg:col-span-3 h-[400px] lg:h-full bg-kej-ink relative overflow-hidden flex items-center justify-center group" x-data="{ loading: true }">
                    <!-- Loading Spinner -->
                    <div x-show="loading" class="absolute inset-0 flex items-center justify-center bg-kej-navy/20 backdrop-blur-sm z-10">
                        <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <img 
                        :src="data.image" 
                        class="max-w-full max-h-full object-contain relative z-0" 
                        alt="Selfie Detail"
                        x-on:load="loading = false"
                        :key="data.image"
                    >
                    <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-20">
                        <div class="text-[11px] font-black text-kej-gold uppercase tracking-[0.2em] mb-2" x-text="data.time"></div>
                        <h3 class="text-2xl font-serif font-black text-white leading-tight shadow-sm" x-text="data.location"></h3>
                    </div>
                </div>

                <!-- Info Side -->
                <div class="lg:col-span-2 p-10 flex flex-col h-full bg-white">
                    <div class="mb-8">
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase mb-4"
                            :class="data.status === 'present' ? 'bg-kej-green/10 text-kej-green border border-kej-green/20' : 'bg-red-500/10 text-red-600 border border-red-500/20'">
                            STATUS: <span x-text="data.status.toUpperCase()"></span>
                        </span>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black text-kej-muted uppercase tracking-widest mb-2">Titik Presensi Terverifikasi</label>
                                <div class="font-mono text-sm font-bold text-kej-navy bg-kej-bg p-3.5 rounded-xl border border-kej-border flex items-center gap-3">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-kej-muted"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span x-text="data.lat + ', ' + data.lng"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="flex-1 min-h-[350px] rounded-2xl overflow-hidden border border-kej-border bg-kej-bg relative shadow-inner">
                        <template x-if="isOpen">
                            <iframe 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0" 
                                :src="'https://maps.google.com/maps?q=' + data.lat + ',' + data.lng + '&z=16&output=embed'" 
                                allowfullscreen>
                            </iframe>
                        </template>
                    </div>

                    <div class="mt-8 pt-6 border-t border-kej-border flex gap-3">
                        <a :href="'https://www.google.com/maps?q=' + data.lat + ',' + data.lng" target="_blank" class="flex-1 bg-kej-navy text-white text-center py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-kej-green transition-all shadow-lg shadow-kej-navy/20">
                            Lihat di Google Map
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
