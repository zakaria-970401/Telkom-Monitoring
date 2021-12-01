@extends('layouts.base')

@push('styles')

<style type="text/css">
    .hide {
        display: none;
    }
    .shortcut-item:hover span.link {
        color: #bf0000 !important
    }
    .shortcut-item {
        display: inline-block;
        cursor:pointer;
        width: 50px;
        text-align:left;
        overflow: hidden;
        white-space: nowrap;
    }
    .shortcut-item-hover {
        width: auto;
    }
    .btn-show-all {
        transition-duration: 5s;
    }
    .btn-show-all:hover i {
        transform: scale(0.8)
    }
    #shortcuts-bank {
        height: 500px;
        width: 80%;
        right: 12px;
        bottom: 70px;
        background-color: rgba(255, 255, 255, 0.7);
        display: none;
    }
    .shortcuts-bank-container {
        width: 100%;
        max-height: 400px;
        overflow: auto;
        padding-top: 10px;
    }
    .shortcuts-bank-item img {
        transition-duration: 0.2s;
        margin: 0 auto
    }
    .shortcuts-bank-item span {
        color: #666 !important
    }
    .shortcuts-bank-item:hover img {
        transform: scale(0.8);
    }
    .shortcuts-bank-item:hover span {
        color: #bf0000 !important;
        text-decoration: underline
    }
    /* width */
    ::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    background: #f1f1f1; 
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #555; 
    }


</style>

@endpush

@section('content')

    <div class="d-flex flex-column flex-root">
        <div style="background-image: url('{{ asset('/') }}assets/media/bg/bg-9.jpg'); margin-top: -50px; margin-bottom: -30px" class="login login-4 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid" id="kt_login">
            <!--begin::Aside-->
            <div class="col-md-12 login-aside d-flex flex-column flex-row-auto">
                <!--begin::Aside Top-->
                <div class="login-form text-center p-7 position-relative overflow-hidden bgi-no-repeat" style="background-image: url('{{ asset('/') }}assets/media/bg/bg-3.jpg'); height: 400px; margin: 70px auto;border-radius: 10px">
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>My PAS Online</h3>
                            <div class="text-muted font-weight-bold">Silahkan login untuk menggunakan aplikasi ini</div>
                        </div>
                        <div id="error" class="alert alert-danger hide"><strong>Gagal! </strong>Tidak dikenali</div>
                        <form action="{{ URL::to('/') }}" class="form" id="login-form">
                            <div class="form-group mb-5 nik">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="NIK bagian belakang" name="nik" autocomplete="off" autofocus />
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block"></div>
                                </div>
                            </div>
                            <div class="form-group mb-5 password">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block"></div>
                                </div>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                <div class="checkbox-inline">
                                    <label class="checkbox m-0 text-muted">
                                    <input type="checkbox" name="remember" />
                                    <span></span>Remember me</label>
                                </div>
                                <a href="javascript:" id="kt_login_forgot" class="text-muted text-hover-primary">Forget Password ?</a>
                            </div>
                            <button type="submit" id="submitButton" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"></div>
                
                {{-- Show all shortcut --}}
                <div id="shortcuts-bank" class="card card-custom card-stretch gutter-b position-absolute">
                    <div class="card-body pt-3 pb-0">
                        <div class="input-group input-group-lg input-group-solid my-2">
                            <div class="input-group-append">
                                <span class="input-group-text pr-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                            </div>
                            <input id="shortcuts-search" type="text" class="form-control pl-4" placeholder="Search...">
                        </div>
                        <div class="d-flex flex-row text-center flex-wrap shortcuts-bank-container">
                            @foreach($shortcuts as $shortcut)
                                <a href="{{ $shortcut->link }}" target="_blank" class="col-md-2 mb-5 shortcuts-bank-item">
                                    <div class="symbol symbol-40 symbol-light-warning" style="width: 100%">
                                        <img src="{{ asset('/') }}assets/media/icons/{{ $shortcut->icon }}" alt="Onlineform">
                                    </div>
                                    <span class="text-dark font-size-lg link" style="white-space: normal">{{ $shortcut->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Body-->
                </div>

                <div class="card card-custom mb-5" style="background-color: rgba(255,255,255,0.6)">
                    <div class="card-body py-3 pl-5 pr-0 d-flex flex-row">
                        <div class="col-1"></div>
                        <div class="col-10 d-flex justify-content-center align-items-center flex-wrap">
                            <div id="shortcut-container" class="d-flex flex-wrap mr-3">
                                @foreach($shortcuts as $shortcut)
                                    <a href="{{ $shortcut->link }}" class="d-flex align-items-center shortcut-item pr-5" target="_blank">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-warning mr-5">
                                            <img src="{{ asset('/') }}assets/media/icons/{{ $shortcut->icon }}" alt="Onlineform">
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="text d-flex flex-column font-weight-bold">
                                            <span class="text-dark font-size-lg link">{{ $shortcut->title }}</span>
                                            <span class="text-muted">{{ substr(str_replace('http://', '', $shortcut->link), 0, 12) }}..</span>
                                        </div>
                                        <!--end::Text-->
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-1">
                            <div id="show-all-shortcut" class="text-right">
                                <a onClick="toggleShortcutsBank()" href="javascript:" class="btn btn-secondary btn-show-all">
                                    <i class="fa fa-th pr-0"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')

    <script type="text/javascript">

        jQuery.fn.animateAuto = function(prop, speed, callback){
            var elem, height, width;
            return this.each(function(i, el){
                el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("#shortcut-container");
                height = elem.css("height"),
                width = elem.css("width"),
                elem.remove();
            
                if(prop === "height")
                    el.animate({"height":height}, speed, callback);
                else if(prop === "width")
                    el.animate({"width":width}, speed, callback);  
                else if(prop === "both")
                    el.animate({"width":width,"height":height}, speed, callback);
            });  
        }

        $('.shortcut-item').hover(function() {
            $('.shortcut-item').stop().animate({width: '50px'}, {duration: 300})
            $(this).stop().animateAuto('width', 300)
            // $('.shortcut-item').removeClass('shortcut-item-hover');
            // $(this).addClass('shortcut-item-hover');
            return false;
        })

        function toggleShortcutsBank()
        {
            $('#shortcuts-bank').fadeToggle();
            $('#shortcuts-search').focus();
        }

        function showError() {
            $('#error').slideDown();
            setTimeout(function () {
                $('#error').slideUp();
            }, 2000);
        }

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
                    if(error.status == 200) {
                        location.reload();
                    }else if(error.status == 401) {
                        showError();
                        $('#submitButton').removeAttr('disabled');
                        $('#submitButton').removeClass('spinner spinner-left pl-15');
                    }else{
                        $('#submitButton').removeAttr('disabled');
                        $('#submitButton').removeClass('spinner spinner-left pl-15');
                        // console.log(error);
                        $.each(error.responseJSON.errors, function (key, val) {

                            $('.' + key).addClass('has-danger');
                            $('.' + key + ' input').addClass('is-invalid');

                            $.each(val, function (_key,error) {
                                $('.' + key + ' .fv-help-block').text(error +'\n');
                            })

                        });
                    }
                }
            });
        });
    </script>

@endpush