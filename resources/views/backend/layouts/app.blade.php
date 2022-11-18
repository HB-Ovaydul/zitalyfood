<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>ZItalyFood - {{ Auth::guard('admin')->user()-> name }}</title>
		
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
        <link rel="stylesheet" href="{{ asset('back-end/admin/style.css') }}">
        <link rel="stylesheet" href="{{ asset('back-end/assets/DataTables/datatables.min.css') }}">
		<!-- DataTable plugin -->
		{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/> --}}
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
		{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script> --}}
		
		{{-- select2
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
<script src="{{ asset('back-end/assets/DataTables/datatables.min.js') }}"></script>  

<!-- Custom JS -->
<script  src="{{ asset('back-end/assets/js/script.js') }}"></script>
<script  src="{{ asset('back-end/admin/admin.js') }}"></script>

</body>
</html>