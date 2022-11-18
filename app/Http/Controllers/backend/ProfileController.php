<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     *  Viwe Profile Page
     */
    public function ShowProfilePage()
    {
       return view('backend.pages.adminoption.profile.profiles');
    }

    /**
     *  Viwe Profile Page
     */
    public function ChangePassword(Request $request)
    {
      // Check old Password
      if(!password_verify($request -> old_pass, Auth::guard('admin')->user()->password)){
            return back()->with('danger', 'Your Password Not Match');
      }
      // Cheke Confirm Password
      if($request -> pass != $request -> pass_confirmation){
            return back()-> with('warning', 'Please Check Your Confirm Pssword');
      }

        $update_pass = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $update_pass -> update([
            'password' => Hash::make($request -> pass),
        ]);
            Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page')->with('success', 'Your Password Cheanged!');

    }

         /**
     *  Profile Data edeit 
     */
    public function UserDataEdit(Request $request)
    {
        $file_id = Admin::findOrFail(Auth::guard('admin')->user()->id);
        // Photo Update
        if($request->hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $img_inter = Image::make($img->getRealPath());
            $img_inter -> save(storage_path('app/public/admin/'. $file_name));
            unlink('storage/admin/'.$file_id -> photo);
        }else{
            $file_name = $file_id -> photo;
        }
        // Data Update
        $edit = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $edit -> update([
            'name'      => $request -> name,
            'username'  => $request -> username,
            'adderss'   => $request -> address,
            'dob'       => $request -> dath_of_birth,
            'bio'       => $request -> about,
            'location'  => $request -> city,
            'photo'     => $file_name,
        ]);

        return back()->with('success', 'Profile Update Successful');

    }

   
}
