<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PKS-03 - {{ $user->name }}</title>
    <style>
        @page { margin: 2cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #1a1a1a; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #1a1a1a; padding-bottom: 10px; }
        .header h1 { font-size: 14px; margin: 0; text-transform: uppercase; letter-spacing: 1px; }
        .header p { font-size: 10px; margin: 5px 0 0; font-weight: bold; color: #555; }
        
        .info-table { width: 100%; margin-bottom: 20px; border: none; }
        .info-table td { border: none; padding: 3px 0; font-size: 11px; }
        .info-table td.label { width: 150px; font-weight: bold; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data-table th, table.data-table td { border: 1px solid #1a1a1a; padding: 8px; text-align: center; font-size: 10px; }
        table.data-table th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        
        .footer { position: fixed; bottom: -1cm; left: 0; width: 100%; text-align: center; font-size: 9px; color: #95a5a6; border-top: 1px solid #eee; padding-top: 5px; }
        .form-code { position: absolute; top: -1cm; right: 0; font-weight: bold; font-size: 12px; }

        .total-row { background-color: #fafafa; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-code">PKS-03</div>

    <div class="header">
        <h1>CATATAN PENGAWASAN TERPIDANA</h1>
        <p>PEDOMAN JAKSA AGUNG NOMOR 1 TAHUN 2025</p>
    </div>

    <table class="info-table">
        <tr><td class="label">Nama Terpidana</td><td>: {{ $user->name }}</td></tr>
        <tr><td class="label">NIK</td><td>: {{ $user->national_id }}</td></tr>
        <tr><td class="label">Satker Penempatan</td><td>: {{ $user->placement ? $user->placement->name : '-' }}</td></tr>
        <tr><td class="label">Hukuman</td><td>: {{ $user->sentence }}</td></tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="25">No</th>
                <th width="75">Tanggal</th>
                <th width="100">Waktu (Jam)</th>
                <th width="60">Durasi</th>
                <th>Kepatuhan</th>
                <th>Perilaku</th>
                <th>Catatan / Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalMinutes = 0; @endphp
            @forelse($user->supervisions()->orderBy('supervision_date', 'asc')->get() as $index => $supervision)
            @php
                $start = \Carbon\Carbon::parse($supervision->start_time);
                $end = \Carbon\Carbon::parse($supervision->end_time);
                $diff = $start->diffInMinutes($end);
                $totalMinutes += $diff;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $supervision->supervision_date->format('d/m/Y') }}</td>
                <td>{{ $supervision->start_time }} - {{ $supervision->end_time }}</td>
                <td>
                    @php
                        $hours = floor($diff / 60);
                        $minutes = $diff % 60;
                        echo $hours . 'j ' . $minutes . 'm';
                    @endphp
                </td>
                <td>{{ $supervision->compliance_status }}</td>
                <td>{{ $supervision->behavior_status }}</td>
                <td style="text-align: left;">{{ $supervision->notes }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 20px; font-style: italic; color: #777;">Belum ada catatan pengawasan (PKS-03) yang terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
        @if($totalMinutes > 0)
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">TOTAL DURASI REALISASI KERJA SOSIAL</td>
                <td>
                    @php
                        $tHours = floor($totalMinutes / 60);
                        $tMinutes = $totalMinutes % 60;
                        echo $tHours . ' jam ' . $tMinutes . ' menit';
                    @endphp
                </td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh Sistem E-PKS Kejaksaan Republik Indonesia pada {{ now()->format('d/m/Y H:i:s') }}.<br>
        Seluruh data bersifat rahasia dan merupakan bagian dari arsip pengawasan kejaksaan.
    </div>
</body>
</html>
