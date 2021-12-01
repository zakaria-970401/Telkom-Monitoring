
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>@yield('judul')</title>
		<meta name="description" content="No aside layout examples" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<!--end::Fonts-->
		<link href="{{ url('/') }}/assets/plugins/global/plugins.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/style.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/themes/layout/header/base/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/themes/layout/header/menu/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{ url('/') }}/assets/media/logos/logo-pas.jpg" />
		<!-- Hotjar Tracking Code for keenthemes.com -->
		@stack('styles')
		<style type="text/css">
    body {
			background: #808080;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #3fada8, #808080);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #3fada8, #808080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		}
    </style>

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed ">
		<!-- Google Tag Manager (noscript) -->
		<!-- End Google Tag Manager (noscript) -->
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
			<!--begin::Logo-->
			<a href="{{ url('/') }}">
				<img alt="Logo" src="{{ url('/') }}/assets/media/logos/logo-pas.jpg" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Header Menu Wrapper-->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<!--begin::Header Logo-->
								<div class="header-logo">
									<a href="{{ url('/') }}">
                                        <img alt="Logo" src="{{ url('/') }}/assets/media/logos/logo-pas.jpg" />
                                    </a>
								</div>
								<!--end::Header Logo-->
								<!--begin::Header Menu-->
								<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
									<!--begin::Header Nav-->
									<ul class="menu-nav">
										<li class="menu-item menu-item-submenu menu-item-rel menu-item mb-2 border" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" onclick="dashboard()" class="menu-link menu-toggle">
												<i class="fas fa-home mr-2 text-dark"></i>
												<span class="menu-text text-dark">Home</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu menu-item-rel menu-item mb-2 border" data-menu-toggle="click" aria-haspopup="true">
											<a class="menu-link menu-toggle">
												<i class="fas fa-power-off mr-2 text-dark"></i>
												<span class="menu-text text-dark" id="kt_quick_user_toggle">Logout</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="topbar">
								<div class="topbar-item">
									<span class="symbol symbol-35 symbol-light-danger">
                                    <span class="symbol-label font-size-h5 font-weight-bold" style="width: 100px">
                                        <span class="time"></span>
                                    </span>
                                </span>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
							<div class="container">
                                @yield('konten')
							</div>
					</div>
				<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">2020 ©</span>
                            <a href="{{ url('') }}" class="text-dark-75 text-hover-primary">ITE. PAS</a>
                        </div>
                        <div class="nav nav-dark">
                            <a href="{{ url('') }}" class="nav-link pl-0 pr-5">About</a>
                            <a href="{{ url('') }}" class="nav-link pl-0 pr-5">Team</a>
                            <a href="{{ url('') }}" class="nav-link pl-0 pr-0">Contact</a>
                        </div>
                        <div class="nav nav-dark">
                            <span class="nav-link text-dark-75">PT. Prakarsa Alam Segar. v. 3.0.0</span>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">APAKAH ANDA YAKIN? 
					<hr>
			</div>
			<div class="offcanvas-content pr-5 mr-n5">
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						{{-- <div class="symbol-label" style="background-image:url('{{ url('/') }}/assets/media/users/300_21.jpg')"></div> --}}
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a href="#" class="btn btn-xl btn-success" id="kt_quick_user_close">Batal</a>
							<a href="#" onclick="Logout()" class="btn btn-xl btn-primary ml-4"><i class="fas fa-sign-out-alt"></i> Ya, Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:{{ url('/') }}/assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
			</span>
		</div>
		<script>var HOST_URL = "{{ url('/') }}";</script>
		<script src="{{ url('/') }}/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/js/scripts.bundle.js?v=7.0.5"></script>

	<script type="text/javascript">

	var auth = sessionStorage.getItem('auth');
	var nik = sessionStorage.getItem('nik');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
		 function Logout() 
		 {
			  if(auth == 'packing_bumbu')
			  {
				location.href = "{{ url('/noodle_1/packing_bumbu/login') }}";
				sessionStorage.removeItem('nik');
				sessionStorage.removeItem('shift');
				sessionStorage.removeItem('line');
			  }
		 }

		if(sessionStorage.getItem('nik') == null )
	{
			  if(auth == 'packing_bumbu')
			  {
				location.href = "{{ url('/noodle_1/packing_bumbu/login') }}";
			  }
	}

	function dashboard() 
		{
			if(auth == 'packing_bumbu')
			{
				location.href = "{{ url('/noodle_1/packing_bumbu/index') }}/" + nik;
			}
		}

	if(auth == 'packing_bumbu')
	{
		$('.MenuOne').text('Packing Bumbu');
	}

	function kasihNol($data) {
        if($data < 10)
        {
            return '0'+$data;
        }else{
            return $data;
        }
    }

    function get_time()
    {
        const today = new Date();
        const time = kasihNol(today.getHours()) + ":" + kasihNol(today.getMinutes()) + ":" + kasihNol(today.getSeconds());
        const date = kasihNol(today.getDate())+'/'+kasihNol((today.getMonth()+1))+'/'+kasihNol(today.getFullYear());
        $('.date').text(date);
        $('.time').text(time);
    }

    get_time();

    setInterval(function () {
        get_time();
    }, 1000);

     @if(Session::has('success'))
  		toastr.info("{{ Session::get('success') }}");
  @endif

  @if(Session::has('info'))
  		toastr.info("{{ Session::get('info') }}");
  @endif


  @if(Session::has('warning'))
  		toastr.warning("{{ Session::get('warning') }}");
  @endif


  @if(Session::has('error'))
  		toastr.error("{{ Session::get('error') }}");
  @endif
</script>


@stack('scripts')
	</body>
</html>