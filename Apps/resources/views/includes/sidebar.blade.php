<!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('dashboard') }}">
                <img alt="Logo" src="{{ asset('media/logos/logo-light-pdam.png') }}" />
{{--                <h1 class="text-white kt-hidden-mobile">E-SPPD</h1>--}}
            </a>
        </div>
        <div class="kt-aside__brand-tools">
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="{{ route('dashboard') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Dashboard</span></a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Aplikasi</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                @php
                    $currentUrl = Request::path();

                    function renderSubMenu($value, $currentUrl) {
                        $subMenu = '';
                        $GLOBALS['sub_level'] += 1 ;
                        $GLOBALS['active'][$GLOBALS['sub_level']] = '';
                        $currentLevel = $GLOBALS['sub_level'];
                        foreach ($value as $key => $menu) {
                            $GLOBALS['subparent_level'] = '';

                            $subSubMenu = '';
                            $hasSub = (!empty($menu['sub_menu'])) ? 'kt-menu__item--submenu' : '';
                            $hasCaret = (!empty($menu['sub_menu'])) ? '<i class="kt-menu__ver-arrow la la-angle-right"></i>' : '';
                            $hasTitle = (!empty($menu['title'])) ? $menu['title'] : '';

                            if (!empty($menu['sub_menu'])) {
                                $subSubMenu .= '<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>';
                                $subSubMenu .= '<ul class="kt-menu__subnav">';
                                $subSubMenu .= renderSubMenu($menu['sub_menu'], $currentUrl);
                                $subSubMenu .= '</ul></div>';
                            }

                            $active = (Request::is($menu['url']) ? ' kt-menu__item--active kt-menu__item--open' : (Request::is($menu['url'].'/*') ? 'kt-menu__item--active kt-menu__item--open' :'')) ;

                            if ($active) {
                                $GLOBALS['parent_active'] = true;
                                $GLOBALS['active'][$GLOBALS['sub_level'] - 1] = true;
                            }
                            if (!empty($GLOBALS['active'][$currentLevel])) {
                                $active = 'kt-menu__item--active kt-menu__item--open';
                            }

                            if(auth()->user()->has_permissions()->contains($menu['id']) || auth()->user()->is_admin() ){
                                $GLOBALS['has_submenu'] = true;
                                $subMenu .= '
                                    <li class="kt-menu__item '. $hasSub .' '. $active .'" aria-haspopup="true" '.(!empty($hasSub) ? 'data-ktmenu-submenu-toggle="hover"':'').'>
                                        <a class="kt-menu__link '.(!empty($menu['sub_menu']) ? 'kt-menu__toggle' : '').
                                        '" href="'. (!empty($menu['sub_menu']) ? $menu['url'] : url($menu['url'])) .'">
                                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        <span class="kt-menu__link-text">'.$hasTitle.'</span>
                                        '.$hasCaret.'
                                        </a>
                                        '. $subSubMenu .'
                                    </li>';
                            }
                        }
                        return $subMenu;
                    }

                    $masterMenu = config('constants.menu');
                    foreach ($masterMenu as $key => $menu) {
                        $GLOBALS['parent_active'] = '';
                        $GLOBALS['has_submenu'] = false;

                        $hasSub = (!empty($menu['sub_menu'])) ? 'kt-menu__item--submenu' : '';
                        $hasCaret = (!empty($menu['caret'])) ? '<i class="kt-menu__ver-arrow la la-angle-right"></i>' : '';
                        $hasIcon = (!empty($menu['icon'])) ? $menu['icon'] : '';
                        $hasTitle = (!empty($menu['title'])) ? '<span>'. $menu['title'] .'</span>' : '';

                        $subMenu = '';

                        if (!empty($menu['sub_menu'])) {
                            $GLOBALS['sub_level'] = 0;
                            $subMenu .= '<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>';
                            $subMenu .= '<ul class="kt-menu__subnav">';
                            $subMenu .= renderSubMenu($menu['sub_menu'], $currentUrl);
                            $subMenu .= '</ul></div>';
                        }
                        $active = (Request::is($menu['url']) ? 'kt-menu__item--active kt-menu__item--open' : (Request::is($menu['url'].'/*') ? 'kt-menu__item--active kt-menu__item--open' :'')) ;
                        $active = (empty($active) && !empty($GLOBALS['parent_active'])) ? 'kt-menu__item--active kt-menu__item--open' : $active;
                        if(auth()->user()->has_permissions()->contains($menu['id']) || auth()->user()->is_admin() ){
                            echo '
                                <li class="kt-menu__item '. $hasSub .' '. $active .'" aria-haspopup="true" '.(!empty($hasSub) ? 'data-ktmenu-submenu-toggle="hover"':'').'>
                                    <a class="kt-menu__link '.(!empty($menu['sub_menu']) ? 'kt-menu__toggle' : '').'" href="'. (!empty($menu['sub_menu']) ? $menu['url'] : url($menu['url'])) .'">
                                        <span class="kt-menu__link-icon">'. $hasIcon .'</span>
                                        <span class="kt-menu__link-text">'.$hasTitle.'</span>
                                        '. $hasCaret.'
                                    </a>
                                    '. $subMenu .'
                                </li>
                            ';
                        }
                    }
                @endphp

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
