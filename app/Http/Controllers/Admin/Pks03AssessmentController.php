<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pks03AssessmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (Auth::user()->role !== 'admin') {
                    abort(403, 'Unauthorized action.');
                }

                return $next($request);
            },
        ];
    }

    public function show(User $user)
    {
        $assessment = $user->pks03Assessment()->with('institutions')->first();

        $locations = Location::where('placement_id', $user->placement_id)
            ->select('name', 'address', 'phone', 'pic_name')
            ->get();

        return view('admin.users.pks03-assessment', compact('user', 'assessment', 'locations'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'assessed_by' => 'required|string|max:255',
            'assessed_at' => 'required|date',
            'bapas_available' => 'boolean',
            'bapas_institution_name' => 'nullable|string|max:255|required_if:bapas_available,1',
            'guidance_program_available' => 'boolean',
            'conclusion' => 'required|in:tersedia_memadai,tersedia_terbatas,tidak_tersedia',
            'notes' => 'nullable|string',
            'institutions' => 'array',
            'institutions.*.institution_name' => 'required|string|max:255',
            'institutions.*.service_type' => 'required|in:rumah_sakit,panti_asuhan,panti_lansia,sekolah,lembaga_sosial_lain',
            'institutions.*.address_contact' => 'nullable|string|max:255',
            'institutions.*.is_available' => 'boolean',
        ]);

        DB::transaction(function () use ($validated, $user) {
            $assessment = $user->pks03Assessment()->create([
                'assessed_by' => $validated['assessed_by'],
                'assessed_at' => $validated['assessed_at'],
                'bapas_available' => $validated['bapas_available'] ?? false,
                'bapas_institution_name' => $validated['bapas_institution_name'] ?? null,
                'guidance_program_available' => $validated['guidance_program_available'] ?? false,
                'conclusion' => $validated['conclusion'],
                'notes' => $validated['notes'] ?? null,
            ]);

            if (! empty($validated['institutions'])) {
                $assessment->institutions()->createMany($validated['institutions']);
            }
        });

        return redirect()->route('admin.pks03-assessment.show', $user)
            ->with('success', 'Penilaian ketersediaan layanan berhasil disimpan.');
    }

    public function update(Request $request, User $user)
    {
        $assessment = $user->pks03Assessment;
        if (! $assessment) {
            return redirect()->route('admin.pks03-assessment.show', $user)
                ->with('error', 'Penilaian tidak ditemukan.');
        }

        $validated = $request->validate([
            'assessed_by' => 'required|string|max:255',
            'assessed_at' => 'required|date',
            'bapas_available' => 'boolean',
            'bapas_institution_name' => 'nullable|string|max:255|required_if:bapas_available,1',
            'guidance_program_available' => 'boolean',
            'conclusion' => 'required|in:tersedia_memadai,tersedia_terbatas,tidak_tersedia',
            'notes' => 'nullable|string',
            'institutions' => 'array',
            'institutions.*.institution_name' => 'required|string|max:255',
            'institutions.*.service_type' => 'required|in:rumah_sakit,panti_asuhan,panti_lansia,sekolah,lembaga_sosial_lain',
            'institutions.*.address_contact' => 'nullable|string|max:255',
            'institutions.*.is_available' => 'boolean',
        ]);

        DB::transaction(function () use ($validated, $assessment) {
            $assessment->update([
                'assessed_by' => $validated['assessed_by'],
                'assessed_at' => $validated['assessed_at'],
                'bapas_available' => $validated['bapas_available'] ?? false,
                'bapas_institution_name' => $validated['bapas_institution_name'] ?? null,
                'guidance_program_available' => $validated['guidance_program_available'] ?? false,
                'conclusion' => $validated['conclusion'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Sync institutions: delete all and recreate
            $assessment->institutions()->delete();
            if (! empty($validated['institutions'])) {
                $assessment->institutions()->createMany($validated['institutions']);
            }
        });

        return redirect()->route('admin.pks03-assessment.show', $user)
            ->with('success', 'Penilaian ketersediaan layanan berhasil diperbarui.');
    }

    public function pdf(User $user)
    {
        $assessment = $user->pks03Assessment()->with('institutions')->first();

        if (! $assessment) {
            return redirect()->back()->with('error', 'Penilaian belum dilakukan.');
        }

        $pdf = Pdf::loadView('pdf.pks03-assessment', compact('user', 'assessment'));

        return $pdf->stream("PKS-03_Hal1_{$user->name}.pdf");
    }
}
