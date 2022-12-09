<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use Intervention\Image\Facades\Image;
use SebastianBergmann\Type\TrueType;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_about = About::latest()->get()->where('trash', false);
        return view('backend.pages.blog.about.index',[
            'form_type'     => 'create',
            'all_about'     => $all_about,
        ]);
    }

    /**
     *  Show Trash Page
     */
    public function ShoeAboutTrashPage()
    {
        $all_trash = About::latest()->get()->where('trash', true);
        return view('backend.pages.blog.about.trash',[
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
            'photo'     => 'required',
            'dec'       => 'required',
        ]);
        // Photo Upload

        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $intervantion = Image::make($img -> getRealPath());
            $intervantion -> save(storage_path('app/public/about/'.$file_name));
        }
        // Data Store

        About::create([
            'title'     => $request -> title,
            'content'     => $request -> dec,
            'photo'     => $file_name,
        ]);

        return back()->with('success', 'About Added Successful');

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
        $all_about = About::latest()->get()->where('trash', false);
        $edit = About::findOrFail($id);
        return view('backend.pages.blog.about.index',[
            'form_type'     => 'edit',
            'all_about'     => $all_about,
            'edit'          => $edit,
        ]);
    }

    /**
     *  About Status Update
     */
    public function AboutStatusUpdate($id)
    {
        $status_update = About::findOrFail($id);
        if($status_update -> status){
            $status_update -> update([
                'status'    => false,
            ]);
            return back()->with('danger-table', 'User Blocked');
        }else{
            $status_update -> update([
                'status'    => true,
            ]);
            return back()->with('success-table', 'Activate');
        }
    }
    /**
     *  About Status Update
     */
    public function AboutTrashUpdate($id)
    {
        $trash_update = About::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash'    => false,
                'status'    => true,
            ]);
            return back()->with('success-table', 'Data Restored');
        }else{
            $trash_update -> update([
                'trash'    => true,
                'status'    => false,
            ]);
            return back()->with('danger-table', 'Move To Trash');
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
        $about_update = About::findOrFail($id);

        // Photo Upload
        if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $intervantion = Image::make($img -> getRealPath());
            $intervantion -> save(storage_path('app/public/about/'.$file_name));
            unlink('storage/about/'.$about_update->photo);
        }else{
            $file_name = $about_update -> photo;
        }
        // Data Store

        $about_update -> update([
            'content'     => $request -> dec,
            'photo'     => $file_name,
        ]);

        return back()->with('success', 'About Updated Successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = About::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Data Deleted Successful');
    }
}
