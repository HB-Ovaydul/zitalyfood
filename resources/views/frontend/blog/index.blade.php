@extends('frontend.layouts.app')
@section('main-content')
<section id="container" class="sub-page">
	<div class="wrap-container zerogrid">
		<div class="crumbs">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="archive.html">Blog</a></li>
			</ul>
		</div>
		<div id="main-content" class="col-2-3">
			<div class="wrap-content">

                @php
                   $blog_post = App\Models\Post::latest()->where('trash', false)->where('status', true)->get();
                   $tag = App\Models\Teg::latest()->where('trash', false)->where('status', true)->take(1)->get();
                @endphp

                @foreach ($blog_post as $posts)
				<article>
					<div class="art-header">
						<a href="#"><h3>{{ $posts -> title }}</h3></a>
						<div class="info">{{ date('F, d, Y', strtotime($posts -> created_at))}} in: @foreach ($tag as $tags)
							<a href="{{ $tags -> slug }}">{{ $tags -> tname }}</a>
						@endforeach</div>
					</div>
					<div class="art-content">
						<img src="{{ url('storage/post_feature/'. $posts -> feature) }}" />
						<p>{!! Str::of(htmlspecialchars_decode($posts -> content)) -> words(100, '...'); !!}</p>
					</div>
					<a class="button button02" href="{{ route('news.page', $posts -> slug) }}">MORE</a>
				</article>
					@endforeach
			</div>
		</div>
		<!--Sidebar-->
		@include('frontend.blog.sidebar.index')
		<!--Sidebar-->
	</div>
</section>
@endsection