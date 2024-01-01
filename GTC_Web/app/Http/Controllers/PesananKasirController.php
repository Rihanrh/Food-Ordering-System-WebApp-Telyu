<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuKasir;
use App\Models\PesananTenant;
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
        $pesanan_menunggu = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Menunggu Konfirmasi Pembayaran')
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananMenunggu = $pesanan_menunggu->groupBy('idPesanan');


        $pesanan_diproses = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Dalam Proses')
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananDiproses = $pesanan_diproses->groupBy('idPesanan');

        $pesanan_selesai = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Selesai')
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananSelesai = $pesanan_selesai->groupBy('idPesanan');

        return view('kasirListPesanan', compact('groupedPesananMenunggu', 'groupedPesananDiproses', 'groupedPesananSelesai'));
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
        $id = optional(PesananKasir::orderBy('idPesanan', 'desc')->first())->idPesanan + 1 ?? 1;

        $quantity = array();
        $menus = $request->menu;

        foreach($menus as $menu){
            if(array_key_exists($menu, $quantity)){
                $quantity[$menu] += 1;
            }else{
                $quantity[$menu] = 1;
            }
        }

        foreach($menus as $menu){
            $menu = MenuKasir::where('id', $menu)->first();
            $temp_menu = PesananKasir::where('idMenu', $menu->id)->where('idPesanan', $id)->first();
            if(!$temp_menu){
                PesananKasir::create([
                    'idKasir' => auth()->guard('kasir')->id(),
                    'idMenu' => $menu->id,
                    'idPesanan' => $id,
                    'quantity' => $quantity[$menu->id],
                    'totalHarga' => $quantity[$menu->id] * $menu->hargaProduk,
                    'metodePembayaran' => $request->metode,
                    'statusPesanan' => 'Menunggu Konfirmasi Pembayaran',
                ]);
            }
        }

        return redirect('/pesananKasir')->with('success', 'Pesanan berhasil ditambahkan');
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
        $menu_kasirs = MenuKasir::select('id', 'nama_produk')->get();
        return response()->json($menu_kasirs);
    }

    public function konfirmasiPembayaran(string $id)
    {
        $pesanan = PesananTenant::where('idPesanan', $id)->get();
        foreach($pesanan as $p){
            $p->statusPesanan = 'Pesanan Dalam Proses';
            $p->save();
        }
        return redirect('/pesananTenant')->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    public function pesananSelesai(string $id)
    {
        $pesanan = PesananTenant::where('idPesanan', $id)->get();
        foreach($pesanan as $p){
            $p->statusPesanan = 'Pesanan Selesai';
            $p->save();
        }
        return redirect('/pesananTenant')->with('success', 'Pesanan berhasil dikonfirmasi');
    }
}
