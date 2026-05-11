<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Complaint;
use App\Models\Pks03Supervision;
use App\Models\Placement;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (!in_array(Auth::user()->role, ['admin', 'jaksa_pengawas'])) {
                    abort(403, 'Unauthorized action.');
                }

                return $next($request);
            },
        ];
    }

    public function index(Request $request)
    {
        $query = User::with('placement')->withCount('absences');

        if (Auth::user()->role === 'jaksa_pengawas') {
            $query->whereHas('assignedJaksa', function ($q) {
                $q->where('jaksa_id', Auth::id());
            });
        }

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
            'total_complaints' => Complaint::count(),
            'recent_absences' => Absence::with('user')->latest()->take(5)->get(),
        ];

        // Compliance Chart Data (Last 7 Days)
        $compliance_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $hadir = Absence::whereDate('created_at', $date)->where('status', 'hadir')->count();
            $total = Absence::whereDate('created_at', $date)->count();

            $compliance_data[] = [
                'day' => now()->subDays($i)->format('D'),
                'date' => now()->subDays($i)->format('d M'),
                'rate' => $total > 0 ? round(($hadir / $total) * 100) : 0,
            ];
        }
        $stats['compliance_chart'] = $compliance_data;

        return view('admin.index', compact('users', 'placements', 'stats'));
    }

    public function edit(User $user)
    {
        if (Auth::user()->role === 'jaksa_pengawas' && !$user->assignedJaksa->contains(Auth::id())) {
            abort(403, 'Anda hanya dapat mengelola terpidana yang ditugaskan kepada Anda.');
        }

        $placements = Placement::all();
        $jaksas = User::whereIn('role', ['admin', 'jaksa_pengawas'])->get();
        return view('admin.edit', compact('user', 'placements', 'jaksas'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->role === 'jaksa_pengawas' && !$user->assignedJaksa->contains(Auth::id())) {
            abort(403, 'Anda hanya dapat mengelola terpidana yang ditugaskan kepada Anda.');
        }
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
            'pasal' => 'nullable|string|max:255',
            'sub_pasal' => 'nullable|string|max:255',
            'jenis_tindak_pidana' => 'nullable|string|max:255',
            'sentence' => 'nullable|string|max:255',
            'sentence_hours' => 'nullable|integer|min:0',
            'placement_id' => 'nullable|exists:placements,id',
            'nationality' => 'nullable|string|max:255',
            'marital_status' => 'nullable|in:belum_menikah,menikah,cerai',
            'spouse_name' => 'nullable|string|max:255',
            'dependents_count' => 'nullable|integer|min:0',
            'children_count' => 'nullable|integer|min:0',
            'ktp_address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:50',
            'pks02_prosecutor_name' => 'nullable|string|max:255',
            'pks02_case_number' => 'nullable|string|max:255',
            'pks02_opinion_analysis' => 'nullable|string',
            'pks02_opinion_recommendation' => 'nullable|string',
            'pks02_opinion_conclusion' => 'nullable|string',
            'pks02_background' => 'nullable|array',
            'pks02_family_profile' => 'nullable|array',
            'pks02_environment' => 'nullable|array',
            'pks02_daily_life' => 'nullable|array',
            'pks02_work_capability' => 'nullable|array',
            'pks02_profiling_meta' => 'nullable|array',
        ]);

        $before = $user->getAttributes();
        $user->update($validated);
        $after = $user->getChanges();

        AuditLogService::log('update_user', $user, $before, $after);

        if ($request->has('jaksa_ids')) {
            $user->assignedJaksa()->sync($request->jaksa_ids);
        }

        return redirect()->route('admin.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $before = $user->getAttributes();
        $user->delete();
        AuditLogService::log('delete_user', $user, $before, null);

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }
}
