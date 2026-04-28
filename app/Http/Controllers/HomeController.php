<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pidanas = User::where('role', 'pidana')->withCount('absences')->latest()->take(3)->get();
        return view('index', compact('pidanas'));
    }

    public function pidanaList(Request $request)
    {
        $query = User::where('role', 'pidana')->withCount('absences');

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }

        $pidanas = $query->get();
        return view('pidana.index', compact('pidanas'));
    }

    public function pidanaShow(User $user)
    {
        if ($user->role !== 'pidana') {
            abort(404);
        }
        
        $absences = $user->absences()->latest()->get();
        return view('pidana.show', compact('user', 'absences'));
    }
}
