<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $complaints = Complaint::with('user')->latest()->paginate(10);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'name' => 'nullable|string|max:255',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'name' => Auth::check() ? Auth::user()->name : $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'baru',
        ]);

        return redirect()->route('home')->with('success', 'Aduan Anda telah berhasil dikirim dan akan segera diproses.');
    }

    public function update(Request $request, Complaint $complaint)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
            'admin_response' => 'nullable|string',
        ]);

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ]);

        return back()->with('success', 'Status dan respon aduan berhasil diperbarui.');
    }
}
