<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class SettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (\Illuminate\Support\Facades\Auth::user()->role !== 'admin') {
                    abort(403, 'Unauthorized action.');
                }
                return $next($request);
            }
        ];
    }

    public function index()
    {
        // For PKS-06a regulations
        $regulations_kewajiban = Setting::get('regulations_kewajiban');
        $regulations_larangan = Setting::get('regulations_larangan');
        $regulations_monitoring = Setting::get('regulations_monitoring');

        // Defaults if null
        if ($regulations_kewajiban === null) {
            $regulations_kewajiban = json_encode([
                "Wajib hadir tepat waktu di lokasi kerja sosial yang telah ditentukan (Satker) sesuai jadwal yang disepakati.",
                "Melakukan presensi digital secara real-time menggunakan aplikasi E-PKS (Selfie & GPS) pada saat mulai dan selesai kegiatan.",
                "Menjaga sikap, perilaku, dan etika selama menjalankan tugas kerja sosial di lingkungan masyarakat atau instansi terkait.",
                "Dilarang meninggalkan wilayah hukum tempat pelaksanaan PKS tanpa izin tertulis dari Jaksa Pengawas."
            ]);
        }
        
        if ($regulations_larangan === null) {
            $regulations_larangan = json_encode([
                "Pemberian Surat Peringatan (SP 1, 2, dan 3).",
                "Penambahan durasi jam kerja sosial sebagai bentuk penalti.",
                "Pelaporan kepada Pengadilan untuk evaluasi status pidana (Kemungkinan eksekusi pidana penjara)."
            ]);
        }

        if ($regulations_monitoring === null) {
            $regulations_monitoring = "Jaksa Pengawas menggunakan dashboard E-PKS untuk memantau keberadaan dan aktivitas Terpidana. Sistem secara otomatis memberikan notifikasi jika Terpidana berada di luar radius lokasi yang ditentukan atau tidak melakukan presensi sesuai jadwal.";
        }

        return view('admin.settings.index', compact('regulations_kewajiban', 'regulations_larangan', 'regulations_monitoring'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'regulations_kewajiban' => 'required|string',
            'regulations_larangan' => 'required|string',
            'regulations_monitoring' => 'required|string',
        ]);

        // Clean up input newlines to array of strings
        $kewajiban = array_filter(array_map('trim', explode("\n", $validated['regulations_kewajiban'])));
        $larangan = array_filter(array_map('trim', explode("\n", $validated['regulations_larangan'])));

        Setting::set('regulations_kewajiban', json_encode(array_values($kewajiban)));
        Setting::set('regulations_larangan', json_encode(array_values($larangan)));
        Setting::set('regulations_monitoring', $validated['regulations_monitoring']);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
