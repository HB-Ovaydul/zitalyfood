<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_roel = Role::latest()->get()->where('trash', false);
        $get_permission = Permission::latest()->get();
        return view('backend.pages.adminoption.role.index',[
            'form_type'         => 'create',
            'all_role'          => $all_roel,
            'get_permission'    => $get_permission,
        ]);
    }

    /**
     * Role Trash Page
     */
    public function RoleTrashPage()
    {
        $all_trash = Role::latest()->get()->where('trash', true);
        return view('backend.pages.adminoption.role.trash',[
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
       $roles = Role::create([
            'rname'         => $request -> name,
            'slug'          => Str::slug($request -> name),
            'permission'    => json_encode($request -> permission),
        ]);

        // Return Back
        return back()->with('success','Role Added Successful!');
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
        $all_roel = Role::latest()->get()->where('trash', false);
        $get_permission = Permission::latest()->get()->where('trash', false);
        $role_edit = Role::findOrFail($id);
        return view('backend.pages.adminoption.role.index',[
            'form_type'         => 'edit',
            'all_role'          => $all_roel,
            'get_permission'    => $get_permission, 
            'role_edit'         => $role_edit, 
        ]);
    }

    /**
     *  Role Status Update
     */
    public function RoleStatusUpdate($id)
    {
       $status = Role::findOrFail($id);
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
    public function RoleTrashUpdate($id)
    {
        $trash_update = Role::findOrFail($id);
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
       $update_role = Role::findOrFail($id);
       $update_role ->update([
        'rname'         => $request -> name,
        'slug'          => Str::slug($request -> name),
        'permission'    => json_encode($request -> permission),
        ]);

        // Return Back
        return back()->with('success','Role Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Role::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Role Deleted Successful!');
    }
}
