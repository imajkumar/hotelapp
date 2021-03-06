<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">

      <!-- BEGIN: Brand -->
      <div class="m-stack__item m-brand  m-brand--skin-dark ">
        <div class="m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-stack__item--middle m-brand__logo">
            <a href="/" class="m-brand__logo-wrapper">
              <img src="https://s3.ap-south-1.amazonaws.com/cdnmaster/hotel/logo.png" width="35px">
            </a>
          </div>
          <div class="m-stack__item m-stack__item--middle m-brand__tools">
            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
              <span></span>
            </a>

            <!-- BEGIN: Topbar Toggler -->
            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
              <i class="flaticon-more"></i>
            </a>

            <!-- BEGIN: Topbar Toggler -->
          </div>
        </div>
      </div>

      <!-- END: Brand -->
      <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

        <!-- BEGIN: Horizontal Menu -->
        <?php
        $user = auth()->user();
        $userRoles = $user->getRoleNames();
        $user_role = $userRoles[0];
        if($user_role=='Admin'){
          $panel_text="Administrator Dashboard";
        }
        if($user_role=='Client'){
          $panel_text="Client Dashboard";
        }
        if($user_role=='SalesUser'){
          $panel_text="Sales Dashboard";
        }
         ?>
        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
          <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i
                 class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">
                 {{$panel_text}} | Welcome ! <strong>{{ Auth::user()->name}}</strong>
                 </span></a>

            </li>

          </ul>
        </div>

        <!-- END: Horizontal Menu -->

        <!-- BEGIN: Topbar -->
        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
          <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">

              <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
               m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-topbar__userpic">
                    <img src="{{ asset('local/public/img/avatar.jpg') }}" class="m--img-rounded m--marginless" alt="" />
                  </span>
                  <span class="m-topbar__username m--hide">{{Auth::user()->name}}</span>
                </a>
                <div class="m-dropdown__wrapper">
                  <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                  <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center" style="background: url({{ asset('local/public/themes/corex/assets/app/media/img/bg/bg-2.jpg') }}">
                      <div class="m-card-user m-card-user--skin-dark">
                        <div class="m-card-user__pic">
                          <img src="{{ asset('local/public/img/avatar.jpg') }}" class="m--img-rounded m--marginless" alt="" />


                        </div>
                        <div class="m-card-user__details">
                          <span class="m-card-user__name m--font-weight-500">{{Auth::user()->name}}</span>
                          <a href="" class="m-card-user__email m--font-weight-300 m-link">{{Auth::user()->email}}</a>
                        </div>
                      </div>
                    </div>
                    <div class="m-dropdown__body">
                      <div class="m-dropdown__content">
                        <ul class="m-nav m-nav--skin-light">
                          <li class="m-nav__section m--hide">
                            <span class="m-nav__section-text">Section</span>
                          </li>
                          <li class="m-nav__item">
                            <a href="{{route('user.profile')}}" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-profile-1"></i>
                              <span class="m-nav__link-title">
                                <span class="m-nav__link-wrap">
                                  <span class="m-nav__link-text">My Profile</span>
                                  <span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
                                </span>
                              </span>
                            </a>
                          </li>
                          <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-share"></i>
                              <span class="m-nav__link-text">Activity</span>
                            </a>
                          </li>
                          <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-chat-1"></i>
                              <span class="m-nav__link-text">Messages</span>
                            </a>
                          </li>
                          <li class="m-nav__separator m-nav__separator--fit">
                          </li>


                          <li class="m-nav__separator m-nav__separator--fit">
                          </li>
                          <li class="m-nav__item">
                            <a href="{{ route('logout') }}"    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li id="m_quick_sidebar_toggle_" class="m-nav__item">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- END: Topbar -->
      </div>
    </div>
  </div>
</header>

<!-- END: Header -->

<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
