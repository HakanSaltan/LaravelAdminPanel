{{-- Topbar --}}
<div class="topbar">

    <!--begin::Search-->
    <div class="topbar-item">
        <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_search_toggle">
            <span class="svg-icon svg-icon-xl svg-icon-primary">

                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>

                <!--end::Svg Icon-->
            </span>
        </div>
    </div>

    <!--begin::User-->
    <div class="topbar-item">
        <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hoşgeldin,</span>
            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{Auth::user()->name}}</span>
            <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                <span class="symbol-label font-size-h5 font-weight-bold"><i class="flaticon-avatar"></i></span>
            </span>
        </div>
    </div>

    <!--end::User-->
</div>
