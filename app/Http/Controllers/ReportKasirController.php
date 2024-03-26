<?php

namespace App\Http\Controllers;

use App\Models\ReportKasir;
use App\Models\PesananKasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ReportKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $reportData = PesananKasir::where('statusPesanan', 'Pesanan Selesai')
    //         ->groupBy('idPesananKasir', 'metodePembayaran')
    //         ->select('idPesananKasir', 'metodePembayaran', \DB::raw('SUM(totalHarga) as totalHarga'), \DB::raw('MAX(created_at) as waktuPenjualan'))
    //         ->get();

    //     return view('reportKasir', ['reportData' => $reportData]);
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PesananKasir::select('idPesananKasir', DB::raw('SUM(totalHarga) as totalHarga'), 'metodePembayaran')
                ->where('statusPesanan', 'Pesanan Selesai')
                ->groupBy('idPesananKasir', 'metodePembayaran');

            if ($request->filled('startDate') && $request->filled('endDate')) {
                $data = $data->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }

            $result = DataTables::of($data)
                ->addColumn('waktuPenjualan', function ($row) {
                    // Retrieve the first created_at within the grouped records
                    return PesananKasir::where('idPesananKasir', $row->idPesananKasir)
                        ->orderBy('created_at', 'asc')
                        ->value('created_at')
                        ->format('Y-m-d H:i:s');
                })
                ->addIndexColumn()
                ->make(true);

            return $result;
        }

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
