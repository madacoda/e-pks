<div style="font-family: sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
    <div style="background-color: #002d24; color: white; padding: 24px; text-align: center;">
        <h1 style="margin: 0; font-size: 20px; text-transform: uppercase; letter-spacing: 2px;">E-PKS Kejaksaan RI</h1>
    </div>
    <div style="padding: 32px; color: #1a202c; line-height: 1.6;">
        <h2 style="margin-top: 0; color: #002d24;">Laporan / Aduan Baru</h2>
        <p>Yth. Bapak/Ibu Jaksa Pengawas,</p>
        <p>Sistem telah menerima laporan/aduan baru dari terpidana binaan yang Anda awasi:</p>
        
        <div style="background-color: #f7fafc; padding: 20px; border-radius: 8px; margin: 24px 0;">
            <p style="margin: 0 0 8px 0;"><strong>Nama Terpidana:</strong> {{ $complaint->user->name ?? 'Anonim' }}</p>
            <p style="margin: 0 0 8px 0;"><strong>Subjek:</strong> {{ $complaint->subject }}</p>
            <p style="margin: 0;"><strong>Isi Laporan:</strong><br>{{ $complaint->content }}</p>
        </div>

        <p>Silakan login ke Dashboard E-PKS untuk menindaklanjuti laporan ini.</p>
        
        <div style="text-align: center; margin-top: 32px;">
            <a href="{{ route('login') }}" style="background-color: #1a6e30; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px;">Buka Dashboard</a>
        </div>
    </div>
    <div style="background-color: #f7fafc; color: #718096; padding: 16px; text-align: center; font-size: 12px;">
        &copy; {{ date('Y') }} Kejaksaan Republik Indonesia. Seluruh hak cipta dilindungi.
    </div>
</div>
