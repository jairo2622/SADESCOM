<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cronograma as ModelsCronograma;
use Illuminate\Http\Request;

class Cronograma extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('modules/cronograma/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules/cronograma/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new ModelsCronograma();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->color = $request->color;
        $item->textcolor = $request->textcolor;

        $item->save();
        return to_route('cronograma');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ModelsCronograma::find($id);
        return view('modules/cronograma/edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = ModelsCronograma::find($id);
        $item->title = $request->title;
        $item->description = $request->description;
        $item->start = $request->start;
        $item->end = $request->end;
        $item->color = $request->color;
        $item->textcolor = $request->textcolor;
        $item->save();
        return to_route('cronograma');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ModelsCronograma::find($id);
        $item->delete();
        return to_route('cronograma');
    }
}
