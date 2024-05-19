<?php

namespace App\Http\Controllers;

use App\Models\MenuTenant;
use App\Models\AkunTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuTenantController extends Controller
{
    public function getMenuByTenant(int $tenantId)
    {
        // Find tenant by ID from akun_tenants table
        $tenant = AkunTenant::find($tenantId);

        if (!$tenant) {
            return response()->json(['message' => 'Tenant not found'], 404);
        }

        // Fetch menus associated with the found tenant using eager loading
        $menus = $tenant->menuTenants()->get(); // Assuming the relation is named 'menuTenants'

        if ($menus->isEmpty()) {
            return response()->json(['message' => 'No menus found for this tenant'], 404);
        }

        return response()->json($menus);
    }

    public function getMenuById(int $idTenant, int $id)
    {
        // Find menu by tenant ID and menu ID
        $menu = MenuTenant::where('idTenant', $idTenant)
                    ->where('id', $id)
                    ->first();

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        return response()->json($menu);
    }

    public function index()
    {
        $menus = MenuTenant::where('idTenant', auth()->guard('tenant')->id())->get();
        return view("tenantMenu", ['menus'=>$menus]);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tambahFotoProduk'=> 'mimes:jpg,jpeg,png|max:5000',
            'tambahNamaProduk'=>'required',
            'tambahHargaProduk'=> 'required|numeric',
        ]);
        $menu = new MenuTenant();
        $menu->namaProduk = $data['tambahNamaProduk'];
        $menu->fotoProduk = pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '-' . $menu->namaProduk . '.' . pathinfo($data['tambahFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION);
        $menu->hargaProduk = $data['tambahHargaProduk'];
        $menu->idTenant = auth()->guard('tenant')->id();

        $request->tambahFotoProduk->move(public_path('file'), $menu->fotoProduk);

        $menu->save();
        return redirect('/menuTenant')->with('success','Menu Telah Ditambahkan');

    }

    public function show(MenuTenant $menu, string $id)
    {
        $menu = MenuTenant::where('id', $id)->first();

        if ($menu){
            return response()->json([
                'namaproduk'=>$menu->namaProduk,
                'hargaproduk'=>$menu ->hargaProduk,
            ]) ;

        }

        return response()->json(['error'=> 'Data Not Found'] ,404);
    }

    public function edit(MenuTenant $menu)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $menus = MenuTenant::where('id', $id)->first();

        $data = $request->validate([
            'suntingFotoProduk'=> 'mimes:jpg,jpeg,png|max:5000',
            'suntingNamaProduk'=>'required',
            'suntingHargaProduk'=> 'required|numeric',
        ]);

        $file = public_path('file/' . $menus->fotoProduk);

        $menus->namaProduk = $data['suntingNamaProduk'];
        $menus->hargaProduk = $data['suntingHargaProduk'];
        $menus->fotoProduk = isset($data['suntingFotoProduk']) ? pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_FILENAME) . '.' . pathinfo($data['suntingFotoProduk']->getClientOriginalName(), PATHINFO_EXTENSION) : $menus->fotoProduk;

        if($request->file('suntingFotoProduk')){
            File::delete($file);
            $request->suntingFotoProduk->move(public_path('file'), $request->suntingFotoProduk->getClientOriginalName());
        }

        $menus->save();
        return redirect('/menuTenant')->with('success','Menu Telah Disunting');
    }

    public function destroy(string $id)
    {
        $menus = MenuTenant::where('id', $id)->first();
        $file = public_path('file/' . $menus->fotoProduk);
        File::delete($file);
        MenuTenant::destroy($id);
        
        return redirect('/menuTenant')->with('success','Hapus berhasil');
    }
}
