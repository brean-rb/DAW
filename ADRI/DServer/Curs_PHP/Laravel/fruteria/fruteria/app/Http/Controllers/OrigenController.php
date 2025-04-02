<?php

namespace App\Http\Controllers;

use App\Models\Origen;
use Illuminate\Http\Request;

class OrigenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $origenes = Origen::all();
        return view('origenes.index', compact('origenes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Origen $origen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Origen $origen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Origen $origen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Origen $origen)
    {
        //
    }
}
