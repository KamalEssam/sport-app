<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        
		<title>@yield('title')</title>
        <meta name="description" content="Latest updates and statistic charts"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

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
	    <link rel="shortcut icon" href="/images/icon.png" /> 
    </head>
    <!-- end::Head -->

    
    <!-- begin::Body -->
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

        
        
  		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
			    <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
			        <div class="m-stack m-stack--hor m-stack--desktop">
			            <div class="m-stack__item m-stack__item--fluid">
			                <div class="m-login__wrapper">

			                    <div class="m-login__logo">
			                        <a href="#">
			                        <img src="/images/logo.png" width="150px">     
			                        </a>
			                    </div>

			                    @yield('content')
			                    
			                </div>
			            </div>

			        </div>
			    </div>

			</div>
		</div>
		<!-- end:: Page -->
                
    </body>
    <!-- end::Body -->
</html>