<?php

namespace App\Http\Controllers\UserGuide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideCategoryController extends Controller
{
    public function index()
    {
        // TODO: List guide categories
        return view('userguide.categories.index');
    }

    public function store(Request $request)
    {
        // TODO: Store new guide category
    }

    public function update(Request $request, $id)
    {
        // TODO: Update guide category
    }

    public function destroy($id)
    {
        // TODO: Delete guide category
    }
}
