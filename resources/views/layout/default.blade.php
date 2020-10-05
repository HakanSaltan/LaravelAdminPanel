
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}

        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Includable CSS --}}
        @yield('styles')
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
        <div>

            @if (config('layout.page-loader.type') != '')
                @include('layout.partials._page-loader')
            @endif

            @include('layout.base._layout')
        </div>
        <script>var HOST_URL = "{{ route('quick-search') }}";</script>

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.js"></script>
        <script src="/js/app.js"></script>
        <script>
            let URL = 'http://localhost:3000';
            let socket = io(URL);
            let varsayilanData = {
                kid: {{ Auth::user()->id }},
                veriler: null
            };
            console.log(socket);

            socket.on('degistiMi', function(data) {
                data = pr(data);
                console.log("DEĞİŞİKLİK VAR");
                console.log(data);
                if (data.veriler && data.veriler.tur === "SAYFA_YENILE") {
                    location.reload();
                }
            });

            function degisiklikYap() {
                console.log("DEĞİŞİKLİK YAPILIYOR");
                let veriler = varsayilanData;
                veriler.veriler = {
                    tur: "SAYFA_YENILE"
                };

                socket.emit("degistir", st(veriler))
            }

            function st(data) {
                return typeof data === "string" ? data : JSON.stringify(data);
            }

            function pr(data) {
                return JSON.parse(data);
            }
        </script>
        @yield('js')

    </body>
</html>

