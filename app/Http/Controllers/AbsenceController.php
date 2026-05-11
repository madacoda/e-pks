<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Absence::with('user')->latest();

        // Role-based filtering
        if ($user->role === 'pidana') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'jaksa_pengawas') {
            $query->whereHas('user.assignedJaksa', function ($q) use ($user) {
                $q->where('jaksa_id', $user->id);
            });
        }

        // Search & Filter
        if ($request->filled('user_id') && ($user->role === 'admin' || $user->role === 'jaksa_pengawas')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('location')) {
            $query->where('location_name', 'like', '%'.$request->location.'%');
        }

        if ($request->filled('flagged')) {
            $query->where('is_flagged', true);
        }

        $absences = $query->paginate(10)->withQueryString();

        // Get list of users for filter dropdown (Admins/Jaksas only)
        $users = collect();
        if ($user->role === 'admin') {
            $users = User::where('role', 'pidana')->orderBy('name')->get();
        } elseif ($user->role === 'jaksa_pengawas') {
            $users = $user->assignedPidana()->orderBy('name')->get();
        }

        return view('absences.index', compact('absences', 'users'));
    }

    public function create()
    {
        return view('absences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB max
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_name' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('absences', 'public');

        $user = Auth::user();
        $isFlagged = false;

        if ($user->location && $user->location->latitude && $user->location->longitude) {
            $distance = $this->calculateDistance(
                $request->latitude,
                $request->longitude,
                $user->location->latitude,
                $user->location->longitude
            );

            if ($distance > 500) {
                $isFlagged = true;
            }
        }

        Absence::create([
            'user_id' => $user->id,
            'image_path' => $path,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_name' => $request->location_name,
            'status' => 'present',
            'is_flagged' => $isFlagged,
        ]);

        $message = $isFlagged
            ? 'Presensi berhasil disimpan, namun lokasi Anda terdeteksi di luar radius Satker.'
            : 'Presensi berhasil disimpan.';

        return redirect()->route('dashboard')->with('success', $message);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
