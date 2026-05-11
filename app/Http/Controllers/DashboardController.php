<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isJaksa = $user->role === 'jaksa_pengawas';
        $isAdmin = $user->role === 'admin' || $isJaksa;

        // Fetch recent activities
        if ($user->role === 'admin') {
            $recentAbsences = Absence::with('user')->latest()->take(5)->get();
            $totalSessions = Absence::count();
        } elseif ($isJaksa) {
            $pidanaIds = $user->assignedPidana()->pluck('users.id');
            $recentAbsences = Absence::with('user')->whereIn('user_id', $pidanaIds)->latest()->take(5)->get();
            $totalSessions = Absence::whereIn('user_id', $pidanaIds)->count();
        } else {
            $recentAbsences = $user->absences()->latest()->take(3)->get();
            $totalSessions = $user->absences()->count();
        }

        // Calculate progress (only for non-admin)
        $totalHours = 0;
        $goalHours = 80;
        $progressPercentage = 0;

        if (! $isAdmin) {
            $hoursPerSession = 2; // Assuming 2 hours per social work session
            $totalHours = $totalSessions * $hoursPerSession;
            $progressPercentage = min(100, ($totalHours / $goalHours) * 100);
        }

        // Check today's status
        if ($user->role === 'admin') {
            $hasAbsenceToday = Absence::whereDate('created_at', Carbon::today())->exists();
            $status = $hasAbsenceToday ? 'AKTIVITAS MASUK' : 'BELUM ADA AKTIVITAS';
            $statusColor = $hasAbsenceToday ? 'text-kej-green' : 'text-kej-muted';
        } elseif ($isJaksa) {
            $pidanaIds = $user->assignedPidana()->pluck('users.id');
            $hasAbsenceToday = Absence::whereIn('user_id', $pidanaIds)->whereDate('created_at', Carbon::today())->exists();
            $status = $hasAbsenceToday ? 'AKTIVITAS MASUK' : 'BELUM ADA AKTIVITAS';
            $statusColor = $hasAbsenceToday ? 'text-kej-green' : 'text-kej-muted';
        } else {
            $hasAbsenceToday = $user->absences()
                ->whereDate('created_at', Carbon::today())
                ->exists();
            $status = $hasAbsenceToday ? 'SUDAH PRESENSI' : 'BELUM PRESENSI';
            $statusColor = $hasAbsenceToday ? 'text-kej-green' : 'text-kej-red';
        }

        return view('dashboard', compact(
            'recentAbsences',
            'totalSessions',
            'totalHours',
            'goalHours',
            'progressPercentage',
            'status',
            'statusColor',
            'hasAbsenceToday',
            'isAdmin'
        ));
    }
}
