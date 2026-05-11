<?php

namespace App\Http\Controllers;

use App\Mail\ComplaintStatusUpdated;
use App\Mail\NewComplaintNotification;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'email' => 'nullable|email|max:255',
        ]);

        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'name' => Auth::check() ? Auth::user()->name : $request->name,
            'email' => Auth::check() ? Auth::user()->email : $request->email,
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'baru',
        ]);

        // Notify Jaksas
        if ($complaint->user) {
            foreach ($complaint->user->assignedJaksa as $jaksa) {
                if ($jaksa->email) {
                    Mail::to($jaksa->email)->send(new NewComplaintNotification($complaint));
                }
            }
        }

        return redirect()->route('home')->with('complaint_success', 'Kami telah menerima aduan Anda. Laporan ini akan segera diproses oleh tim pengawas secara rahasia dan independen.');
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

        if ($complaint->email) {
            try {
                Mail::to($complaint->email)->send(new ComplaintStatusUpdated($complaint));
            } catch (\Exception $e) {
                // Log error or ignore if mail fails in dev
            }
        }

        return back()->with('success', 'Status dan respon aduan berhasil diperbarui'.($complaint->email ? ' dan notifikasi telah dikirim.' : '.'));
    }
}
