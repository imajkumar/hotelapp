<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

  <!-- BEGIN: Aside Menu -->
  <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
      <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="#" class="m-menu__link "><i class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">{{Auth::user()->name}}</span>
              <span class="m-menu__link-badge"></span> </span></span></a>
      </li>
              <?php
					    $route_name=AyraHelp::getRouteName();
              //  str_split($route_name,5)
              $user = auth()->user();
              $userRoles = $user->getRoleNames();
              $user_role = $userRoles[0];


							?>
							<?php
							if($route_name=='hotel'){
								$menu_class='m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--hover';
								$menu_style="display: block; overflow: hidden;";
							}else{
								$menu_class='m-menu__item  m-menu__item--submenu';
								$menu_style="";
							}
							?>
              <?php
              if($user_role=='Admin' || $user_role=='Client'){
                ?>
                <li class="{{$menu_class}}" aria-haspopup="true"  m-menu-submenu-toggle="hover">
          								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
          									<i class="m-menu__link-icon flaticon-clipboard"></i>
          									<span class="m-menu__link-text">
          									    Hotel

          									</span>
          									<i class="m-menu__ver-arrow la la-angle-right"></i>
          								</a>
          								<div class="m-menu__submenu " style="{{$menu_style}}">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Clients</span></span></li>
              <li class="m-menu__item " aria-haspopup="true"><a href="{{route('hotel.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                <span class="m-menu__link-text">Hotel List</span>
              </a>
            </li>



            </ul>
          </div>
        </li>
                <?php
              }
              ?>
              <?php
              if($route_name=='room' ){
                $menu_class='m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--hover';
                $menu_style="display: block; overflow: hidden;";
              }else{
                $menu_class='m-menu__item  m-menu__item--submenu';
                $menu_style="";
              }
              ?>
              <?php
              if($user_role=='Admin' || $user_role=='Client'){
                ?>
                <li class="{{$menu_class}}" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                          <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                            <span class="m-menu__link-text">
                                Room

                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                          </a>
                          <div class="m-menu__submenu " style="{{$menu_style}}">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Clients</span></span></li>
              <li class="m-menu__item " aria-haspopup="true"><a href="{{route('room.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                <span class="m-menu__link-text">Room List</span>
              </a>
            </li>



            </ul>
          </div>
        </li>
                <?php
              }
              ?>
<!--skdkfjks-->

              <?php
              if($route_name=='Client'){
                $menu_class='m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--hover';
                $menu_style="display: block; overflow: hidden;";
              }else{
                $menu_class='m-menu__item  m-menu__item--submenu';
                $menu_style="";
              }
              ?>
              <?php
              if($user_role=='Admin'){
                ?>
                <li class="{{$menu_class}}" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                          <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                            <span class="m-menu__link-text">
                                Client

                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                          </a>
                          <div class="m-menu__submenu " style="{{$menu_style}}">
              <span class="m-menu__arrow"></span>
              <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Clients</span></span></li>
              <li class="m-menu__item " aria-haspopup="true"><a href="{{route('client.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                <span class="m-menu__link-text">Client List</span>
              </a>
              </li>



              </ul>
              </div>
              </li>
                <?php
              }
              ?>
<!--skdkfjks-->


<!--skdkfjks-->

              <?php
              if($route_name=='Offers'){
                $menu_class='m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--hover';
                $menu_style="display: block; overflow: hidden;";
              }else{
                $menu_class='m-menu__item  m-menu__item--submenu';
                $menu_style="";
              }
              ?>
              <?php
              if($user_role=='Admin'){
                ?>
                <li class="{{$menu_class}}" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                          <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                            <span class="m-menu__link-text">
                                Offers

                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                          </a>
                          <div class="m-menu__submenu " style="{{$menu_style}}">
              <span class="m-menu__arrow"></span>
              <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Offers</span></span></li>
              <li class="m-menu__item " aria-haspopup="true"><a href="{{route('offers.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                <span class="m-menu__link-text">Offers List</span>
              </a>
              </li>



              </ul>
              </div>
              </li>
                <?php
              }
              ?>
<!--skdkfjks-->




    </ul>
  </div>

  <!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
