<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->

    <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
{{--                <li class="kt-menu__item " aria-haspopup="true">--}}
{{--                    <a href="javascript:;" class="kt-menu__link ">--}}
{{--                        <img src="{{ asset('media/logos/logo.png') }}" alt="Logo" width="70px">--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="kt-menu__item" aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link"><span class="kt-menu__link-text kt-font-success">PT. AIR MINUM GIRI MENANG (PERSERODA)</span> </a>

                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth()->user()->nama }}</span>
                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ strtoupper(substr(auth()->user()->nama,0,1)) }}</span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('media/misc/bg-1.jpg') }})">
                    <div class="kt-user-card__avatar">
                       <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ strtoupper(substr(auth()->user()->nama,0,1)) }}</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{ auth()->user()->nama }}
                    </div>
                    <div class="kt-user-card__badge" onclick="document.getElementById('frm-logout').submit();">
                        <span class="btn btn-danger btn-sm btn-bold btn-font-md">Sign Out</span>
                    </div>
                </div>

                <!--end: Head -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
