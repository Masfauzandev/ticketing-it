<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        // TODO: List all IT assets
        return view('asset.index');
    }

    public function create()
    {
        return view('asset.create');
    }

    public function store(Request $request)
    {
        // TODO: Store new asset
    }

    public function show($id)
    {
        // TODO: Show asset detail
        return view('asset.show');
    }

    public function edit($id)
    {
        // TODO: Edit asset form
        return view('asset.edit');
    }

    public function update(Request $request, $id)
    {
        // TODO: Update asset
    }

    public function destroy($id)
    {
        // TODO: Delete/dispose asset
    }
}
