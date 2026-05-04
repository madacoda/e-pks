<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

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
        $query = User::with('placement');

        if ($request->filled('placement_id')) {
            $query->where('placement_id', $request->placement_id);
        }

        $users = $query->get();
        $placements = \App\Models\Placement::all();
        return view('admin.index', compact('users', 'placements'));
    }

    public function edit(User $user)
    {
        $placements = \App\Models\Placement::all();
        return view('admin.edit', compact('user', 'placements'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,pidana',
            'date_of_birth' => 'nullable|date',
            'crime' => 'nullable|string|max:255',
            'sentence' => 'nullable|string|max:255',
            'placement' => 'nullable|string|max:255',
        ]);

        $user->update($request->all());

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
