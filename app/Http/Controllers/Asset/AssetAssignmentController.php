<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetAssignmentController extends Controller
{
    public function index()
    {
        // TODO: List asset assignments
        return view('asset.assignments.index');
    }

    public function store(Request $request)
    {
        // TODO: Assign asset to user
    }

    public function returnAsset($id)
    {
        // TODO: Mark asset as returned
    }
}
