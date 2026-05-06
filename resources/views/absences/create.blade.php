@extends('layouts.app')

@section('title', 'Lakukan Presensi — E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-10">
    <div class="max-w-[800px] mx-auto px-6">
        <div class="mb-8">
            <a href="{{ route('dashboard') }}" class="text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Dashboard
            </a>
            <h1 class="font-serif text-3xl font-black text-kej-navy">Mulai Presensi <span class="text-kej-green">Digital</span></h1>
            <p class="text-[15px] text-kej-muted mt-2">Pastikan Anda berada di lokasi kerja dan memiliki pencahayaan yang cukup untuk foto selfie.</p>
        </div>

        <div class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <form action="{{ route('absences.store') }}" method="POST" enctype="multipart/form-data" id="absence-form">
                @csrf
                <div class="p-8 space-y-8">
                    <!-- Photo Upload Section -->
                    <div>
                        <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-4">Langkah 1: Foto Selfie di Lokasi</label>
                        <div class="relative group">
                            <div id="photo-preview-container" class="w-full aspect-[4/3] bg-kej-bg border-2 border-dashed border-kej-border rounded-2xl flex flex-col items-center justify-center overflow-hidden transition-all relative">
                                <!-- Placeholder -->
                                <div id="preview-placeholder" class="text-center p-10">
                                    <div class="w-16 h-16 bg-white rounded-full shadow-sm grid place-items-center mx-auto mb-4 text-kej-muted">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-kej-ink">Ambil Foto Selfie</p>
                                    <p class="text-xs text-kej-muted mt-1">Gunakan kamera depan untuk hasil terbaik</p>
                                    
                                    <div class="mt-6 flex flex-col gap-3 items-center">
                                        <button type="button" id="start-camera" class="bg-kej-navy text-white px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-kej-green transition-all flex items-center gap-2">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                            Gunakan Kamera
                                        </button>
                                    </div>
                                </div>

                                <!-- Camera Video View -->
                                <video id="camera-stream" class="hidden w-full h-full object-cover bg-black" autoplay playsinline muted></video>
                                
                                <!-- Result Preview -->
                                <img id="photo-preview" src="#" alt="Preview" class="hidden w-full h-full object-cover">
                                
                                <!-- Scan Line Animation -->
                                <div id="scan-line" class="hidden absolute left-0 right-0 h-1 bg-kej-green shadow-[0_0_15px_var(--color-kej-green)] z-10 animate-scan"></div>

                                <!-- Camera Controls -->
                                <div id="camera-controls" class="hidden absolute bottom-6 left-0 right-0 flex justify-center gap-4 z-20">
                                    <button type="button" id="capture-photo" class="w-16 h-16 bg-white border-4 border-kej-green rounded-full flex items-center justify-center shadow-xl hover:scale-110 active:scale-95 transition-all">
                                        <div class="w-12 h-12 bg-kej-green rounded-full"></div>
                                    </button>
                                    <button type="button" id="stop-camera" class="absolute right-6 top-0 bottom-0 my-auto w-10 h-10 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-red-500 transition-all">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <!-- Retake Button -->
                                <button type="button" id="retake-photo" class="hidden absolute top-6 right-6 bg-black/50 text-white px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:bg-red-500 transition-all z-20 backdrop-blur-sm">
                                    Ambil Ulang
                                </button>
                            </div>
                            <input type="file" name="image" id="image-input" accept="image/*" capture="user" class="hidden" required>
                        </div>
                    </div>

                    <!-- GPS Section -->
                    <div>
                        <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-4">Langkah 2: Validasi Lokasi GPS</label>
                        <div id="location-box" class="bg-kej-bg border border-kej-border rounded-xl p-6 flex items-center gap-5 transition-all">
                            <div id="location-icon" class="w-14 h-14 bg-white rounded-xl grid place-items-center text-kej-muted shadow-sm shrink-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="flex-1">
                                <div id="location-status" class="text-sm font-bold text-kej-ink mb-1">Mencari Lokasi Anda...</div>
                                <div id="location-coords" class="text-xs text-kej-muted font-mono">Izin lokasi diperlukan untuk melanjutkan</div>
                            </div>
                            <button type="button" id="refresh-location" class="p-2 text-kej-green hover:bg-kej-green/5 rounded-lg transition-all hidden">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                            </button>
                        </div>
                        <input type="hidden" name="latitude" id="lat-input">
                        <input type="hidden" name="longitude" id="lng-input">
                        <input type="hidden" name="location_name" id="loc-name-input">
                    </div>
                </div>

                <div class="bg-kej-bg p-8 border-t border-kej-border flex justify-between items-center">
                    <p class="text-[11px] text-kej-muted font-bold tracking-wider uppercase max-w-[200px]">Data akan diverifikasi oleh Jaksa Pengawas</p>
                    <button type="submit" id="submit-btn" disabled class="bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg opacity-50 cursor-not-allowed transition-all">
                        Simpan Presensi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<canvas id="capture-canvas" class="hidden"></canvas>

@push('scripts')
<script>
    const imageInput = document.getElementById('image-input');
    const photoPreview = document.getElementById('photo-preview');
    const previewPlaceholder = document.getElementById('preview-placeholder');
    const scanLine = document.getElementById('scan-line');
    const submitBtn = document.getElementById('submit-btn');
    
    const startCameraBtn = document.getElementById('start-camera');
    const stopCameraBtn = document.getElementById('stop-camera');
    const captureBtn = document.getElementById('capture-photo');
    const retakeBtn = document.getElementById('retake-photo');
    const cameraStream = document.getElementById('camera-stream');
    const cameraControls = document.getElementById('camera-controls');
    const captureCanvas = document.getElementById('capture-canvas');

    const locationStatus = document.getElementById('location-status');
    const locationCoords = document.getElementById('location-coords');
    const locationBox = document.getElementById('location-box');
    const locationIcon = document.getElementById('location-icon');
    const refreshBtn = document.getElementById('refresh-location');
    
    const latInput = document.getElementById('lat-input');
    const lngInput = document.getElementById('lng-input');
    const locNameInput = document.getElementById('loc-name-input');

    let stream = null;
    let hasLocation = false;
    let hasPhoto = false;

    function checkReady() {
        if (hasLocation && hasPhoto) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.classList.add('bg-kej-green', 'hover:bg-kej-gold', 'hover:text-kej-navy');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-kej-green', 'hover:bg-kej-gold', 'hover:text-kej-navy');
        }
    }

    // Camera Logic
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: 'user',
                    width: { ideal: 640 },
                    height: { ideal: 480 }
                }, 
                audio: false 
            });
            cameraStream.srcObject = stream;
            cameraStream.onloadedmetadata = () => {
                cameraStream.play();
            };
            
            cameraStream.classList.remove('hidden');
            previewPlaceholder.classList.add('hidden');
            cameraControls.classList.remove('hidden');
            photoPreview.classList.add('hidden');
            retakeBtn.classList.add('hidden');
        } catch (err) {
            console.error("Error accessing camera:", err);
            alert("Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.");
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        cameraStream.classList.add('hidden');
        cameraControls.classList.add('hidden');
        if (!hasPhoto) {
            previewPlaceholder.classList.remove('hidden');
        }
    }

    startCameraBtn.addEventListener('click', startCamera);
    stopCameraBtn.addEventListener('click', stopCamera);

    captureBtn.addEventListener('click', () => {
        captureCanvas.width = cameraStream.videoWidth;
        captureCanvas.height = cameraStream.videoHeight;
        const ctx = captureCanvas.getContext('2d');
        ctx.drawImage(cameraStream, 0, 0, captureCanvas.width, captureCanvas.height);
        
        const dataUrl = captureCanvas.toDataURL('image/jpeg', 0.8);
        
        // Convert to File object and set to input
        captureCanvas.toBlob((blob) => {
            const file = new File([blob], "selfie.jpg", { type: "image/jpeg" });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageInput.files = dataTransfer.files;
            
            photoPreview.src = dataUrl;
            photoPreview.classList.remove('hidden');
            scanLine.classList.remove('hidden');
            retakeBtn.classList.remove('hidden');
            hasPhoto = true;
            
            stopCamera();
            checkReady();
        }, 'image/jpeg', 0.8);
    });

    retakeBtn.addEventListener('click', () => {
        hasPhoto = false;
        photoPreview.classList.add('hidden');
        scanLine.classList.add('hidden');
        retakeBtn.classList.add('hidden');
        imageInput.value = '';
        startCamera();
        checkReady();
    });

    // Handle Image Preview (File Upload Fallback)
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Tipe file tidak valid. Gunakan format JPEG, PNG, atau WebP.');
                this.value = '';
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran gambar terlalu besar. Maksimal 5MB.');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                previewPlaceholder.classList.add('hidden');
                scanLine.classList.remove('hidden');
                retakeBtn.classList.remove('hidden');
                hasPhoto = true;
                checkReady();
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle Geolocation
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    latInput.value = lat;
                    lngInput.value = lng;
                    
                    locationStatus.innerText = "Lokasi Berhasil Diverifikasi";
                    locationStatus.classList.remove('text-kej-ink');
                    locationStatus.classList.add('text-kej-green');
                    
                    locationCoords.innerText = `LAT: ${lat.toFixed(6)}, LNG: ${lng.toFixed(6)}`;
                    
                    locationBox.classList.add('border-kej-green', 'bg-kej-green/5');
                    locationIcon.classList.add('bg-kej-green', 'text-white');
                    locationIcon.classList.remove('bg-white', 'text-kej-muted');
                    
                    refreshBtn.classList.remove('hidden');
                    hasLocation = true;
                    checkReady();
                    
                    // Optional: Reverse Geocoding would go here
                    locNameInput.value = "Lokasi Kerja Terverifikasi";
                },
                (error) => {
                    locationStatus.innerText = "Gagal Mengakses Lokasi";
                    locationStatus.classList.add('text-red-600');
                    locationCoords.innerText = "Izin lokasi diblokir atau GPS tidak aktif.";
                    locationBox.classList.add('border-red-200', 'bg-red-50');
                }
            );
        } else {
            locationStatus.innerText = "GPS Tidak Didukung";
            locationCoords.innerText = "Browser Anda tidak mendukung fitur lokasi.";
        }
    }

    // Initial location check
    window.onload = getLocation;
    refreshBtn.onclick = getLocation;
</script>
@endpush
@endsection
