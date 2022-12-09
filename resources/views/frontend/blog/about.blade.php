
@php
    $abouts = App\Models\About::latest()->where('trash', false)->take(1)->get();
@endphp
<div class="wrap-sidebar">
    <!---- Start Widget ---->
 @foreach ($abouts as $about)
 <div class="widget wid-about">
     <div class="wid-header">
         <h5>About Us</h5>
     </div>
     <div class="wid-content">
         <img src="{{ url('storage/about/'. $about -> photo) }}"/>
         <p>{{ $about -> content }}</p>
     </div>
 </div>
 @endforeach