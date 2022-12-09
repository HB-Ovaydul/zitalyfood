@extends('frontend.layouts.app')
@section('main-content')
<section id="container" class="sub-page">
	<div class="wrap-container zerogrid">
		<div class="crumbs">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="news.html">News</a></li>
			</ul>
		</div>
		<div id="main-content" class="col-2-3">
			<div class="wrap-content">
                @foreach ($news as $nw_page)
                
                                <article>
                                    <div class="art-header">
                                        <div class="entry-title"> 
                                            <h2>{{ $nw_page -> title }}</h2>
                                        </div>
                                        <div class="info">By @foreach (json_decode($nw_page -> tags) as $tag) <a href="{{ $tag -> slug }}">{{ $tag -> tname }}</a>@endforeach on {{ date('Y, d, F', strtotime($nw_page -> created_at)) }}</div>
                                    </div>
                                    <div class="art-content">
                                        <img src="{{ url('storage/post_feature/', $nw_page -> feature) }}" />
                                        <div class="excerpt"><p>{!! htmlspecialchars_decode($nw_page -> content) !!}</p>
                                        <blockquote><p>{!! htmlspecialchars_decode($nw_page -> quote) !!}</p></blockquote>
                                        <h2>Heading 1</h2>
                                        <p>{!! htmlspecialchars_decode($nw_page -> head1) !!}</p>
                                        <h2>Heading 2</h2>
                                        <p>{!! htmlspecialchars_decode($nw_page -> head2) !!}</p>
                                        <h2>Heading 3</h2>
                                        <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum hendrerit in vulputate velit esse molestie.</p>
                                        <p><code>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</code>
                                            {!! htmlspecialchars_decode($nw_page -> head3) !!}
                                        </p>
                                        <div class="note">
                                          <ol>
                                            <li>Lorem ipsum</li>
                                            <li>Sit amet vultatup nonumy</li>
                                            <li>Duista sed diam</li>
                                          </ol>
                                          <div class="clear"></div>
                                        </div>
                                        <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                        <p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores.</p>
                                    </div>
                                </article>
                    
                @endforeach
				<div class="widget wid-related">
					<div class="wrap-col">
						<div class="wid-header">
							<h5>Related Post</h5>
						</div>
						<div class="wid-content">
							<div class="row">
								<div class="col-1-3">
									<div class="wrap-col">
										<a href="#"><img src="images/10.jpg" /></a>
										<h4><a href="#">Vero eros et accumsan et iusto odio </a></h4>
									</div>
								</div>
								<div class="col-1-3">
									<div class="wrap-col">
										<a href="#"><img src="images/7.jpg" /></a>
										<h4><a href="#">Vero eros et accumsan et iusto odio </a></h4>
									</div>
								</div>
								<div class="col-1-3">
									<div class="wrap-col">
										<a href="#"><img src="images/8.jpg" /></a>
										<h4><a href="#">Vero eros et accumsan et iusto odio </a></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			{{-- sidebar --}}
			@include('frontend.blog.sidebar.index')
			{{-- sidebar --}}
	</div>	
</section>
@endsection