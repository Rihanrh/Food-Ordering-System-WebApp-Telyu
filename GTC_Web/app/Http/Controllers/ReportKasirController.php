<?php

namespace App\Http\Controllers;

use App\Models\ReportKasir;
use Illuminate\Http\Request;

class ReportKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reportKasir');
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
    public function show(ReportKasir $reportKasir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportKasir $reportKasir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportKasir $reportKasir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportKasir $reportKasir)
    {
        //
    }
}
