<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('name')->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Branch::create($validated);

        return back()->with('success', 'Cabang baru berhasil ditambahkan.');
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name,' . $branch->id,
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $branch->update($validated);

        return back()->with('success', 'Data cabang berhasil diperbarui.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return back()->with('success', 'Cabang berhasil dihapus.');
    }
}
