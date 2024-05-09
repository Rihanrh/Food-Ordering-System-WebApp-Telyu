<?php

    namespace App\Http\Controllers;

    use App\Models\AkunPembeli;
    use App\Http\Requests\StoreAkunPembeliRequest;
    use App\Http\Requests\UpdateAkunPembeliRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;

class AkunPembeliController extends Controller
{
    public function getPembeli($deviceId)
    {
        $pembeli = AkunPembeli::where('device_id', $deviceId)->first();

        if ($pembeli) {
            return response()->json($pembeli);
        } else {
            // Return a more descriptive response or handle the case where no record is found
            return response()->json(['message' => 'Pembeli not found'], 404);
        }
    }

    public function createPembeli(Request $request)
    {
        $validatedData = $request->validate([
            'device_id' => 'required|string|unique:akun_pembelis',
        ]);

        $pembeli = AkunPembeli::create($validatedData);

        return response()->json($pembeli, 201);
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
    public function store(StoreAkunPembeliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AkunPembeli $akunPembeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AkunPembeli $akunPembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAkunPembeliRequest $request, AkunPembeli $akunPembeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AkunPembeli $akunPembeli)
    {
        //
    }
}
