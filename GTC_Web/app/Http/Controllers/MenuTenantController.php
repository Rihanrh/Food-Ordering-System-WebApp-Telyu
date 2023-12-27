<?php

namespace App\Http\Controllers;

use App\Models\MenuTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = MenuTenant::where('idTenant', auth()->guard('tenant')->id())->get();
        return view("tenantMenu", ['menus'=>$menus]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
        $menu = new MenuTenant();
        $menu->namaProduk = $data['tambahNamaProduk'];
        $menu->fotoProduk = pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $menu->namaProduk . '.' . pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION);
        $menu->hargaProduk = $data['tambahHargaProduk'];
        $menu->stokProduk = $data['tambahStokProduk'];
        $menu->idTenant = auth()->guard('tenant')->id();

        $request->tambahFotoProduk->move(public_path('file'), $menu->fotoProduk);
        // $request->tambahFotoProduk->getClientOriginalName()

        $menu->save();
        return redirect('/menuTenant')->with('success','Menu Telah Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(MenuTenant $menu, string $id)
    {
        $menu = MenuTenant::where('id', $id)->first();

        if ($menu){
            return response()->json([
                'namaproduk'=>$menu->namaProduk,
                'hargaproduk'=>$menu ->hargaProduk,
                'stokproduk'=>$menu ->stokProduk,
            ]) ;

        }

        return response()->json(['error'=> 'Data Not Found'] ,404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuTenant $menu)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menus = MenuTenant::where('id', $id)->first();

        $data = $request->validate([
            'suntingFotoProduk'=> 'mimes:jpg,jpeg,png|max:5000',
            'suntingNamaProduk'=>'required',
            'suntingHargaProduk'=> 'required|numeric',
            'suntingStokProduk'=> 'required|numeric',

        ]);

        $file = public_path('file/' . $menus->fotoProduk);

        $menus->namaProduk = $data['suntingNamaProduk'];
        $menus->hargaProduk = $data['suntingHargaProduk'];
        $menus->stokProduk = $data['suntingStokProduk'];
        $menus->fotoProduk = isset($data['suntingFotoProduk']) ? pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '.' . pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION) : $menus->fotoProduk;

        if($request->file('suntingFotoProduk')){
            File::delete($file);
            $request->suntingFotoProduk->move(public_path('file'), $request->suntingFotoProduk->getClientOriginalName());
        }

        $menus->save();
        return redirect('/menuTenant')->with('success','Menu Telah Disunting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menus = MenuTenant::where('id', $id)->first();
        $file = public_path('file/' . $menus->fotoProduk);
        File::delete($file);
        MenuTenant::destroy($id);
        
        return redirect('/menuTenant')->with('success','Hapus berhasil');
    }
}
