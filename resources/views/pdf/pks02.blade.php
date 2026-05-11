<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PKS-02 - {{ $user->name }}</title>
    <style>
        @page { margin: 2cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #1a1a1a; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #1a1a1a; padding-bottom: 10px; }
        .header h1 { font-size: 14px; margin: 0; text-transform: uppercase; letter-spacing: 1px; }
        .header p { font-size: 10px; margin: 5px 0 0; font-weight: bold; color: #555; }
        
        .section-title { background: #f8f9fa; padding: 6px 10px; font-weight: bold; border: 1px solid #e0e0e0; margin-top: 15px; margin-bottom: 8px; text-transform: uppercase; color: #2c3e50; font-size: 11px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; table-layout: fixed; }
        table, th, td { border: 1px solid #e0e0e0; }
        th, td { padding: 7px 10px; text-align: left; vertical-align: top; word-wrap: break-word; }
        th { width: 35%; background-color: #fafafa; font-weight: bold; color: #34495e; font-size: 10px; text-transform: uppercase; }
        
        .page-break { page-break-after: always; }
        .footer { position: fixed; bottom: -1cm; left: 0; width: 100%; text-align: center; font-size: 9px; color: #95a5a6; border-top: 1px solid #eee; padding-top: 5px; }
        
        .value-text { font-size: 11px; color: #000; }
        .empty-value { color: #bdc3c7; font-style: italic; }

        .form-code { position: absolute; top: -1cm; right: 0; font-weight: bold; font-size: 12px; }
    </style>
</head>
<body>
    <div class="form-code">PKS-02</div>

    <div class="header">
        <h1>HASIL PROFILING TERSANGKA / TERDAKWA</h1>
        <p>PEDOMAN JAKSA AGUNG NOMOR 1 TAHUN 2025</p>
    </div>

    <div class="section-title">I. IDENTITAS TERSANGKA / TERDAKWA</div>
    <table>
        <tr><th>Nama Lengkap</th><td class="value-text">{{ $user->name }}</td></tr>
        <tr><th>NIK / No. Identitas</th><td class="value-text">{{ $user->national_id }}</td></tr>
        <tr><th>Tempat / Tgl Lahir</th><td class="value-text">{{ $user->place_of_birth }}, {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d F Y') : '-' }}</td></tr>
        <tr><th>Jenis Kelamin</th><td class="value-text">{{ $user->gender }}</td></tr>
        <tr><th>Agama</th><td class="value-text">{{ $user->religion }}</td></tr>
        <tr><th>Kewarganegaraan</th><td class="value-text">{{ $user->nationality ?? '-' }}</td></tr>
        <tr><th>Pendidikan Terakhir</th><td class="value-text">{{ $user->education }}</td></tr>
        <tr><th>Pekerjaan</th><td class="value-text">{{ $user->occupation }}</td></tr>
        <tr><th>Status Perkawinan</th><td class="value-text">{{ $user->marital_status ?? '-' }}</td></tr>
        <tr><th>Alamat Domisili</th><td class="value-text">{{ $user->address }}</td></tr>
        <tr><th>Alamat KTP</th><td class="value-text">{{ $user->ktp_address ?? $user->address }}</td></tr>
        <tr><th>Nomor Telepon</th><td class="value-text">{{ $user->phone_number ?? '-' }}</td></tr>
    </table>

    <div class="section-title">II. LATAR BELAKANG KEHIDUPAN</div>
    @php $background = is_array($user->pks02_background) ? $user->pks02_background : json_decode($user->pks02_background, true) ?? []; @endphp
    <table>
        <tr>
            <th>Riwayat Pendidikan</th>
            <td class="value-text">
                <strong>{{ $user->education }}</strong><br>
                {{ $background['edu_institution'] ?? '' }} (Lulus: {{ $background['edu_graduation_year'] ?? '-' }})<br>
                <small>Prestasi: {{ $background['edu_achievement'] ?? '-' }}</small><br>
                <p>{{ $background['edu_notes'] ?? '-' }}</p>
            </td>
        </tr>
        <tr>
            <th>Riwayat Pekerjaan</th>
            <td class="value-text">
                <strong>{{ $user->occupation }}</strong><br>
                Status: {{ $background['employment_status'] ?? '-' }}<br>
                Penghasilan: {{ isset($background['monthly_income']) ? 'Rp ' . number_format($background['monthly_income'], 0, ',', '.') : '-' }}<br>
                <p>{{ $background['work_history'] ?? '-' }}</p>
            </td>
        </tr>
        <tr>
            <th>Riwayat Kesehatan</th>
            <td class="value-text">
                Fisik: {{ $background['health_physical_status'] ?? '-' }}<br>
                Mental: {{ $background['health_mental_status'] ?? '-' }}<br>
                Ketergantungan: {{ $background['health_addiction_status'] ?? '-' }}<br>
                <p>Catatan: {{ $background['health_disease_history'] ?? '-' }}</p>
            </td>
        </tr>
        <tr>
            <th>Riwayat Hukum</th>
            <td class="value-text">
                {{ $user->has_criminal_record ? 'Pernah dihukum' : 'Tidak pernah dihukum' }}<br>
                <p>{{ $user->criminal_record_details ?? '-' }}</p>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <div class="section-title">III. PROFIL KELUARGA</div>
    @php $family = is_array($user->pks02_family_profile) ? $user->pks02_family_profile : json_decode($user->pks02_family_profile, true) ?? []; @endphp
    <table>
        <tr>
            <th>Orang Tua</th>
            <td class="value-text">
                Ayah: {{ $family['father_name'] ?? '-' }} ({{ $family['father_status'] ?? '' }})<br>
                Ibu: {{ $family['mother_name'] ?? '-' }} ({{ $family['mother_status'] ?? '' }})<br>
                Hubungan: {{ $family['parent_relationship'] ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>Kondisi Keluarga</th>
            <td class="value-text">
                Ekonomi: {{ $family['family_economic_status'] ?? '-' }}<br>
                Hubungan: {{ $family['family_relationship_status'] ?? '-' }}<br>
                <p>Anggota Serumah: {{ $family['family_members'] ?? '-' }}</p>
            </td>
        </tr>
        <tr>
            <th>Dukungan Keluarga</th>
            <td class="value-text">
                Sikap: {{ $family['family_support_attitude'] ?? '-' }}<br>
                Kesediaan Mendampingi: {{ $family['family_willing_to_accompany'] ?? '-' }}
            </td>
        </tr>
    </table>

    <div class="section-title">IV. LINGKUNGAN SEKITAR</div>
    @php $env = is_array($user->pks02_environment) ? $user->pks02_environment : json_decode($user->pks02_environment, true) ?? []; @endphp
    <table>
        <tr>
            <th>Lingkungan Tempat Tinggal</th>
            <td class="value-text">
                Wilayah: {{ $env['kelurahan'] ?? '-' }}, {{ $env['kecamatan'] ?? '-' }}<br>
                Klasifikasi: {{ $env['area_classification'] ?? '-' }}<br>
                Kriminalitas: {{ $env['neighborhood_crime_level'] ?? '-' }}
            </td>
        </tr>
        <tr>
            <th>Persepsi & Kondisi</th>
            <td class="value-text">
                Persepsi Masyarakat: {{ $env['community_perception'] ?? '-' }}<br>
                Karakteristik Sosial: {{ $env['neighborhood_social_culture'] ?? '-' }}
            </td>
        </tr>
    </table>

    <div class="section-title">V. KESEHARIAN TERSANGKA</div>
    @php $daily = is_array($user->pks02_daily_life) ? $user->pks02_daily_life : json_decode($user->pks02_daily_life, true) ?? []; @endphp
    <table>
        <tr><th>Rutinitas Harian</th><td class="value-text">{{ $daily['daily_routine'] ?? '-' }}</td></tr>
        <tr><th>Kegiatan Sosial & Hobi</th><td class="value-text">{{ $daily['hobbies'] ?? '-' }} (Organisasi: {{ $daily['social_organizations'] ?? '-' }})</td></tr>
        <tr><th>Kepribadian</th><td class="value-text">Motivasi Berubah: {{ $daily['rehabilitation_motivation'] ?? '-' }}<br>Catatan: {{ $daily['personality_notes'] ?? '-' }}</td></tr>
    </table>

    <div class="section-title">VI. KEMAMPUAN KERJA SOSIAL</div>
    @php $work = is_array($user->pks02_work_capability) ? $user->pks02_work_capability : json_decode($user->pks02_work_capability, true) ?? []; @endphp
    <table>
        <tr><th>Kemampuan Fisik</th><td class="value-text">{{ $work['physical_work_capability'] ?? '-' }}<br><small>{{ $work['physical_limitation_notes'] ?? '' }}</small></td></tr>
        <tr><th>Keahlian / Keterampilan</th><td class="value-text">{{ $work['skills'] ?? '-' }}</td></tr>
        <tr><th>Rekomendasi Penempatan</th><td class="value-text">Lembaga: {{ $user->placement ? $user->placement->name : '-' }}<br>Jenis Pekerjaan: {{ $work['recommended_work_type'] ?? '-' }}<br>Kemampuan Selesai: {{ $work['pks_completion_capability'] ?? '-' }}</td></tr>
    </table>

    <div class="section-title">VII. PENDAPAT HUKUM PENUNTUT UMUM</div>
    <table>
        <tr><th>Analisis Hukum</th><td class="value-text">{{ $user->pks02_opinion_analysis ?? '-' }}</td></tr>
        <tr><th>Rekomendasi Kelayakan</th><td class="value-text">{{ $user->pks02_opinion_recommendation ?? '-' }}</td></tr>
        <tr><th>Kesimpulan</th><td class="value-text">{{ $user->pks02_opinion_conclusion ?? '-' }}</td></tr>
    </table>

    <div class="section-title">VIII. METODE PROFILING</div>
    @php $meta = is_array($user->pks02_profiling_meta) ? $user->pks02_profiling_meta : json_decode($user->pks02_profiling_meta, true) ?? []; @endphp
    <table>
        <tr><th>Sumber Data</th><td class="value-text">{{ is_array($meta['sources'] ?? null) ? implode(', ', $meta['sources']) : ($meta['sources'] ?? '-') }}</td></tr>
        <tr><th>Tanggal Pelaksanaan</th><td class="value-text">{{ $meta['date'] ?? '-' }}</td></tr>
        <tr><th>Petugas Profiling</th><td class="value-text">{{ $meta['officer_name'] ?? '-' }}</td></tr>
    </table>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh Sistem E-PKS Kejaksaan Republik Indonesia pada {{ now()->format('d/m/Y H:i:s') }}.<br>
        Seluruh data bersifat rahasia dan hanya digunakan untuk kepentingan penegakan hukum.
    </div>
</body>
</html>
