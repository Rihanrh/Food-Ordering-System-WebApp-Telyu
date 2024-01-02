<?php

namespace App\Http\Controllers;

use App\Models\ReportTenant;
use App\Http\Requests\StoreReportTenantRequest;
use App\Http\Requests\UpdateReportTenantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PesananTenant;
use DataTables;

class ReportTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PesananTenant::select('idPesanan', 'idTenant', 'metodePembayaran', DB::raw('SUM(totalHarga) as totalHarga'))
                ->where('statusPesanan', 'Pesanan Selesai')
                ->when($request->filled('idTenant'), function ($query) use ($request) {
                    // Filter by idTenant if provided in the request
                    return $query->where('idTenant', $request->idTenant);
                })
                ->groupBy('idPesanan', 'idTenant', 'metodePembayaran');

            if ($request->filled('startDate') && $request->filled('endDate')) {
                $data = $data->whereBetween('created_at', [$request->startDate, $request->endDate]);
            }

            $result = DataTables::of($data)
                ->addColumn('waktuPenjualan', function ($row) {
                    // Retrieve the first created_at within the grouped records
                    return PesananTenant::where('idPesanan', $row->idPesanan)
                        ->orderBy('created_at', 'asc')
                        ->value('created_at')
                        ->format('Y-m-d H:i:s');
                })
                ->addIndexColumn()
                ->make(true);

            return $result;
        }

        return view('reportTenant');
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
    public function store(StoreReportTenantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportTenant $reportTenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportTenant $reportTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportTenantRequest $request, ReportTenant $reportTenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportTenant $reportTenant)
    {
        //
    }
}
