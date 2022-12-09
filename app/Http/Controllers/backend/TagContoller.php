<?php

namespace App\Http\Controllers\backend;

use App\Models\Teg;
use Illuminate\Support\Str;
use Illuminate\Cache\TagSet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_tag = Teg::latest()->where('trash', false)->get();
        return view('backend.pages.blog.tag.index',[
            'form_type'     => 'create',
            'all_tag'     => $all_tag,
        ]);
    }

    /**
     *  Shoe Tag Tarsh Page
     */
    public function ShowTrashPage()
    {
        $all_trash = Teg::latest()->where('trash', true)->get();
        return view('backend.pages.blog.tag.trash',[
            'all_trash'     => $all_trash,
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
            'tname' => ['required'],
        ]);
        // Data Store
        Teg::create([
            'tname'     => $request -> tname,
            'slug'      => Str::slug($request -> tname),
        ]);

        return back()->with('success', 'Tag Add Successful');
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
        $all_tag = Teg::latest()->where('trash', false)->get();
        $edit = Teg::findOrFail($id);
        return view('backend.pages.blog.tag.index',[
            'form_type'     => 'edit',
            'all_tag'     => $all_tag,
            'edit'     => $edit,
        ]);
    }

    /**
     *  Role Status Update
     */
    public function TagStatusUpdate($id)
    {
       $status = Teg::findOrFail($id);
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
    public function TagTrashUpdate($id)
    {
        $trash_update = Teg::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash' => false,
                'status' => true,
            ]);
            return back()->with('success-table', 'Tag Restored!');
        }else{
            $trash_update -> update([
                'trash' => true,
                'status' => false,
            ]);
            return back()->with('danger-table', 'Tag Move To Trash');
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
            'tname' => ['required'],
        ]);
        // Data Store
        $tag_update = Teg::findOrFail($id);
        $tag_update -> update([
            'tname'     => $request -> tname,
            'slug'      => Str::slug($request -> tname),
        ]);

        return back()->with('success', 'Tag Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Teg::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Tag Deleted Successful!');
    }
}
