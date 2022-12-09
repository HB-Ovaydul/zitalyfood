	<!--///////////////////////////////////////Top-->
	<div class="top">
		<div class="zerogrid">
			<ul class="number f-left">
				<li class="mail"><p>ContacUst@Gmail.com</p></li>
				<li class="phone"><p>08 88888 88888</p></li>
			</ul>
			<ul class="top-social f-right">
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
	<!--////////////////////////////////////Header-->
    <!--header-->
    <header>
        <div class="zerogrid">
            <center><div class="logo"><img src="frontend/images/logo.png"></div></center>
        </div>
    </header>
    <!--header-->
	<div class="site-title">
		<div class="zerogrid">
			<div class="row">
				@php
				$heading = App\Models\Heading::latest()->where('status', true)->take(1)->get();
				@endphp
				@foreach ($heading as $item)
					<h2 class="t-center">{{ $item -> heading }}</h2>
				@endforeach
			</div>
		</div>
	</div>
    <!--//////////////////////////////////////Menu-->
    <a href="#" class="nav-toggle">Toggle Navigation</a>
    <nav class="cmn-tile-nav">
		<ul class="clearfix">
			<li class="colour-1"><a href="{{ route('home.page') }}">Home</a></li>
			<li class="colour-2"><a href="menu.html">Menu</a></li>
			<li class="colour-3"><a href="location.html">Location</a></li>
			<li class="colour-4"><a href="{{ route('blog.page') }}">Blog</a></li>
			<li class="colour-5"><a href="reservation.html">Reservation</a></li>
			<li class="colour-6"><a href="staff.html">Our Staff</a></li>
			<li class="colour-7"><a href="{{ route('news.main.page') }}">News</a></li>
			<li class="colour-8"><a href="gallery.html">Gallery</a></li>
		</ul>
    </nav>