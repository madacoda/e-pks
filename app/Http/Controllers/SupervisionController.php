<?php

namespace App\Http\Controllers;

use App\Models\Pks03Supervision;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisionController extends Controller
{
    public function index(User $user)
    {
        if (!in_array(auth()->user()->role, ['admin', 'jaksa_pengawas'])) {
            abort(403);
        }

        if (auth()->user()->role === 'jaksa_pengawas' && !$user->assignedJaksa->contains(auth()->id())) {
            abort(403, 'Anda tidak ditugaskan untuk mengawasi terpidana ini.');
        }

        $supervisions = $user->supervisions()->latest()->get();

        return view('admin.supervisions.index', compact('user', 'supervisions'));
    }

    public function store(Request $request, User $user)
    {
        if (!in_array(auth()->user()->role, ['admin', 'jaksa_pengawas'])) {
            abort(403);
        }

        if (auth()->user()->role === 'jaksa_pengawas' && !$user->assignedJaksa->contains(auth()->id())) {
            abort(403, 'Anda tidak ditugaskan untuk mengawasi terpidana ini.');
        }

        $request->validate([
            'supervision_date' => 'required|date',
            'supervision_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'behavior_status' => 'nullable|string|max:255',
            'compliance_status' => 'nullable|string|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
        ]);

        $user->supervisions()->create($request->all());

        return back()->with('success', 'Catatan pengawasan PKS-03 berhasil ditambahkan.');
    }

    public function update(Request $request, Pks03Supervision $supervision)
    {
        if (!in_array(auth()->user()->role, ['admin', 'jaksa_pengawas'])) {
            abort(403);
        }

        if (auth()->user()->role === 'jaksa_pengawas' && !$supervision->user->assignedJaksa->contains(auth()->id())) {
            abort(403, 'Anda tidak ditugaskan untuk mengawasi terpidana ini.');
        }

        $request->validate([
            'supervision_date' => 'required|date',
            'supervision_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'behavior_status' => 'nullable|string|max:255',
            'compliance_status' => 'nullable|string|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
        ]);

        $supervision->update($request->all());

        return back()->with('success', 'Catatan pengawasan berhasil diperbarui.');
    }

    public function destroy(Pks03Supervision $supervision)
    {
        if (!in_array(auth()->user()->role, ['admin', 'jaksa_pengawas'])) {
            abort(403);
        }

        if (auth()->user()->role === 'jaksa_pengawas' && !$supervision->user->assignedJaksa->contains(auth()->id())) {
            abort(403, 'Anda tidak ditugaskan untuk mengawasi terpidana ini.');
        }

        $supervision->delete();

        return back()->with('success', 'Catatan pengawasan berhasil dihapus.');
    }
}
