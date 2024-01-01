<?php

    namespace App\Http\Controllers;

    use App\Models\AkunTenant;
    use App\Http\Requests\StoreTenantRequest;
    use App\Http\Requests\UpdateTenantRequest;
  
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;

    class AkunTenantController extends Controller
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
        public function show(AkunTenant $tenant)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(AkunTenant $tenant)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateTenantRequest $request, AkunTenant $tenant)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(AkunTenant $tenant)
        {
            //
        }

        public function login(Request $request)
        {
            // $request->validate([
            //     'username_tenant' => 'required',
            //     'password_tenant' => 'required|string',
            // ], [
            //     'username_tenant.required' => 'Silahkan mengisi username terlebih dahulu',
            //     'password_tenant.required' => 'Silahkan mengisi password terlebih dahulu',    
            // ]
            // );

            // $tenant = AkunTenant::where('username_tenant', $request->username_tenant)->first();

            // if (!$tenant || !Hash::check($request->password_tenant, $tenant->password_tenant)) {
            //     return back()->with('error', 'Username or password invalid');
            // }
            
            // $request->session()->regenerate();
            // //return redirect()->route('tenantMenu');
            // return redirect('/menuTenant')->with('Success','Login Berhasil');
            $credentials = $request->validate([
                'username_tenant' => 'required',
                'password_tenant' => 'required',
            ]);

            if (Auth::guard('tenant')->attempt(
                ['username_tenant' => $credentials['username_tenant'], 'password' => $credentials['password_tenant']]
            )) {
                $request->session()->regenerate();
        
                return redirect()->intended('/menuTenant');  
            }      
    
            return back()->with('error', 'Invalid username or password');
        }

        public function logout(Request $request)
        {
            Auth::guard('tenant')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        }

        public function showLoginForm()
        {
            return view('login_tenant');
        }
        // public function showTenantListPesanan()
        // {
        //     return view('tenantListPesanan');
        // }

        public function showMenuTenant()
        {
            return view('tenantMenu');
        }
}
