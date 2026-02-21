<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index()
    {
        // TODO: List asset categories
        return view('asset.categories.index');
    }

    public function store(Request $request)
    {
        // TODO: Store new asset category
    }

    public function update(Request $request, $id)
    {
        // TODO: Update asset category
    }

    public function destroy($id)
    {
        // TODO: Delete asset category
    }
}
