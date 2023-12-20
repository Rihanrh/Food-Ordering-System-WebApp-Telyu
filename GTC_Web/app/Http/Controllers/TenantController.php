<?php

    namespace App\Http\Controllers;

    use App\Models\Tenant;
    use App\Http\Requests\StoreTenantRequest;
    use App\Http\Requests\UpdateTenantRequest;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;

    class TenantController extends Controller
    {
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
        public function store(StoreTenantRequest $request)
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(Tenant $tenant)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Tenant $tenant)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateTenantRequest $request, Tenant $tenant)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Tenant $tenant)
        {
            //
        }

        public function login(Request $request)
        {
            $request->validate([
                'username_tenant' => 'required',
                'password_tenant' => 'required|string',
            ]);

            $tenant = Tenant::where('username_tenant', $request->username_tenant)->first();

            if (!$tenant || !Hash::check($request->password, $tenant->password)) {
                return redirect()->route('tenant.login')->with('error', 'Invalid credentials');
            }

            $token = $tenant->createToken('authToken')->plainTextToken;

            return redirect()->route('tenant.listPesanan');
        }
        public function showLoginForm()
        {
            return view('login_tenant');
        }
        public function showTenantListPesanan()
        {
            return view('tenantListPesanan');
        }
}
