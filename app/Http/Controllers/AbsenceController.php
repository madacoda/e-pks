<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Auth::user()->absences()->latest()->get();

        return view('absences.index', compact('absences'));
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

        Absence::create([
            'user_id' => Auth::id(),
            'image_path' => $path,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_name' => $request->location_name,
            'status' => 'present',
        ]);

        return redirect()->route('dashboard')->with('success', 'Presensi berhasil disimpan.');
    }
}
