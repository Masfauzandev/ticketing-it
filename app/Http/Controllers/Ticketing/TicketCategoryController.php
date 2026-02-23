<?php

namespace App\Http\Controllers\Ticketing;

use App\Http\Controllers\Controller;
use App\Models\Ticketing\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::withCount('tickets')->get();
        return view('ticketing.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ticket_categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        TicketCategory::create($validated);

        return redirect()->route('ticketing.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, TicketCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ticket_categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()->route('ticketing.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(TicketCategory $category)
    {
        if ($category->tickets()->count() > 0) {
            return redirect()->route('ticketing.categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki tiket.');
        }

        $category->delete();

        return redirect()->route('ticketing.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
