<div id="sidebar" class="col-1-3">
    @php
    $latest_post = App\Models\Post::latest()->where('trash', false)->where('status', true)->take(3)->get();
    $tag = App\Models\Teg::all()->where('trash', false)->where('status', true);
    @endphp
        @include('frontend.blog.about')
        <!---- Start Widget ---->
        <div class="widget wid-post">
            <div class="wid-header">
                <h5>Latest Posts</h5>
            </div>
            <div class="wid-content">
                @foreach ($latest_post as $latest)
                <div class="post">
                    <a href="#"><img src="{{ url('storage/post_feature/'.$latest -> feature) }}"/></a>
                    <div class="wrapper">
                      <h5><a href="{{ $latest -> slug }}">{{ $latest -> title }}</a></h5>
                      <span>{{  $latest -> price }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!---- Start Widget ---->
        <div class="widget wid-tag">
            <div class="wid-header">
                <h5>Tags</h5>
            </div>
              
            <div class="wid-content">
                @foreach ($tag as $tags)
                <a href="{{ $tags -> slug }}">{{ $tags -> tname }} ,</a>
                @endforeach
            </div>
        </div>
        <!---- Start Widget ---->
        <div class="widget wid-gallery">
            <div class="wid-header">
                <h5>Gallery</h5>
            </div>
            <div class="wid-content">
                @foreach ($latest_post as $gallerys)
                    @foreach (json_decode($gallerys -> gallery) as $item)
                    <a href="#"><img src="{{url('storage/gell_image/'. $item )}}"></a>  
                    @endforeach 
                @endforeach
            </div>
        </div>
    </div>
</div>