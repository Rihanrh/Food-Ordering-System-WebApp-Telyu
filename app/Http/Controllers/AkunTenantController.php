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
        // public function getTenantNameById(Request $request, $id)
        // {
        //     $tenantName = AkunTenant::where('id', $id)->pluck('nama_tenant')->first();

        //     if ($tenantName) {
        //         return response()->json($tenantName);
        //     } else {
        //         return response()->json(['error' => 'Tenant not found'], 404);
        //     }
        // }

        public function getAllTenants()
        {
            $tenants = AkunTenant::select('id', 'nama_tenant')->get();
            return response()->json($tenants);
        }

        public function index()
        {
            //
        }

        public function create()
        {
            //
        }

        public function store(StoreTenantRequest $request)
        {
            //
        }

        public function show(AkunTenant $tenant)
        {
            //
        }

        public function edit(AkunTenant $tenant)
        {
            //
        }

        public function update(UpdateTenantRequest $request, AkunTenant $tenant)
        {
            //
        }

        public function destroy(AkunTenant $tenant)
        {
            //
        }

        public function login(Request $request)
        {
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

        public function showMenuTenant()
        {
            return view('tenantMenu');
        }
}
