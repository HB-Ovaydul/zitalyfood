<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show Register Page
     */
    public function ShowRegisterPage()
    {
        return view('backend.pages.register-page.register');
    }
    /**
     * Show Login Page
     */
    public function ShowLoginPage()
    {
        return view('backend.pages.login-page.login');
    }

    /**
     *  Admin Penal Register Process in User
     */
    public function AdminLogin(Request $request)
    {
        // Validation
        $this->validate($request,[
            'auth'              => 'required',
            'pass'              => 'required',
        ]);

        // // Admin login process
        if(Auth::guard('admin') -> attempt(['email' => $request -> auth, 'password' => $request -> pass ]) || Auth::guard('admin')->attempt(['cell' => $request -> auth, 'password' => $request -> pass])){
            return redirect()->route('dashboard.index');
        }else{
            return back()->with('danger','Your Emal Or password wrong');
        }
    }
    
    // LogOut Process
    public function AdminLogout()
    {
       Auth::guard('admin')->logout();
       return redirect()->route('admin.login.page');
    }
}
