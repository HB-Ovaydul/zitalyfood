@extends('frontend.layouts.app')

@section('main-content')
<div class="zerogrid">
	<div class="callbacks_container">
		<ul class="rslides" id="slider4">

			@php
				$sliders = App\Models\Slider::latest()->where('status', true)->take(3)->get();
			@endphp

			@foreach ($sliders as $slide)
			<li>
				<img src="{{ url('storage/slider/'. $slide -> photo) }}" alt="">
				<div class="caption">
					<h2>{{ $slide -> title }}</h2></br>
					<p>{{ $slide -> subtitle }}</p>
				</div>
			</li>
			@endforeach


			{{-- <li>
				<img src="frontend/images/banner2.jpg" alt="">
				<div class="caption">
					<h2>If food is an experience, then you'll find it at the restaurant.</h2></br>
					<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
				</div>
			</li>
			<li>
				<img src="frontend/images/banner3.jpg" alt="">
				<div class="caption">
					<h2>Enjoy our take-away menu.</h2></br>
					<p>At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
				</div>
			</li> --}}
		</ul>
	</div>
</div>

<!--////////////////////////////////////Container-->
<section id="container" class="index-page">
	<div class="wrap-container zerogrid">
		<!-----------------content-box-1-------------------->
		<section class="content-box box-1">
			<div class="zerogrid">
				<div class="row box-item"><!--Start Box-->
					<h2>“Your awesome company slogan goes here, we have the best food around”</h2>
					<span>Unc elementum lacus in gravida pellentesque urna dolor eleifend felis eleifend</span>
				</div>
			</div>
		</section>
		<!-----------------content-box-2-------------------->
		<section class="content-box box-2">
			<div class="zerogrid">
				<div class="row wrap-box"><!--Start Box-->

					@php
					$heading = App\Models\Heading::latest()->where('status', true)->take(1)->get();
					@endphp
					@foreach ($heading as $heade)
					<div class="header">
						<h2>Welcome</h2>
						<hr class="line">
						<span>{{ $heade -> subheading }}</span>
					</div>
					@endforeach
					<div class="row">
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Menu Card<b></b></span>
									<img src="frontend/images/menu.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Fast Food<b></b></span>
									<img src="frontend/images/fast-food.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Reservation<b></b></span>
									<img src="frontend/images/reservation.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Chef<b></b></span>
									<img src="frontend/images/chef.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Preview<b></b></span>
									<img src="frontend/images/preview.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
						<div class="col-1-3">
							<div class="wrap-col">
								<div class="box-item">
									<span class="ribbon">Text Heading<b></b></span>
									<img src="frontend/images/reservation.jpg" alt="">
									<p>The sliding menucard will surely impress your customers! Set up several pages and display them side by side, just as on a paper menucard!</p>
									<a href="#" class="button button-1">Detail</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section>
@endsection