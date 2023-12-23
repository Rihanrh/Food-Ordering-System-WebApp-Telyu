<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view("tenantMenu", ['menu'=>$menus ]);

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
        $menu = new Menu();
        $menu->fotoProduk = pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '.' . pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION);
        $menu->namaProduk = $data['tambahNamaProduk'];
        $menu->hargaProduk = $data['tambahHargaProduk'];
        $menu->stokProduk = $data['tambahStokProduk'];

        $request->tambahFotoProduk->move(public_path('file'), $request->tambahFotoProduk->getClientOriginalName());

        $menu->save();
        return redirect('/menu')->with('success','Menu Telah Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $menu = Menu::where('id', $menu->id)->first();

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
    public function edit(Menu $menu)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $menus = Menu::where('id', $menu->id)->first();

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
        return redirect('/menu')->with('success','Menu Telah Disunting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menus = Menu::where('id', $menu->id)->first();
        $file = public_path('file/' . $menus->fotoProduk);
        File::delete($file);
        Menu::destroy($menu->id);
        
        return redirect('/menu')->with('success','Hapus berhasil');
    }
}
