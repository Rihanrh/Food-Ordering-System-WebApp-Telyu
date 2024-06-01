<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuTenant;
use App\Models\PesananTenant;
use App\Http\Requests\StorePesananTenantRequest;
use App\Http\Requests\UpdatePesananTenantRequest;

class PesananTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan_menunggu = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Menunggu Konfirmasi Pembayaran')
            ->where('idTenant', auth()->guard('tenant')->id())
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananMenunggu = $pesanan_menunggu->groupBy('idPesanan');

        $pesanan_diproses = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Dalam Proses')
            ->where('idTenant', auth()->guard('tenant')->id())
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananDiproses = $pesanan_diproses->groupBy('idPesanan');

        $pesanan_selesai = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Selesai')
            ->where('idTenant', auth()->guard('tenant')->id())
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananSelesai = $pesanan_selesai->groupBy('idPesanan');

        return view('tenantListPesanan', compact('groupedPesananMenunggu', 'groupedPesananDiproses', 'groupedPesananSelesai'));
    }

    public function getMaxIdPesanan()
    {
        $maxIdPesanan = PesananTenant::max('idPesanan');

        return response()->json([
            'idPesanan' => $maxIdPesanan,
        ]);
    }

    public function getPesananByIdPembeli($idPembeli)
    {
        // Retrieve pesanan by idPembeli
        $pesanan = PesananTenant::where('idPembeli', $idPembeli)->get();

        // Check if pesanan exists
        if ($pesanan->isEmpty()) {
            return response()->json(['message' => 'Pesanan not found'], 404);
        }

        // Return pesanan as JSON response
        return response()->json($pesanan, 200);
    }

    public function postPesanan(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'idTenant' => 'required|exists:akun_tenants,id',
            'idMenu' => 'required|exists:menu_tenants,id',
            'idPesanan' => 'required|integer',
            'quantity' => 'required|integer',
            'totalHarga' => 'required|integer',
            'metodePembayaran' => 'required|string',
            'statusPesanan' => 'required|string',
            'nomorMeja' => 'required|integer',
            'opsiKonsumsi' => 'required|string',
            'queue' => 'nullable|integer',
            'idPembeli' => 'nullable|exists:akun_pembelis,id',
        ]);

        // Create a new PesananTenant record
        $pesananTenant = PesananTenant::create($validatedData);

        // Return the newly created record as a JSON response
        return response()->json($pesananTenant, 201);
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
        $id = optional(PesananTenant::orderBy('idPesanan', 'desc')->first())->idPesanan + 1 ?? 1;
    
        $quantity = array();
        $menus = $request->menu;
    
        foreach ($menus as $menu) {
            if (array_key_exists($menu, $quantity)) {
                $quantity[$menu] += 1;
            } else {
                $quantity[$menu] = 1;
            }
        }
    
        foreach ($menus as $menuId) {
            $menu = MenuTenant::where('id', $menuId)->first();
            $temp_menu = PesananTenant::where('idMenu', $menu->id)->where('idPesanan', $id)->first();
            if (!$temp_menu) {
                PesananTenant::create([
                    'idTenant' => auth()->guard('tenant')->id(),
                    'idMenu' => $menu->id,
                    'idPesanan' => $id,
                    'quantity' => $quantity[$menu->id],
                    'totalHarga' => $quantity[$menu->id] * $menu->hargaProduk,
                    'metodePembayaran' => $request->metode,
                    'nomorMeja' => $request->nomorMeja,
                    'opsiKonsumsi' => $request->opsiKonsumsi,
                    'statusPesanan' => 'Menunggu Konfirmasi Pembayaran',
                ]);
            }
        }
    
        return redirect('/pesananTenant')->with('success', 'Pesanan berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(PesananTenant $pesananTenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesananTenant $pesananTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePesananTenantRequest $request, PesananTenant $pesananTenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesananTenant $pesananTenant)
    {
        //
    }

    public function getMenu()
    {
        $menu_tenants = MenuTenant::select('id', 'namaProduk')->where('idTenant', auth()->guard('tenant')->id())->get();
        return response()->json($menu_tenants);
    }

    public function konfirmasiPembayaran(string $id)
    {
        // Fetch all orders with the given idPesanan
        $pesanan = PesananTenant::where('idPesanan', $id)->get();
    
        // Get the current maximum queue value
        $maxQueue = PesananTenant::max('queue') ?? 0;
    
        foreach ($pesanan as $p) {
            // Increment the max queue value for each order and set the new queue value
            $p->queue = ++$maxQueue;
            $p->statusPesanan = 'Pesanan Dalam Proses';
            $p->save();
        }
    
        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    public function pesananSelesai(string $id)
    {
        // Fetch all orders with the given idPesanan and order them by queue
        $pesanan = PesananTenant::where('idPesanan', $id)
            ->orderBy('queue')
            ->get();
    
        // Find the index of the first order in the queue
        $firstIndex = $pesanan->search(function ($item) {
            return $item->statusPesanan !== 'Pesanan Selesai';
        });
    
        // If there are no orders in the queue, return
        if ($firstIndex === false) {
            return back()->with('success', 'Pesanan berhasil dikonfirmasi');
        }
    
        // Update the queue values for the remaining orders
        for ($i = $firstIndex + 1; $i < $pesanan->count(); $i++) {
            $pesanan[$i]->queue = $i - $firstIndex;
            $pesanan[$i]->save();
        }
    
        // Mark the first order as complete
        $pesanan[$firstIndex]->statusPesanan = 'Pesanan Selesai';
        $pesanan[$firstIndex]->save();
    
        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }
}
