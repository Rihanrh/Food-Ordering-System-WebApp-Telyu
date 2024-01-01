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
        $pesanan_menunggu = PesananKasir::with('kasir')
            ->select('idPesananKasir', 'idMenu', 'quantity', 'totalHarga', 'idKasir', 'metodePembayaran')
            ->where('statusPesanan', 'Menunggu Konfirmasi Pembayaran')
            ->where('idKasir', auth()->guard('kasir')->id())
            ->orderBy('idPesananKasir')
            ->get();

        $groupedPesananMenunggu = $pesanan_menunggu->groupBy('idPesananKasir');

        $pesanan_diproses = PesananKasir::with('kasir')
            ->select('idPesananKasir', 'idMenu', 'quantity', 'totalHarga', 'idKasir', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Dalam Proses')
            ->where('idKasir', auth()->guard('kasir')->id())
            ->orderBy('idPesananKasir')
            ->get();

        $groupedPesananDiproses = $pesanan_diproses->groupBy('idPesananKasir');

        $pesanan_selesai = PesananKasir::with('kasir')
            ->select('idPesananKasir', 'idMenu', 'quantity', 'totalHarga', 'idKasir', 'metodePembayaran')
            ->where('statusPesanan', 'Pesanan Selesai')
            ->where('idKasir', auth()->guard('kasir')->id())
            ->orderBy('idPesananKasir')
            ->get();

        $groupedPesananSelesai = $pesanan_selesai->groupBy('idPesananKasir');

        $pesanan_tenant_menunggu = PesananTenant::with('tenant')
            ->select('idPesanan', 'idMenu', 'quantity', 'totalHarga', 'idTenant', 'metodePembayaran')
            ->where('statusPesanan', 'Menunggu Konfirmasi Pembayaran')
            ->where('metodePembayaran', 'Tunai')
            ->orderBy('idPesanan')
            ->get();

        $groupedPesananTenantMenunggu = $pesanan_tenant_menunggu->groupBy('idPesanan');

        return view('kasirListPesanan', compact('groupedPesananMenunggu', 'groupedPesananDiproses', 'groupedPesananSelesai', 'groupedPesananTenantMenunggu'));
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
        $id = optional(PesananKasir::orderBy('idPesananKasir', 'desc')->first())->idPesananKasir + 1 ?? 1;

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
            $temp_menu = PesananKasir::where('idMenu', $menu->id)->where('idPesananKasir', $id)->first();
            if(!$temp_menu){
                PesananKasir::create([
                    'idKasir' => auth()->guard('kasir')->id(),
                    'idMenu' => $menu->id,
                    'idPesananKasir' => $id,
                    'quantity' => $quantity[$menu->id],
                    'totalHarga' => $quantity[$menu->id] * $menu->harga_produk,
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

    public function getMenuKasir()
    {
        $menu_kasirs = MenuKasir::select('id', 'nama_produk')->where('idKasir', auth()->guard('kasir')->id())->get();
        return response()->json($menu_kasirs);
    }

    public function konfirmasiPembayaranKasir(string $id)
    {
        $pesanan = PesananKasir::where('idPesananKasir', $id)->get();
        foreach($pesanan as $p){
            $p->statusPesanan = 'Pesanan Dalam Proses';
            $p->save();
        }
        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    public function pesananSelesaiKasir(string $id)
    {
        $pesanan = PesananKasir::where('idPesananKasir', $id)->get();
        foreach($pesanan as $p){
            $p->statusPesanan = 'Pesanan Selesai';
            $p->save();
        }
        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }
}
