@if(config('layout.self.layout') == 'blank')
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
@else

    @include('layout.base._header-mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            @if(config('layout.aside.self.display'))
                @include('layout.base._aside')
            @endif

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('layout.base._header')

                <div class="content {{ Metronic::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">

                    @include('layout.partials.subheader._subheader-v4')

                    @include('layout.base._content')

                </div>


            </div>
        </div>
    </div>

@endif
@include('layout.partials.extras._scrolltop')
@include('layout.partials.extras.offcanvas._quick-search')
@include('layout.partials.extras.offcanvas._quick-user')

