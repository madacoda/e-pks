<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Bulanan - {{ $user->name }}</title>
    <style>
        @page { margin: 1.5cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10px; color: #1a1a1a; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #1a1a1a; padding-bottom: 10px; }
        .header h1 { font-size: 14px; margin: 0; text-transform: uppercase; }
        
        .info { margin-bottom: 15px; }
        .info table { border: none; width: 100%; }
        .info td { border: none; padding: 2px 0; font-size: 11px; }
        
        table.data { width: 100%; border-collapse: collapse; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px; text-align: center; }
        table.data th { background: #f2f2f2; font-weight: bold; font-size: 9px; text-transform: uppercase; }
        
        .footer { position: fixed; bottom: -0.5cm; width: 100%; text-align: center; font-size: 8px; color: #777; }
        .status-hadir { font-weight: bold; color: #000; }
        .status-tidak-hadir { color: #d00; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN REKAPITULASI KEHADIRAN BULANAN</h1>
        <div style="font-weight: bold; margin-top: 5px;">{{ strtoupper(\Carbon\Carbon::create()->month($month)->translatedFormat('F')) }} {{ $year }}</div>
    </div>

    <div class="info">
        <table>
            <tr><td width="120">NAMA TERPIDANA</td><td>: {{ strtoupper($user->name) }}</td></tr>
            <tr><td>NIK</td><td>: {{ $user->national_id }}</td></tr>
            <tr><td>SATKER PENEMPATAN</td><td>: {{ $user->placement ? strtoupper($user->placement->name) : '-' }}</td></tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="30">NO</th>
                <th width="120">HARI / TANGGAL</th>
                <th width="80">WAKTU</th>
                <th>LOKASI / KETERANGAN</th>
                <th width="80">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absences as $index => $absence)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $absence->created_at->translatedFormat('l, d/m/Y') }}</td>
                <td>{{ $absence->created_at->format('H:i') }} WIB</td>
                <td style="text-align: left; font-size: 8px;">
                    {{ $absence->location_name ?? 'Lokasi tidak terdeteksi' }}<br>
                    <span style="color: #666;">({{ $absence->latitude }}, {{ $absence->longitude }})</span>
                </td>
                <td class="{{ $absence->status === 'hadir' ? 'status-hadir' : 'status-tidak-hadir' }}">
                    {{ strtoupper($absence->status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 20px; font-style: italic;">TIDAK ADA DATA KEHADIRAN PADA PERIODE INI</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right; font-size: 9px;">
        <p>Laporan ini dicetak secara otomatis melalui Sistem E-PKS pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="footer">
        Kejaksaan Republik Indonesia - Bidang Tindak Pidana Umum
    </div>
</body>
</html>
