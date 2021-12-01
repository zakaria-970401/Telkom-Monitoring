<!DOCTYPE html>
<html lang="en">
	<head><base href="{{ url('/') }}">
		<meta charset="utf-8" />
		<title>Telkom | Monitoring Gangguan</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}" />
		<link href="{{ url('/') }}/assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/themes/layout/header/base/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="{{ url('/') }}/assets/media/logos/logo.png" />
        <style type="text/css">
            .hide {
                display: none;
            }
			.table-thin tr td, .table-thin tr th {
				padding: 5px !important
			}
        </style>
		@stack('styles')
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed" style="">
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed" style="right: 50px">
			<a href="{{ url('/') }}">
				<img alt="Logo" src="{{ url('/') }}/assets/media/logos/logo.png" style="width: 50px;" />
			</a>
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
			</div>
		</div>
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('layouts.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="d-flex flex-column-fluid">
							@yield('content')
						</div>
					</div>
					@include('layouts.footer')
				</div>
			</div>
		</div>
		@if(Auth::check())
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile</h3>
				<a href="javascript:" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				@if(Auth::check())
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<span class="symbol symbol-35 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </span>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="javascript:" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ explode(' ', Auth::user()->name)[0] }}</a>
						<div class="text-muted mt-1">@if(Auth::user()->department) {{ Auth::user()->department->name }} @endif</div>
						<div class="navi mt-2">
							<a href="javascript:" class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5 logout">Sign Out</a>
						</div>
					</div>
				</div>
				@endif
				</div> 
			</div>
		@endif
		<script src="{{ url('/') }}/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/js/scripts.bundle.js?v=7.0.5"></script>


		<script>
		  $.ajaxSetup({
		    headers: {
		      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		    }
		  });

		    @if(Session::has('info'))
				toastr.info("{{ Session::get('info') }}");
			@endif
			  @if(Session::has('error'))
				toastr.error("{{ Session::get('error') }}");
			@endif
			  @if(Session::has('success'))
				toastr.success("{{ Session::get('success') }}");
			@endif

		  $(".logout").click( function () {
		    $.ajax({
		      url: "{{ URL::to('/') }}/logout",
		      type: "POST",
		      dataType: "JSON",
		      success: function ( response )
		      {
		        if(response.success == 1)
		        {
		          location.reload();
		          return false;
		        }
		      },
		      error: function ( error )
		      {
		      	location.reload();
		        console.log( error );
		      }
		    });
		  });
		</script>
		@stack('scripts')
	</body>
	<!--end::Body-->
</html>
