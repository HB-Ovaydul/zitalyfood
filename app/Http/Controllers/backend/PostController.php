<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teg;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_post = Post::latest()->where('trash', false)->get();
        $tag = Teg::latest()->where('trash', false)->get();
        return view('backend.pages.blog.post.index',[
            'form_type'     => 'create',
            'all_post'          => $all_post,
            'tag'          => $tag,
        ]);
    }

    /**
     *  Post Trash Pages
     */
    public function ShoePostTrashPage()
    {
        $all_trash = Post::latest()->where('trash', true)->get();
        // $trash_tag = Teg::latest()->where('trash', true)->get();
        return view('backend.pages.blog.post.trash',[
            'all_trash'          => $all_trash,
            // 'trash_tag'          => $trash_tag,
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
            // Validate
            $this->validate($request,[
                'title' => 'required',
                'feature' => 'required',
                'price' => 'required',
            ]);
        // Feature Image Uplode

        if($request -> hasFile('feature')){
            $img = $request -> file('feature');
            $feature_name = md5(rand().time()).'.'.$img -> clientExtension();
            $file_inter = Image::make($img -> getRealPath());
            $file_inter -> save(storage_path('app/public/post_feature/'.$feature_name));
        }

        // Gallery Image Upload
            $gallery = [];
        if($request -> hasFile('gallery')){
            $gall_image = $request -> file('gallery');
            foreach ($gall_image as $gall) {
                $gall_name = md5(rand().time()).'.'.$gall -> clientExtension();
                $gell_inter = Image::make($gall -> getRealPath());
                $gell_inter -> save(storage_path('app/public/gell_image/'.$gall_name));
                array_push($gallery ,$gall_name);
            }
        }

        // Data Store
       $post = Post::create([
            'title'         => $request -> title,
            'slug'          => Str::slug($request -> title),
            'content'       => $request -> content,
            'price'         => $request -> price,
            'quote'         => $request -> quote,
            'head1'         => $request -> head1,
            'head2'         => $request -> head2,
            'head3'         => $request -> head3,
            'feature'       => $feature_name,
            'gallery'       => json_encode($gallery),
        ]);

        $post -> tags() -> attach($request -> tag);
        return back()->with('success', 'Post Added Successful');

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
        $all_post = Post::latest()->where('trash', false)->get();
        $tag_post = Teg::latest()->get();
        $edit = Post::findOrFail($id); 
        return view('backend.pages.blog.post.index',[
            'form_type'         => 'edit',
            'all_post'          => $all_post,
            'edit'              => $edit,
            'tag_post'          => $tag_post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    // using for to delete it

    // public function destroy($id)
    //     {
    //        $infokeg = Infokeg::where('id', $id)->first();
    //        $image = json_decode($infokeg->foto_kegiatan);
    //        $length = count($image);
    //        for ($i = 0; $i < $length; $i++) {
    //            unlink(public_path("data_file/".$image[$i]));
    //        }
    //        $infokeg->delete();
    //        return redirect('infokeg')->with('msg', 'Data Telah Terhapus');
    //    }


    public function update(Request $request, $id)
    {
        $post_update = Post::findOrFail($id);
        // Feature Image Uplode

        // if($request -> hasFile('new_feature')){
        //     $img = $request -> file('new_feature');
        //     $feature_name = md5(rand().time()).'.'.$img -> clientExtension();
        //     $file_inter = Image::make($img -> getRealPath());
        //     $file_inter -> save(storage_path('app/public/post_feature/'.$feature_name));
        //     unlink('storage/post_feature/'.$post_update -> feature);
        // }else{
        //     $feature_name = $post_update -> old_feature;
        // }

        // Gallery Image Upload
        $post_update = Post::findOrFail($id);
         $gallery = json_decode($post_update -> gallery);
        if($request -> hasFile('gallery')){
            $gall_image = $request -> file('gallery');
            // Delete Old File
            $find = Post::where('id', $id)->first();
            $galls = json_decode($find -> gallery);
            $length = count($galls);
            for ($i=0; $i < $length; $i++) { 
                unlink(public_path('storage/gell_image'.$galls[$i]));
            }  
            foreach ($gall_image as $gall) {
                $gall_name = md5(rand().time()).'.'.$gall -> clientExtension();
                $gell_inter = Image::make($gall -> getRealPath());
                $gell_inter -> save(storage_path('app/public/gell_image/'.$gall_name));
              array_push($gallery ,$gall_name);
            }
            }

           return $post_update -> update([
                'gallery'       => json_encode($gallery),
            ]);
        // Data Store

        // $post_update -> update([
        //     'title'         => $request -> title,
        //     'slug'          => Str::slug($request -> title),
        //     'content'       => $request -> content,
        //     'price'         => $request -> price,
        //     'feature'       => $feature_name,
        //     'gallery'       => json_encode($gallery),
        // ]);

        // $post_update -> tags() -> sync($request -> tag);
        return back()->with('success', 'Post Added Successful');
    }

     /**
     *  Role Status Update
     */
    public function PostStatusUpdate($id)
    {
       $status = Post::findOrFail($id);
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
    public function PostTrashUpdate($id)
    {
        $trash_update = Post::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash' => false,
                'status' => true,
            ]);
            return back()->with('success-table', 'Post Restored!');
        }else{
            $trash_update -> update([
                'trash' => true,
                'status' => false,
            ]);
            return back()->with('danger-table', 'Post Move To Trash');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_delete = Post::findOrFail($id);
        $post_delete -> delete();
        return back()->with('success-table', 'Post Deleted Successful!');
    }
}


        






