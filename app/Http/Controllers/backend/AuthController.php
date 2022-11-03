<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ForgetPassword;
use Illuminate\Auth\Events\Validated;
use Monolog\Handler\ElasticaHandler;
use Symfony\Component\HttpFoundation\RequestStack;

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

    /**
     * Forgot password
     * */
    public function ForgotPassword()
    {
        return view('backend.pages.forgotpassword.index');
    }

    // Check Email
    public function ForgotEmailVary(Request $request)
    {
        // Validation
        $this->validate($request,[
            'email' => 'required|email|exists:admins,email',
        ]);

        // Create Tokent
        $token = md5(time().rand());
       $forget = Token::create([
            'email'   => $request -> email,
            'access_token'  => $token,
        ]);

        $forget -> notify( new ForgetPassword($forget) );
        return back();

    }

    /**
     * Password Change Page 
     */

     public function ForgotViwePage(Request $request, $email, $token)
     {
         return view('backend.pages.forgotpassword.change_password')->with(['email' => $request -> email, 'access_token' => $token]);
     }
     /**
      * Change Password
      */

      public function ChangePassword(Request $request)
      {
        // Validation
        $this->validate($request,[
            'email'         => 'required|email|exists:admins,email',
            'pass'   => 'required',
        ]);

        // Try To Change Password
       $reset = Token::where(['email' => $request -> email, 'access_token' => $request -> token])->first();

       // Check password
       if(!$reset){
            return back()->with('danger', 'Email Not Match');
       }else{
            Admin::where('email', $request -> email) ->update([
                'password' => Hash::make($request -> pass),
            ]);

        }
        return redirect()->route('admin.login.page')->with('success', 'Password Changed Successful');

        
      }

}
