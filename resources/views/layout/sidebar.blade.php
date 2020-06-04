<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
        <!-- BEGIN: Aside Menu -->
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                @if (Auth::user()->user_type == 'admin') {
                <li class="m-menu__item  @if(isset($sidebar_dashboard)) m-menu__item--active @endif" aria-haspopup="true">
                    <a href="{{ asset('/')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Dashboard
                                </span>
                            </span>
                        </span>
                    </a>
                </li>

                <li class="m-menu__item  @if(isset($sidebar_channel)) m-menu__item--active @endif" aria-haspopup="true">
                    <a href="{{ asset('channel')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-imac"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Channel
                                </span>
                            </span>
                        </span>
                    </a>
                </li>

                <li class="m-menu__item  @if(isset($sidebar_content)) m-menu__item--active @endif" aria-haspopup="true">
                    <a href="{{ asset('content')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-symbol"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Content
                                </span>
                            </span>
                        </span>
                    </a>
                </li>

                @endif
            </ul>
        </div>
        <!-- END: Aside Menu -->
    </div>
