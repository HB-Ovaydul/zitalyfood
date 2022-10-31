<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Doccure - Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('back-end/assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('back-end/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('back-end/assets/css/font-awesome.min.css') }}">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('back-end/assets/css/feathericon.min.css') }}">
		
		<link rel="stylesheet" href="{{ asset('back-end/assets/plugins/morris/morris.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('back-end/assets/css/style.css') }}">
		<!-- DataTable plugin -->
		<link rel="stylesheet" type="text/css" href="https:/cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>

		{{-- icons --}}
		<link rel="stylesheet" href="{{ asset('back-end/assets/icon/themify-icons.css') }}">
		{{-- select2 --}}
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		{{-- Et-line-icon --}}
		<link rel="stylesheet" href="{{ asset('back-end/assets/icon/et-line-icon/style.css') }}">
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
		@include('backend.layouts.header')
		@include('backend.layouts.sidbar')
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Admin!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

				@section('content')
					
				@show
					
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        {{-- <script src="{{ asset('back-end/assets/js/jquery-3.2.1.min.js') }}"></script> --}}
		
		<!-- Bootstrap Core JS -->
        {{-- <script src="{{ asset('back-end/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('back-end/assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slimscroll JS -->
        <script src="{{ asset('back-end/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script> --}}
		
		{{-- <script src="{{ asset('back-end/assets/plugins/raphael/raphael.min.js') }}"></script>    
		<script src="{{ asset('back-end/assets/plugins/morris/morris.min.js') }}"></script>  
		<script src="{{ asset('back-end/assets/js/chart.morris.js') }}"></script> --}}
		<!-- DataTable plugin -->
		{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
		{{-- select2 --}}
		{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
		
		<!-- Custom JS -->
		{{-- <script  src="{{ asset('back-end/assets/ckeditor/ckeditor.js') }}"></script>
		<script  src="{{ asset('back-end/assets/js/script.js') }}"></script> --}}
<!-- jQuery -->
<script src="{{ asset('back-end/assets/js/jquery-3.2.1.min.js') }}"></script>
		
<!-- Bootstrap Core JS -->
<script src="{{ asset('back-end/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('back-end/assets/js/bootstrap.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('back-end/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('back-end/assets/plugins/morris/morris.min.js') }}"></script>  
<script src="{{ asset('back-end/assets/js/chart.morris.js') }}"></script>
<script src="{{ asset('back-end/assets/plugins/raphael/raphael.min.js') }}"></script>  

<!-- Custom JS -->
<script  src="{{ asset('back-end/assets/js/script.js') }}"></script>

		
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:34 GMT -->
</html>