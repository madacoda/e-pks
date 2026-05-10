<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Pks03Supervision;
use App\Models\Placement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller implements HasMiddleware
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

    public function index(Request $request)
    {
        $query = User::with('placement')->withCount('absences');

        if ($request->filled('placement_id')) {
            $query->where('placement_id', $request->placement_id);
        }

        $users = $query->get();
        $placements = Placement::all();

        // Monitoring Stats
        $stats = [
            'total_pidana' => $users->where('role', 'pidana')->count(),
            'total_absences' => Absence::count(),
            'total_supervisions' => Pks03Supervision::count(),
            'recent_absences' => Absence::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.index', compact('users', 'placements', 'stats'));
    }

    public function edit(User $user)
    {
        $placements = Placement::all();

        return view('admin.edit', compact('user', 'placements'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:16',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,pidana',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'religion' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'crime' => 'nullable|string|max:255',
            'sentence' => 'nullable|string|max:255',
            'placement_id' => 'nullable|exists:placements,id',
            'pks02_prosecutor_name' => 'nullable|string|max:255',
            'pks02_case_number' => 'nullable|string|max:255',
            'pks02_opinion_analysis' => 'nullable|string',
            'pks02_opinion_recommendation' => 'nullable|string',
            'pks02_opinion_conclusion' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }
}
