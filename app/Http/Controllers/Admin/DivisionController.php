<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.divisions.index', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Division::create($validated);

        return back()->with('success', 'Divisi baru berhasil ditambahkan.');
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $division->id,
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $division->update($validated);

        return back()->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function destroy(Division $division)
    {
        $division->delete();

        return back()->with('success', 'Divisi berhasil dihapus.');
    }
}
