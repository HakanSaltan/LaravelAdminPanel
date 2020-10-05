<!DOCTYPE html>
<html lang="tr">
<head>
    <base href="">
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('baslik')</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ URL::asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/plugins/global/plugins.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/style.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{URL::asset('assets/media/logos/favicon.ico')}}" />
    @yield('css')

</head>

<body id="kt_body" style="background-image: url({{URL::asset('assets/media/bg/bg-10.jpg')}})" class="page-loading-enabled page-loading quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled aside-enabled aside-static page-loading">
    <!--begin::Main Mainin-->
    @include('layouts.partials._page-loader')
    @include('layouts.partials._header-mobile')
    <div class="d-flex flex-column flex-root">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
        <!--begin::Page-->
        <div id="app" class="d-flex flex-row flex-column-fluid page">

            <!--begin::Wrapper-->
            <div  class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.partials._header')

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @include('layouts.partials._subheader')
                    @include('layouts.partials._content')
                </div>
                <!--end::Content-->
                @include('layouts.partials._footer.compact')
            </div>

            <!--end::Wrapper-->
        </div>

        <!--end::Page-->
    </div>

    <!--end::Main-->



    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <script src="{{URL::asset('assets/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/js/scripts.bundle.js?v=7.0.5')}}"></script>
    <script src="{{URL::asset('assets/js/pages/widgets.js?v=7.0.5')}}"></script>
    <script>
    var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#6993FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1E9FF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };

    </script>
    <!-- VUE JS-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-content-loader@0.2.3/dist/vue-content-loader.min.js"></script>
    <!-- END VUE JS-->
    @yield('js')

</body>
</html>
