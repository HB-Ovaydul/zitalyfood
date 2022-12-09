<?php

namespace App\Http\Controllers\backend;

use App\Models\slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sliders = Slider::latest()->where('trash', false)->get();
        return view('backend.pages.slider.index',[
            'form_type'     => 'create',
            'sliders'     => $sliders,
        ]);
    }

    /**
     *  Show Trash page
     */
    public function ShowTrashPage()
    {
        $all_trash = Slider::latest()->where('trash', true)->get();
        return view('backend.pages.slider.trash',[
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
        // validate
        $this->validate($request,[
            'title'     => 'required',
            'dec'     => 'required',
            'photo'     => 'required',
        ]);

        // Photo Uplode

        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $intervantion = Image::make($img -> getRealPath());
            $intervantion -> save(storage_path('app/public/slider/'.$file_name));
        }
        // Data Store
        slider::create([
            'title'     => $request -> title,
            'subtitle'  => $request -> dec,
            'photo'     => $file_name,
        ]);

        return back()->with('success', 'Slider Created Successful!');
        
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
        $sliders = Slider::latest()->where('trash', false)->get();
        $edit = Slider::findOrFail($id);
        return view('backend.pages.slider.index',[
            'form_type'     => 'edit',
            'edit'     => $edit,
            'sliders'     => $sliders,
        ]);
    }

     /**
     *  Permission Status Update
     */
    public function sliderStatusUpdate($id)
    {
       $status = Slider::findOrFail($id);
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
    public function sliderTrashUpdate($id)
    {
        $trash_update = Slider::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash' => false,
                'status' => true,
            ]);
            return back()->with('success-table', 'Slider Restored!');
        }else{
            $trash_update -> update([
                'trash' => true,
                'status' => false,
            ]);
            return back()->with('danger-table', 'Slider Move To Trash');
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
         // validate
        //  $this->validate($request,[
        //     'title'     => 'required',
        //     'dec'     => 'required',
        //     'photo'     => 'required',
        // ]);

        // Photo Uplode
      $update_data  = Slider::findOrFail($id);

        if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $intervantion = Image::make($img -> getRealPath());
            $intervantion -> save(storage_path('app/public/slider/'.$file_name));
            unlink('storage/slider/'.$update_data -> photo);
        }else{
            return 'false';
            $file_name = $update_data -> old_photo;
        }
        // Data Store
        $update_data -> update([
            'title'     => $request -> title,
            'subtitle'  => $request -> dec,
            'photo'     => $file_name,
        ]);

        return back()->with('success', 'Slider Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Slider::findOrFail($id);
        $delete -> delete();
        return back()->with('success-table', 'Slider Deleted Successful!');
    }
}
