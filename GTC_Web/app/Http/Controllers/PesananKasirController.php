<?php

namespace App\Http\Controllers;

use App\Models\PesananKasir;
use App\Http\Requests\StorePesananKasirRequest;
use App\Http\Requests\UpdatePesananKasirRequest;

class PesananKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan_kasirs = PesananKasir::all();
        return view('Confirm', compact('pesanan_kasirs'));
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
    public function store(StorePesananKasirRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PesananKasir $pesananKasir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesananKasir $pesananKasir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePesananKasirRequest $request, PesananKasir $pesananKasir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesananKasir $pesananKasir)
    {
        //
    }
}
