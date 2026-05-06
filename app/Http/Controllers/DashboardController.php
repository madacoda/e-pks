<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';
        
        // Fetch recent activities
        if ($isAdmin) {
            $recentAbsences = \App\Models\Absence::with('user')->latest()->take(5)->get();
            $totalSessions = \App\Models\Absence::count();
        } else {
            $recentAbsences = $user->absences()->latest()->take(3)->get();
            $totalSessions = $user->absences()->count();
        }
        
        // Calculate progress (only for non-admin)
        $totalHours = 0;
        $goalHours = 80;
        $progressPercentage = 0;
        
        if (!$isAdmin) {
            $hoursPerSession = 2; // Assuming 2 hours per social work session
            $totalHours = $totalSessions * $hoursPerSession;
            $progressPercentage = min(100, ($totalHours / $goalHours) * 100);
        }
        
        // Check today's status
        if ($isAdmin) {
            $hasAbsenceToday = \App\Models\Absence::whereDate('created_at', Carbon::today())->exists();
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
