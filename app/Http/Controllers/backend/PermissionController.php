<?php

namespace App\Http\Controllers\backend;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_permission = Permission::latest()->get()->where('trash', false);
        $role = Role::latest()->get()->where('trash', false);
        return view('backend.pages.adminoption.permission.index',[
            'form_type' => 'create',
            'all_permission'  => $all_permission,
            'role'  => $role,
        ]);
    }

    /**
     * Permission Trash Page
     */
    public function PermissionTrashPage()
    {
        $all_trash = Permission::latest()->get()->where('trash', true);
        return view('backend.pages.adminoption.permission.trash',[
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
            'name'  => 'required',
        ]);

        // Data Store
        Permission::create([
            'pname'     => $request -> name,
            'slug'     => Str::slug($request -> name),
        ]);

        // Return Back
        return back()->with('success','Permission Added Successful!');
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
        $all_permission = Permission::latest()->get()->where('trash', false);
        $edit_permission = Permission::findorFail($id);
        return view('backend.pages.adminoption.permission.index',[
            'form_type' => 'edit',
            'all_permission'  => $all_permission,
            'edit_permission'  => $edit_permission,
        ]);
    }

    /**
     *  Permission Status Update
     */
    public function permissionStatusUpdate($id)
    {
       $status = Permission::findOrFail($id);
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
     *  Trash Update
     */
    public function PermissionTrashUpdate($id)
    {
        $trash_update = Permission::findOrFail($id);
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
        // Validation
        $this->validate($request,[
            'name'  => 'required',
        ]);

        // Data Update
       $update_permission = Permission::findOrFail($id);
       $update_permission ->update([
            'pname'     => $request -> name,
            'slug'     => Str::slug($request -> name),
        ]);

        // Return Back
        return back()->with('success','Permission Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Permission::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Permission Deleted Successful!');
    }
}
