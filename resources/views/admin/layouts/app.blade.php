<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Latest updates and statistic charts"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Match')</title>

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
    </script>
    <!--end::Web font -->

    
    <!--begin::Base Styles -->
    <link href="/assets/css/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="/images/icon.png" /> 
    <!-- Styles -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<!-- end::Head -->

    
<!-- begin::Body -->
<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        

    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/admin/matches" class="m-brand__logo-wrapper">
                                <img alt="" src="/images/logo.png" style="width:100%; height:100%;"/>
                            </a>  
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                <span></span>
                            </a>
                            <!-- END -->

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->

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

                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">


                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-topbar__userpic">
                                            <img src="/images/user.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                        </span>
                                        <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                            <span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
                                        </span>
                                        <span class="m-topbar__username m--hide">Nick</span>                    
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center">
                                                <div class="m-card-user m-card-user--skin-light">
                                                    <div class="m-card-user__pic">
                                                        <img src="/images/user.png" class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">{{ auth()->user()->name }}</span>
                                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ auth()->user()->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">تسجيل الخروج</a>
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

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">    
            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" 
                class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
                m-menu-vertical="1"
                m-menu-scrollable="0" m-menu-dropdown-timeout="500"  
                >       
                <ul class="m-menu__nav ">

                    <li class="m-menu__section m-menu__section--first">
                        <i class="m-menu__section-icon flaticon-more-v2"></i>
                        <h4 class="m-menu__section-text">الأقسام</h4>
                    </li>

                    @if(auth()->user()->can('READ_MATCHES'))
                    <li class="m-menu__item  m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/matches') !== false ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/admin/matches?date={{ date('Y-m-d') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-text">المباريات</span>
                        </a>
                    </li>
                    @endif
                    
                    @if(auth()->user()->can('READ_LEAGUES'))
                    <li class="m-menu__item  m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/leagues') !== false ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/admin/leagues" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-text">البطولات</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_CHANNELS'))
                    <li class="m-menu__item  m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/channels') !== false ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/admin/channels" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-text">القنوات</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_SERVERS') || auth()->user()->can('READ_SERVER_TYPES'))
                    <li class="m-menu__item  m-menu__item--submenu m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/servers') !== false ? '--active m-menu__item--open' : '' }}" aria-haspopup="true" >
                        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-layers"></i>
                            <span class="m-menu__link-text">السيرفرات</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu ">
                            <span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                @if(auth()->user()->can('READ_SERVER_TYPES'))
                                <li class="m-menu__item {{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/servers-types') !== false ? 'm-menu__item--active' : '' }}" aria-haspopup="true" >
                                    <a  href="/admin/servers-types" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">انواع السيرفرات</span>
                                    </a>
                                </li>
                                @endif
                                @if(auth()->user()->can('READ_SERVERS'))
                                <li class="m-menu__item {{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/servers') !== false && stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/servers-types') === false ? 'm-menu__item--active' : '' }}" aria-haspopup="true" >
                                    <a  href="/admin/servers" class="m-menu__link ">
                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                            <span></span>
                                        </i>
                                        <span class="m-menu__link-text">السيرفرات</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(auth()->user()->can('READ_ADMINS'))
                    <li class="m-menu__item  m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/admins') !== false ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/admin/admins" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-text">المديرين</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->can('UPDATE_ADSENSES'))
                    <li class="m-menu__item  m-menu__item{{ stripos(strtolower($_SERVER['REQUEST_URI']), 'admin/adsenses') !== false ? '--active' : '' }}" aria-haspopup="true" >
                        <a  href="/admin/adsenses" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-text">الاعلانات</span>
                        </a>
                    </li>
                    @endif
                    
                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside --> 

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
                            
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">@yield('title')</h3>          
                    </div>
                    
                    <div>
                        
                    </div>
                </div>
            </div>
            <!-- END: Subheader --> 
                        
            <div class="m-content">
            @yield('content')
            </div>

        </div>
                

    </div>
    <!-- end:: Body -->

            
    <!-- begin::Footer -->
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <span class="m-footer__copyright">
                        <?php echo date("Y"); ?> &copy <a href="#" class="m-link">كورة لايف</a>
                    </span>
                </div>  
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                    
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->        
        

</div>
<!-- end:: Page -->

        
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!--begin::Base Scripts -->        
<script src="/assets/js/vendors.bundle.js" type="text/javascript"></script>
<script src="/assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->   
 
        
<!--begin::Page Snippets --> 
 <script src="/assets/js/dashboard.js" type="text/javascript"></script>
<!--end::Page Snippets -->   

<script src="/assets/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

@yield('scripts')

                
</body>
<!-- end::Body -->
</html>










































