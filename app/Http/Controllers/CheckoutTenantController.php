<?php

namespace App\Http\Controllers;

use App\Models\CheckoutTenant;
use App\Models\MenuTenant;
use App\Models\AkunTenant;
use App\Http\Requests\StoreCheckoutTenantRequest;
use App\Http\Requests\UpdateCheckoutTenantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CheckoutTenantController extends Controller
{
    public function getCheckoutItems($idPembeli)
    {
        $checkoutItems = CheckoutTenant::where('idPembeli', $idPembeli)->get();

        return response()->json($checkoutItems);
    }

    public function storeCheckoutItem(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'idTenant' => 'required|exists:akun_tenants,id',
            'idMenu' => 'required|exists:menu_tenants,id',
            'quantity' => 'required|integer|min:1',
            'totalHarga' => 'required|integer|min:0',
            'idPembeli' => 'nullable|exists:akun_pembelis,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new CheckoutTenant record
        $checkoutItem = CheckoutTenant::create($request->all());

        return response()->json($checkoutItem, 201);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCheckoutTenantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckoutTenant $checkoutTenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckoutTenant $checkoutTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckoutTenantRequest $request, CheckoutTenant $checkoutTenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckoutTenant $checkoutTenant)
    {
        //
    }
}
