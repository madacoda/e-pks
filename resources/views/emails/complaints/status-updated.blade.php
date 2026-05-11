<x-mail::message>
# Halo, {{ $complaint->name ?? 'Pelapor' }}

Kami ingin memberitahukan bahwa status laporan aduan Anda dengan subjek **"{{ $complaint->subject }}"** telah diperbarui.

**Status Saat Ini:** 
<x-mail::panel>
{{ strtoupper($complaint->status) }}
</x-mail::panel>

@if($complaint->admin_response)
**Tanggapan dari Tim Pengawas:**
{{ $complaint->admin_response }}
@endif

Terima kasih atas partisipasi Anda dalam membantu pengawasan Pidana Kerja Sosial yang transparan dan akuntabel.

Salam,<br>
Tim Pengawas E-PKS<br>
Kejaksaan Republik Indonesia
</x-mail::message>
