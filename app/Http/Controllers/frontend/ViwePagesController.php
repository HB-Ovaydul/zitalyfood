<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Teg;
use Illuminate\Http\Request;

class ViwePagesController extends Controller
{
    /**
     * view Home Page 
     */
    public function ShowHomePage()
    {
       return view('frontend.home.index');
    }
    /**
     * view Home Page 
     */
    public function ShowBlogPage()
    {
       return view('frontend.blog.index');
    }

    /**
     * view news Single page 
     */
    public function ShowNewsSinglePage($slug)
    {
      $singl_post = Post::where('slug', $slug)->first();
       return view('frontend.blog.news',[
         'singl_post'   => $singl_post,
       ]);
    }
    /**
     * view news page 
     */
    public function ShowNewsPage()
    {
      $news = Post::latest()->get()->take(1);
       return view('frontend.blog.newsmain',[
         'news' => $news,
       ]);
    }
   
}
