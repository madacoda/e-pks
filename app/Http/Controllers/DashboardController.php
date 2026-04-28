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
        
        // Fetch recent activities
        $recentAbsences = $user->absences()->latest()->take(3)->get();
        
        // Calculate progress
        $totalSessions = $user->absences()->count();
        $hoursPerSession = 2; // Assuming 2 hours per social work session
        $totalHours = $totalSessions * $hoursPerSession;
        $goalHours = 80; // Default goal
        $progressPercentage = min(100, ($totalHours / $goalHours) * 100);
        
        // Check today's status
        $hasAbsenceToday = $user->absences()
            ->whereDate('created_at', Carbon::today())
            ->exists();
            
        $status = $hasAbsenceToday ? 'SUDAH PRESENSI' : 'BELUM PRESENSI';
        $statusColor = $hasAbsenceToday ? 'text-kej-green' : 'text-kej-red';

        return view('dashboard', compact(
            'recentAbsences', 
            'totalSessions', 
            'totalHours', 
            'goalHours', 
            'progressPercentage', 
            'status',
            'statusColor',
            'hasAbsenceToday'
        ));
    }
}
