<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Notifications\TakePassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthConroller extends Controller
{
    
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $admins = Admin::latest()->where('trash', false)->get();
       $role_id = Role::latest()->where('trash', false)->get();
        return view('backend.pages.adminoption.user.index',[
            'form_type' => 'create',
            'admins'     => $admins,
            'role_id'     => $role_id,
        ]);
    }

    /**
     * Role Trash Page
     */
    public function UserTrashPage()
    {
        $all_trash = Admin::latest()->get()->where('trash', true);
        return view('backend.pages.adminoption.user.trash',[
            'all_trash'  => $all_trash,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request,[
            'name'  => 'required|unique:admins',
            'username'  => 'required|unique:admins',
            'email'  => 'required|email|unique:admins',
            'phone'  => 'required|unique:admins',
        ]);

        // password Generate

        $pass_make = str_shuffle('ad1234567890asdfghj?><klzxcvbnm,./;-)(**&&*^%$#@!~`');

        $pass = substr($pass_make, 10,6);

        // Data Store
       $admin = Admin::create([
            'name'          => $request -> name,
            'username'      => $request -> username,
            'email'         => $request -> email,
            'cell'          => $request -> phone,
            'password'      => Hash::make($pass),
            'role_id'       => $request -> role_id,
        ]);

        $admin -> notify(new TakePassword([$admin['name'], $pass]));
        
        return back()->with('success', 'Accout Create Successful!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::latest()->where('trash', false)->get();
        $role_id = Role::latest()->get();
        $edit_user = Admin::findOrFail($id);
         return view('backend.pages.adminoption.user.index',[
             'form_type' => 'edit',
             'admins'     => $admins,
             'role_id'     => $role_id,
             'edit_user'    => $edit_user,
         ]);
    }

    /**
     *  User Status Update
     */
    public function UserStatusUpdate($id)
    {
       $status = Admin::findOrFail($id);
       if($status -> status ){
        $status -> update([
            'status'  => false,
        ]);
        return back()->with('danger-table', 'User Blocked');
       }else{
        $status -> update([
            'status'  => true,
        ]);
        return back()->with('success-table', 'User Active');
       }
    }

    /**
     *  Role Trash Update
     */
    public function UserTrashUpdate($id)
    {
        $trash_update = Admin::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash' => false,
                'status' => true,
            ]);
            return back()->with('success-table', 'Permission Restored!');
        }else{
            $trash_update -> update([
                'trash' => true,
                'status' => false,
            ]);
            return back()->with('danger-table', 'Permission Move To Trash');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $delete =  Admin::findOrFail($id);
       $delete -> delete();
       return back()->with('success-table', 'Data Deleted Successful');
}
}