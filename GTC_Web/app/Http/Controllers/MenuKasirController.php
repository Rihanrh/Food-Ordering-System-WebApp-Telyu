<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\MenuKasir;
use Illuminate\Support\Facades\File;

class MenuKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kasirs = MenuKasir::where('idKasir', auth()->guard('kasir')->id())->orderBy('id','asc')->paginate(2);
        // $kasirs = Kasir::paginate(2);
        return view("menu", ['kasirs'=>$kasirs]);
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
        $data = $request->validate([
            'tambahFotoProduk'=> 'mimes:jpg,jpeg,png|max:5000',
            'tambahNamaProduk'=>'required',
            'tambahHargaProduk'=> 'required|numeric',
            'tambahStokProduk'=> 'required|numeric',
        ]);
        $kasir = new MenuKasir();
        $kasir->nama_produk = $data['tambahNamaProduk'];
        $kasir->foto = pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $kasir->nama_produk . '.' . pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION);
        $kasir->harga_produk = $data['tambahHargaProduk'];
        $kasir->stok_produk = $data['tambahStokProduk'];
        $kasir->idKasir = auth()->guard('kasir')->id();

        $request->tambahFotoProduk->move(public_path('file'), $kasir->foto);
        $kasir->save();
        return redirect('/menuKasir')->with('success','Produk Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     */

    public function show(MenuKasir $kasir)
    {
        $kasir = MenuKasir::where('id', $kasir->id)->first();

        if($kasir){
            return response()->json([
                'namaproduk'=>$kasir->nama_produk,
                'hargaproduk'=>$kasir->harga_produk,
                'stokproduk'=>$kasir->stok_produk
            ]) ;
        }

        return response()->json(['error'=> 'Data Not Found'] ,404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $kasirs = MenuKasir::where('id', $id)->first();

        $data = $request->validate([
            'suntingFotoProduk'=> 'mimes:jpg,jpeg,png|max:5000',
            'suntingNamaProduk'=>'required',
            'suntingHargaProduk'=> 'required|numeric',
            'suntingStokProduk'=> 'required|numeric',
        ]);

        $file = public_path('file/'.$kasirs->foto);
        $kasirs->nama_produk = $data['suntingNamaProduk'];
        $kasirs->harga_produk = $data['suntingHargaProduk'];
        $kasirs->stok_produk = $data['suntingStokProduk'];
        $kasirs->foto = isset($data['suntingFotoProduk']) ? pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '.' . pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION) : $kasirs->foto;
    
        if($request->file('suntingFotoProduk')){
            File::delete($file);
            $request->suntingFotoProduk->move(public_path('file'), $request->suntingFotoProduk->getClientOriginalName());
        }

        $kasirs->save();
        return redirect('/menuKasir')->with('success','Menu Telah Disunting');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $kasirs = MenuKasir::where('id', $id)->first();
        $file = public_path('file/'.$kasirs->foto);
        File::delete($file);
        MenuKasir::destroy($id);

        return redirect('/menuKasir')->with('success','Hapus berhasil');
    }
}
