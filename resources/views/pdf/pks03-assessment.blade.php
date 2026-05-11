<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PKS-03 - Penilaian Ketersediaan Layanan Pendukung</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11pt; line-height: 1.5; color: #000; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; }
        h1, h2, h3, h4 { text-align: center; margin: 5px 0; font-weight: bold; }
        h1 { font-size: 14pt; }
        h2 { font-size: 12pt; margin-bottom: 20px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .mt-10 { margin-top: 10px; }
        .mt-20 { margin-top: 20px; }
        .mt-30 { margin-top: 30px; }
        .mb-10 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 6px 8px; font-size: 10pt; vertical-align: top; }
        th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        .section-title { font-weight: bold; margin-top: 20px; margin-bottom: 5px; font-size: 11pt; border-bottom: 1px solid #000; padding-bottom: 3px; }
        .check-box { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-right: 5px; position: relative; top: 2px; }
        .checked { background-color: #000; }
        .footer-sig { width: 100%; margin-top: 50px; }
        .footer-sig table { border: none; }
        .footer-sig td { border: none; text-align: center; width: 50%; padding: 0; }
        .info-table { border: none; margin-bottom: 20px; }
        .info-table td { border: none; padding: 3px 0; font-size: 11pt; }
        .label-col { width: 180px; }
        .colon-col { width: 10px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-right" style="font-size: 10pt; font-weight: bold; margin-bottom: 20px;">PKS-03</div>
        
        <h1>PENILAIAN KETERSEDIAAN LAYANAN PENDUKUNG</h1>
        <h2>PELAKSANAAN PIDANA KERJA SOSIAL</h2>

        <table class="info-table">
            <tr>
                <td class="label-col">Nama Terpidana</td>
                <td class="colon-col">:</td>
                <td class="font-bold">{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label-col">No. Register Perkara</td>
                <td class="colon-col">:</td>
                <td>{{ $user->pks02_case_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Satker Penempatan</td>
                <td class="colon-col">:</td>
                <td>{{ $user->placement->name ?? '-' }}</td>
            </tr>
        </table>

        <div class="section-title">A. KETERSEDIAAN LEMBAGA / FASILITAS DUKUNGAN</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 30%;">Nama Lembaga/Fasilitas</th>
                    <th style="width: 25%;">Jenis Layanan</th>
                    <th style="width: 25%;">Alamat/Kontak</th>
                    <th style="width: 15%;">Ketersediaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assessment->institutions as $index => $inst)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $inst->institution_name }}</td>
                    <td>{{ str_replace('_', ' ', \Illuminate\Support\Str::title($inst->service_type)) }}</td>
                    <td>{{ $inst->address_contact ?? '-' }}</td>
                    <td class="text-center">{{ $inst->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                </tr>
                @endforeach
                @if($assessment->institutions->isEmpty())
                <tr>
                    <td colspan="5" class="text-center" style="font-style: italic;">Tidak ada data lembaga/fasilitas dukungan yang dicatat.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="section-title mt-20">B. KETERSEDIAAN PEMBIMBING KEMASYARAKATAN (BAPAS)</div>
        <div style="margin-left: 10px; margin-top: 10px;">
            <div style="margin-bottom: 5px;">
                <span class="check-box {{ $assessment->bapas_available ? 'checked' : '' }}"></span>
                Pembimbing Kemasyarakatan tersedia di wilayah tersebut
            </div>
            
            <table class="info-table" style="margin-left: 20px; margin-top: 5px; margin-bottom: 10px;">
                <tr>
                    <td style="width: 150px;">Nama BAPAS/Lembaga</td>
                    <td class="colon-col">:</td>
                    <td>{{ $assessment->bapas_institution_name ?? '-' }}</td>
                </tr>
            </table>

            <div>
                <span class="check-box {{ $assessment->guidance_program_available ? 'checked' : '' }}"></span>
                Program pembimbingan sesuai dengan kebutuhan terpidana
            </div>
        </div>

        <div class="section-title mt-30">C. KESIMPULAN PENILAIAN</div>
        <div style="margin-left: 10px; margin-top: 10px;">
            <div style="margin-bottom: 8px;">
                <span class="check-box {{ $assessment->conclusion === 'tersedia_memadai' ? 'checked' : '' }}"></span>
                <strong>Tersedia & Memadai:</strong> Fasilitas dan pembimbing siap mendukung pelaksanaan PKS.
            </div>
            <div style="margin-bottom: 8px;">
                <span class="check-box {{ $assessment->conclusion === 'tersedia_terbatas' ? 'checked' : '' }}"></span>
                <strong>Tersedia Terbatas:</strong> Ada fasilitas namun dengan keterbatasan (jarak, kapasitas).
            </div>
            <div>
                <span class="check-box {{ $assessment->conclusion === 'tidak_tersedia' ? 'checked' : '' }}"></span>
                <strong>Tidak Tersedia:</strong> Tidak ada fasilitas atau pembimbing yang memadai.
            </div>
        </div>

        @if($assessment->notes)
        <div class="section-title mt-20">CATATAN / KETERANGAN TAMBAHAN</div>
        <div style="margin-left: 10px; margin-top: 10px; border: 1px solid #000; padding: 10px; min-height: 60px;">
            {!! nl2br(e($assessment->notes)) !!}
        </div>
        @endif

        <div class="footer-sig">
            <table>
                <tr>
                    <td></td>
                    <td>
                        <div>Tanggal Penilaian: {{ $assessment->assessed_at->format('d F Y') }}</div>
                        <div class="mt-10 mb-10">Penilai (Penuntut Umum/Jaksa)</div>
                        <br><br><br>
                        <div class="font-bold" style="text-decoration: underline;">{{ $assessment->assessed_by }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
