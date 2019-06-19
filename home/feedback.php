<?php 
session_start();

if (!$_SESSION["loggedIn"]){
	header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Feedback | Tournament Portal</title>
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
		<link href="../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="../../assets/demo/demo3/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../../assets/demo/demo3/base/style.css" rel="stylesheet" type="text/css" />


		<!--RTL version:<link href="../../assets/demo/demo3/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="../../assets/app/media/img/icons/favicon.ico" />

		<script src="../../assets/demo/demo3/base/jquery.min.js"></script>
		<script src="../../assets/demo/demo3/base/scripts.js"></script>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">

						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand m-brand--skin-light">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
									<a href="index.html" class="m-brand__logo-wrapper">
										<img alt="" src="../../assets/app/media/img/logos/logo-chess.gif" style="width: 50px; height: 50px;">
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
										<i class="flaticon-more"></i>
									</a>

									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>

						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark">

							</div>

							<!-- END: Horizontal Menu -->

							<!-- BEGIN: Topbar -->
							<?php
								require_once 'header.php';
							?>
							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>

			<!-- END: Header -->

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4 d-none d-lg-block">
								<?php
									require_once 'leftbar.php';
								?>
							</div>
							
							<!--Pages Section-->
							<div class="col-xl-6 col-lg-8">

              <div class="m-portlet m-portlet--full-height m-portlet--tabs " id="feedbacks">
                <div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon">
												<i class="flaticon-share"></i>
											</span>
											<h3 class="m-portlet__head-text m--font-primary">
												Feedback
											</h3>
										</div>
									</div>
									<div class="m-portlet__head-tools">
										<ul class="m-portlet__nav">
											<li class="m-portlet__nav-item">
												<a href="create.html" class="m-portlet__nav-link btn btn-primary m-btn m-btn--pill m-btn--air">
													<i class="fa fa-plus"></i>
													New
												</a>
											</li>
										</ul>
									</div>
								</div>
                <div class="tab-content">
                  <div class="tab-pane active" id="m_user_profile_tab_1">
                    <form class="m-form m-form--fit m-form--label-align-right">
                      <div class="m-portlet__body">
												<div class="form-group m-form__group row">
													<div class="col-12 ml-auto">
														<div class="m-widget3">
																<div class="m-widget3__item">
																	<div class="m-widget3__header">
																		<div class="m-widget3__user-img">
																			<img class="m-widget3__img" src="../../assets/app/media/img/users/profile_pic.jpg" alt="">
																		</div>
																		<div class="m-widget3__info">
																			<span class="m-widget3__username">
																				Melania Trump
																			</span><br>
																			<span class="m-widget3__time">
																				2 day ago
																			</span>
																		</div>
																		<span class="m-widget3__status m--font-info">
																			Pending
																		</span>
																	</div>
																	<div class="m-widget3__body">
																		<p class="m-widget3__text">
																			Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
																		</p>
																	</div>
																</div>
																<div class="m-widget3__item">
																	<div class="m-widget3__header">
																		<div class="m-widget3__user-img">
																			<img class="m-widget3__img" src="../../assets/app/media/img/users/user_1.jpg" alt="">
																		</div>
																		<div class="m-widget3__info">
																			<span class="m-widget3__username">
																				Lebron King James
																			</span><br>
																			<span class="m-widget3__time">
																				1 day ago
																			</span>
																		</div>
																		<span class="m-widget3__status m--font-brand">
																			Open
																		</span>
																	</div>
																	<div class="m-widget3__body">
																		<p class="m-widget3__text">
																			Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.Ut wisi enim ad minim veniam,quis nostrud exerci tation ullamcorper.
																		</p>
																	</div>
																</div>
																<div class="m-widget3__item">
																	<div class="m-widget3__header">
																		<div class="m-widget3__user-img">
																			<img class="m-widget3__img" src="../../assets/app/media/img/users/user_2.jpg" alt="">
																		</div>
																		<div class="m-widget3__info">
																			<span class="m-widget3__username">
																				Deb Gibson
																			</span><br>
																			<span class="m-widget3__time">
																				3 weeks ago
																			</span>
																		</div>
																		<span class="m-widget3__status m--font-success">
																			Closed
																		</span>
																	</div>
																	<div class="m-widget3__body">
																		<p class="m-widget3__text">
																			Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
																		</p>
																	</div>
																</div>
															</div>
													</div>
												</div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                                                       
							</div>

							<!--Right Aside-->
							<div class="col-xl-3 col-lg-4 d-none d-xl-block">
								<?php
									require_once 'rightbar.php';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2017 &copy; Tournament Portal by <a href="https://keenthemes.com" class="m-link">@amosamissah</a>
							</span>
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">About</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">Privacy</span>
									</a>
								</li>
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">T&C</span>
									</a>
								</li>
								<li class="m-nav__item m-nav__item">
									<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
										<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>

			<!-- end::Footer -->
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">

		</div>

		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

 

		<!-- begin::Quick Nav -->

		<!--begin::Global Theme Bundle -->
		<script src="../../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../../assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->
		<script src="../../assets/demo/default/custom/crud/forms/widgets/bootstrap-markdown.js" type="text/javascript"></script>
	</body>

	<!-- end::Body -->
</html>