<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupervisorComplaint;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorComplaintController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $complaints = SupervisorComplaint::with('pidana')->latest()->get();

        return view('admin.supervisor-complaints.index', compact('complaints'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $pidanas = User::where('role', 'pidana')->get();

        return view('admin.supervisor-complaints.create', compact('pidanas'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'supervisor_name' => 'required|string|max:255',
            'pidana_id' => 'required|exists:users,id',
            'compliance_notes' => 'required|string',
        ]);

        SupervisorComplaint::create($validated);

        return redirect()->route('admin.supervisor-complaints.index')->with('success', 'Catatan aduan pembimbing berhasil ditambahkan.');
    }

    public function destroy(SupervisorComplaint $supervisorComplaint)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $supervisorComplaint->delete();

        return redirect()->route('admin.supervisor-complaints.index')->with('success', 'Catatan aduan pembimbing berhasil dihapus.');
    }
}
