<?php

namespace App\Http\Controllers\UserGuide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        // TODO: List published guides
        return view('userguide.index');
    }

    public function create()
    {
        return view('userguide.create');
    }

    public function store(Request $request)
    {
        // TODO: Store new guide
    }

    public function show($slug)
    {
        // TODO: Show guide detail, increment view count
        return view('userguide.show');
    }

    public function edit($id)
    {
        return view('userguide.edit');
    }

    public function update(Request $request, $id)
    {
        // TODO: Update guide
    }

    public function destroy($id)
    {
        // TODO: Delete guide
    }
}
