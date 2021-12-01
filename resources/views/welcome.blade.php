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
		<link href="{{ url('/') }}/assets/css/themes/layout/header/base/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="{{ url('/') }}/assets/css/themes/layout/header/menu/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="{{ url('/') }}/assets/media/logos/logo.png" />
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
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="d-flex flex-column-fluid">
						<div class="d-flex flex-column flex-root">
							<div style="background-image: url('{{ asset('/') }}assets/media/bg/bg-4.jpg'); margin-top: -50px; margin-bottom: -30px" class="login login-4 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid" id="kt_login">
								<div class="col-md-12 login-aside d-flex flex-column flex-row-auto mt-30">
									<div class="login-form text-center p-7 position-relative overflow-hidden bgi-no-repeat" style="background-image: url('{{ asset('/') }}assets/media/bg/bg-8.jpg'); height: 350px; margin: 70px auto;border-radius: 10px">
										<div class="login-signin">
											<div class="mb-10">
												<h3>TELKOM AKSES</h3>
												<div class="text-white font-weight-bold">Silahkan login untuk menggunakan aplikasi ini</div>
											</div>
											<form action="{{ URL::to('/') }}" class="form" id="login-form">
												<div class="form-group mb-5 nik">
													<input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="nik" autocomplete="off" autofocus />
													<div class="fv-plugins-message-container">
														<div class="fv-help-block"></div>
													</div>
												</div>
												<div class="form-group mb-2 password">
													<input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
													<div class="fv-plugins-message-container">
														<div class="fv-help-block"></div>
													</div>
												</div>
												<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
												</div>
												<button type="submit" id="submitButton" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Log In</button>
											</form>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="{{ url('/') }}/assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
		<script src="{{ url('/') }}/assets/js/scripts.bundle.js?v=7.0.5"></script>

    <script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
		    }
		  });

        $("#login-form").submit( function (e) {
            e.preventDefault();
            $('.form-group').removeClass('has-danger');
            $('.fv-help-block').text('');
            $('input').removeClass('is-invalid');

            $('#submitButton').attr('disabled', 'true');
            $('#submitButton').addClass('spinner spinner-left pl-15')

            $.ajax({
                url: "{{ URL::to('/') }}/login",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function(response) {
                    if(response.success == 1)
                    {
                      location.reload();
                    }
                },
                error: function(error) {
					$('#submitButton').removeAttr('disabled');
					$('#submitButton').removeClass('spinner spinner-left pl-15');
					Swal.fire({
							position: "bottom-right",
							icon: "error",
							title: "Username/Password Salah",
							showConfirmButton: false,
							allowOutsideClick: false,
							allowEscapeKey: false,
							timer: 3500
						});
				}
			});
		});
    </script>

	</body>
</html>