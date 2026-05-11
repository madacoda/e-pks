<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Placement;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class PlacementController extends Controller implements HasMiddleware
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
    public function index()
    {
        $placements = Placement::withCount('users')->get();
        return view('admin.placements.index', compact('placements'));
    }

    public function create()
    {
        return view('admin.placements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'pic_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        Placement::create($validated);

        return redirect()->route('admin.placements.index')->with('success', 'Satker berhasil ditambahkan.');
    }

    public function edit(Placement $placement)
    {
        return view('admin.placements.edit', compact('placement'));
    }

    public function update(Request $request, Placement $placement)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'pic_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $placement->update($validated);

        return redirect()->route('admin.placements.index')->with('success', 'Data Satker berhasil diperbarui.');
    }

    public function destroy(Placement $placement)
    {
        if ($placement->users()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus Satker yang masih memiliki terpidana terdaftar.');
        }

        $placement->delete();

        return redirect()->route('admin.placements.index')->with('success', 'Satker berhasil dihapus.');
    }
}
