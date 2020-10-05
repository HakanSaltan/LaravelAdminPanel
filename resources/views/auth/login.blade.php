<!DOCTYPE html>
<html lang="tr">

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Giriş Yap - OtoGaraj</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{URL::asset('assets/css/pages/login/classic/login-3.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/plugins/global/plugins.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/style.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{URL::asset('assets/media/logos/favicon.ico')}}" />

</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
                style="background-image: url({{URL::asset('assets/media/bg/bg-1.jpg')}});">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{URL::asset('assets/media/logos/loog_beyaz_250.png')}}" class="max-w-100px"
                                alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>SUBUZEM'e Hoş Geldiniz</h3>
                            <p class="opacity-60 font-weight-bold">Hesabınıza giriş yapmak için bilgilerinizi girin:</p>
                        </div>
                        {{-- <form class="form" action="{{ route('login') }}" method="POST" id="kt_login_signin_form">
                        --}}
                        <form class="form" action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                    type="text" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                    type="password" placeholder="Şifre" name="password" />
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                        <input type="checkbox" name="remember" />
                                        <span></span>Beni Hatırla</label>
                                </div>
                            </div>
                            <div class="form-group text-center mt-10">
                                <button type="submit"
                                    class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3">Giriş
                                    Yap</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
    </div>
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <script src="{{URL::asset('assets/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/js/scripts.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/js/pages/custom/login/login-general.js?v=7.0.5')}}"></script>
</body>

</html>
