<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class PdfExportController extends Controller implements HasMiddleware
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

    public function pks02(User $user)
    {
        // Set paper to A4
        $pdf = Pdf::loadView('pdf.pks02', compact('user'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("PKS-02_{$user->name}.pdf");
    }

    public function pks03(User $user)
    {
        $pdf = Pdf::loadView('pdf.pks03', compact('user'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("PKS-03_{$user->name}.pdf");
    }

    public function monthlyAbsence(Request $request, User $user)
    {
        $month = (int) $request->get('month', now()->month);
        if (!$month) {
            $month = now()->month;
        }
        
        $year = (int) $request->get('year', now()->year);
        if (!$year) {
            $year = now()->year;
        }

        $absences = $user->absences()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.monthly-absence', compact('user', 'absences', 'month', 'year'))
            ->setPaper('a4', 'portrait');

        $monthName = Carbon::create()->month($month)->translatedFormat('F');

        return $pdf->download("Absensi_{$monthName}_{$year}_{$user->name}.pdf");
    }
}
