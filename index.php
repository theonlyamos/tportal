<?php

if ($_SESSION['loggedIn']){
	if ($_SESSION['user']['role'] == 'user'){
		header("Location: /home");
	}
	else if ($_SESSION['user']['profession'] == 'state'){
		header("Location: /state");
	}
}

?>

<!DOCTYPE html>
<html lang="en-UK">
    <head>
        <title>Tournament Portal</title>
		<meta name="charset" content="utf-8">
        <meta name="description" content="User profile view and edit">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="assets/demo/demo3/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/demo3/base/style.css" rel="stylesheet" type="text/css" />


		<!--RTL version:<link href="assets/demo/demo3/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="/assets/app/media/img/icons/favicon.ico" />

		<script src="assets/demo/demo3/base/jquery.min.js"></script>
		<script src="assets/demo/demo3/base/scripts.js"></script>
	</head>
    </head>
    <body>
        <header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200" style="height: auto !important;">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop bg-transparent">

						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo" style="line-height: 7 !important;">
									<a href="/" class="m-brand__logo-wrapper">
										<img alt="" src="assets/app/media/img/logos/logo-chess.gif" style="width: 50px; height: 50px;" />
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">

									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										
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
										<li class="m-nav__item" style="line-height: 6em;">
											<a href="login.html" class="btn btn-sm btn--pill btn-outline-success">
												<span class="m-nav__link-text">Login</span>
											</a>
                                        </li>
                                        <li class="m-nav__item" style="line-height: 6em;">
											<a href="login.html" class=" btn btn-sm btn--pill btn-outline-primary">
												<span class="m-nav__link-text">Register</span>
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
        <div class="landing">
            <section>
				<div class="desc typewriter text-center">
					<strong><h1 class="text-white pb-5" style="font-weight: 600;">Tournament<span class="text-info">Portal</span></h1>
					<h3 class="text-white text-center">Connect with Professionals</h3>
					<h4 class="text-warning text-center" style="text-decoration: underline;"><strong>Play with the best</strong></h4>
				</div>
            </section>
            
			</strong>
        </div>
    </body>
</html>