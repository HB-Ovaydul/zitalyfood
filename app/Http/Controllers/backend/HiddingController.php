<?php

namespace App\Http\Controllers\backend;

use App\Models\Heading;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HiddingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $heading = Heading::latest()->where('trash', false)->get();
        return view('backend.pages.text.index',[
            'form_type'     => 'create',
            'heading'       => $heading,
        ]);
    }

    /**
     *  Show Trash Page 
     */
    public function ShowTrashPage()
    {
        $all_trash = Heading::latest()->where('trash', true)->get();
        return view('backend.pages.text.trash',[
            'all_trash'       => $all_trash,
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
        // Valtidation
        $this->validate($request,[
            'title'     => 'required',
            'dec'       => 'required',
        ]);

        // Data Store

       Heading::create([
        'heading' => $request -> title,
        'subheading' => $request -> dec,
       ]);

       return back()->with('success', 'Heading Add Successful');
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
        $heading = Heading::latest()->where('trash', false)->get();
        $edit = Heading::findOrFail($id);
        return view('backend.pages.text.index',[
            'form_type'     => 'edit',
            'heading'       => $heading,
            'edit'          => $edit,
        ]);
    }

    /**
     *  Role Status Update
     */
    public function HeadingStatusUpdate($id)
    {
       $status = Heading::findOrFail($id);
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
    public function HeadingTrashUpdate($id)
    {
        $trash_update = Heading::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash' => false,
                'status' => true,
            ]);
            return back()->with('success-table', 'Heading Restored!');
        }else{
            $trash_update -> update([
                'trash' => true,
                'status' => false,
            ]);
            return back()->with('danger-table', 'Heading Move To Trash');
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
        // Valtidation
        $this->validate($request,[
            'title'     => 'required',
            'dec'       => 'required',
        ]);

      // Data Store

      $update_data = Heading::findOrFail($id);
      $update_data -> update([
        'heading' => $request -> title,
        'subheading' => $request -> dec,
       ]);

       return back()->with('success', 'Heading Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Heading::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Heading Deleted Successful!');
    }
}
