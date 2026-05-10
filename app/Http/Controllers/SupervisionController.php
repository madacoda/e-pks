<?php

namespace App\Http\Controllers;

use App\Models\Pks03Supervision;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisionController extends Controller
{
    public function index(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $supervisions = $user->supervisions()->latest()->get();

        return view('admin.supervisions.index', compact('user', 'supervisions'));
    }

    public function store(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'supervision_date' => 'required|date',
            'supervision_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'behavior_status' => 'nullable|string|max:255',
            'compliance_status' => 'nullable|string|max:255',
        ]);

        $user->supervisions()->create($request->all());

        return back()->with('success', 'Catatan pengawasan PKS-03 berhasil ditambahkan.');
    }

    public function update(Request $request, Pks03Supervision $supervision)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'supervision_date' => 'required|date',
            'supervision_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'behavior_status' => 'nullable|string|max:255',
            'compliance_status' => 'nullable|string|max:255',
        ]);

        $supervision->update($request->all());

        return back()->with('success', 'Catatan pengawasan berhasil diperbarui.');
    }

    public function destroy(Pks03Supervision $supervision)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $supervision->delete();

        return back()->with('success', 'Catatan pengawasan berhasil dihapus.');
    }
}
