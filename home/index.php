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
		<title>My Profile | Tournament</title>
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
		<link href="../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="../assets/demo/demo3/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/demo/demo3/base/style.css" rel="stylesheet" type="text/css" />


		<!--RTL version:<link href="../assets/demo/demo3/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="/../assets/app/media/img/icons/favicon.ico" />

		<script src="../assets/demo/demo3/base/jquery.min.js"></script>
		<script src="../assets/demo/demo3/base/scripts.js"></script>
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
										<img alt="" src="../assets/app/media/img/logos/logo-chess.gif" style="width: 50px; height: 50px;">
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
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="
	m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" m-dropdown-persistent="1" id="m_quicksearch" m-quicksearch-mode="dropdown">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon"><i class="flaticon-search-1"></i></span>
											</a>
											<div class="m-dropdown__wrapper" style="z-index: 101;">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner ">
													<div class="m-dropdown__header">
														<form class="m-list-search__form">
															<div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
																</span>
																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
															</div>
														</form>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__scrollable m-scrollable m-scroller" data-scrollable="true" data-height="300" data-mobile-height="200" style="height: 200px; overflow: auto;">
															<div class="m-dropdown__content">
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-badge m-badge m-badge--accent">3</span>
												<span class="m-nav__link-icon"><i class="flaticon-alert-2"></i></span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
														<span class="m-dropdown__header-title">9 New</span>
														<span class="m-dropdown__header-subtitle">User Notifications</span>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
																		Alerts
																	</a>
																</li>
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>
																</li>
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>
																</li>
															</ul>
															<div class="tab-content">
																<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
																	<div class="m-scrollable m-scroller" data-scrollable="true" data-height="250" data-mobile-height="200" style="height: 200px; overflow: auto;">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																					<span class="m-list-timeline__text">12 new users registered</span>
																					<span class="m-list-timeline__time">Just now</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">System shutdown <span class="m-badge m-badge--success m-badge--wide">pending</span></span>
																					<span class="m-list-timeline__time">14 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">New invoice received</span>
																					<span class="m-list-timeline__time">20 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">settled</span></span>
																					<span class="m-list-timeline__time">1 hr</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">System error - <a href="#" class="m-link">Check</a></span>
																					<span class="m-list-timeline__time">2 hrs</span>
																				</div>
																				<div class="m-list-timeline__item m-list-timeline__item--read">
																					<span class="m-list-timeline__badge"></span>
																					<span href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
																					<span class="m-list-timeline__time">7 hrs</span>
																				</div>
																				<div class="m-list-timeline__item m-list-timeline__item--read">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">Production server down</span>
																					<span class="m-list-timeline__time">3 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge"></span>
																					<span class="m-list-timeline__text">Production server up</span>
																					<span class="m-list-timeline__time">5 hrs</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
																	<div class="m-scrollable m-scroller" data-scrollable="true" data-height="250" data-mobile-height="200" style="height: 200px; overflow: auto;">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																					<a href="" class="m-list-timeline__text">New order received</a>
																					<span class="m-list-timeline__time">Just now</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
																					<a href="" class="m-list-timeline__text">New invoice received</a>
																					<span class="m-list-timeline__time">20 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																					<a href="" class="m-list-timeline__text">Production server up</a>
																					<span class="m-list-timeline__time">5 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">New order received</a>
																					<span class="m-list-timeline__time">7 hrs</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">System shutdown</a>
																					<span class="m-list-timeline__time">11 mins</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
																					<a href="" class="m-list-timeline__text">Production server down</a>
																					<span class="m-list-timeline__time">3 hrs</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
																	<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
																		<div class="m-stack__item m-stack__item--center m-stack__item--middle">
																			<span class="">All caught up!<br>No new logs.</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
												<span class="m-nav__link-icon"><i class="flaticon-clipboard"></i></span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
														<span class="m-dropdown__header-title">Quick Actions</span>
														<span class="m-dropdown__header-subtitle">Shortcuts</span>
													</div>
													<div class="m-dropdown__body m-dropdown__body--paddingless">
														<div class="m-dropdown__content">
															<div class="m-scrollable" data-scrollable="false" data-height="380" data-mobile-height="200">
																<div class="m-nav-grid m-nav-grid--skin-light">
																	<div class="m-nav-grid__row">
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-file"></i>
																			<span class="m-nav-grid__text">Generate Report</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-time"></i>
																			<span class="m-nav-grid__text">Add New Event</span>
																		</a>
																	</div>
																	<div class="m-nav-grid__row">
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-folder"></i>
																			<span class="m-nav-grid__text">Create New Task</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-clipboard"></i>
																			<span class="m-nav-grid__text">Completed Tasks</span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="../assets/app/media/img/users/neutral.png" alt="">
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																<img src="../assets/app/media/img/users/neutral.png" alt="">
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																<?php
																echo $_SESSION['user']['fullname'];
																?>
																</span>
																<a href="" class="m-card-user__email m--font-weight-300 m-link">
																<?php
																	echo $_SESSION['user']['email'];
																?>
																</a>
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
																	<a href="profile.html" class="m-nav__link">
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
																	<a href="profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">Activity</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-chat-1"></i>
																		<span class="m-nav__link-text">Messages</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-info"></i>
																		<span class="m-nav__link-text">FAQ</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																		<span class="m-nav__link-text">Support</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="/actions.php?name=logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li id="m_quick_sidebar_toggle" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon"><i class="flaticon-menu-button"></i></span>
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

				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4 d-none d-lg-block">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__pic">
												<div class="m-card-profile__pic-wrapper">
													<img src="../assets/app/media/img/users/neutral.png" alt="" />
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
												<?php
														echo $_SESSION["user"]["fullname"];
												?></a>
												</span>
												<a href="" class="m-card-profile__email m-link">
														<?php
														echo $_SESSION["user"]["email"];
														?></a>
												<div>
													<a href="" class="m-card-profile__icon m-link">
														<i class="m-nav__link-icon flaticon-facebook-logo-button text-info"></i>
													</a>
													<a href="" class="m-card-profile__icon m-link">
														<i class="m-nav__link-icon flaticon-twitter-logo-button text-info"></i>
													</a>
													<a href="" class="m-card-profile__icon m-link">
														<i class="m-nav__link-icon flaticon-linkedin-logo text-info"></i>
													</a>
												</div>
											</div>
										</div>
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides pages">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">Section</span>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-home"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text" data-target="home.html">Home</span>
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text" data-target="profile.html">My Profile</span>
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link" data-target="acount.html">
													<i class="m-nav__link-icon flaticon-user-settings"></i>
													<span class="m-nav__link-text" data-target="account.html">Account Settings</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-trophy"></i>
													<span class="m-nav__link-text" data-target="my-tournaments.html">My Tournaments</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-coins"></i>
													<span class="m-nav__link-text" data-target="past-tournaments.html">Past Tournaments</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-support"></i>
													<span class="m-nav__link-text" data-target="contact-us.html">Contact Us</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-questions-circular-button"></i>
													<span class="m-nav__link-text" data-target="support.html">Support</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-feed"></i>
													<span class="m-nav__link-text" data-target="feedback.html">Feedback</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							
							<!--Pages Section-->
							<div class="col-xl-6 col-lg-8 section">
								
							</div>

							<!--Right Aside-->
							<div class="col-xl-3 col-lg-4 d-none d-xl-block">
								<div class="m-portlet m-portlet--bordered-semi m-portlet--rounded-force">
									<a href="">
										<div class="m-portlet__body p-1 px-2">
											<div class="m-widget19">
												<div class="m-widget19__content">
													<div class="m-widget19__header">
														<div class="m-widget19__user-img">
															<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt="">
														</div>
														<div class="m-widget19__info">
															<span class="m-widget19__username">
<?php
																echo $_SESSION["user"]["fullname"]
?>
															</span><br>
															<span class="m-widget19__time">
<?php
																echo $_SESSION["user"]["email"]
?>
															</span>
														</div>
														<div class="m-widget19__stats">
															<span class="m-widget19__number m--font-brand">
																<i class="fa fa-football-ball"></i>
															</span>
															<span class="m-widget19__comment">
<?php
																echo $_SESSION["user"]["profession"]
?>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="m-portlet">
									<div class="m-portlet__body">
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__item">
												<a href="/home" class="m-nav__link">
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">All Friends</span>
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">Section</span>
											</li>
											<li class="m-nav__item">
												<a href="header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text" data-target="profile.html"></span>
														</span>
													</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
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
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close"><i class="la la-close"></i></span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">Messages</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">Settings</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">Logs</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__messages m-scrollable">
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="../assets/app/media/img//users/profile_pic.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Hi Bob. What time will be the meeting ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Hi Megan. It's at 2.30PM
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="../assets/app/media/img//users/profile_pic.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Will the development team be joining ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes sure. I invited them as well
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">2:30PM</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="../assets/app/media/img//users/profile_pic.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. For the Coca-Cola Mobile App project as well ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes, sure.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Please also prepare the quotation for the Loop CRM project as well.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">3:15PM</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-no-pic m--bg-fill-danger">
											<span>M</span>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. I will prepare it.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Thanks Megan. I will see you later.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="../assets/app/media/img//users/profile_pic.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Sure. See you in the meeting soon.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="m-messenger__seperator"></div>
							<div class="m-messenger__form">
								<div class="m-messenger__form-controls">
									<input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
								</div>
								<div class="m-messenger__form-tools">
									<a href="" class="m-messenger__form-attachment">
										<i class="la la-paperclip"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_quick_sidebar_tabs_settings" role="tabpanel">
						<div class="m-list-settings m-scrollable">
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">General Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Email Notifications</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Site Tracking</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">SMS Alerts</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Storage</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">System Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">System Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Error Reporting</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Applications Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Servers</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
						<div class="m-list-timeline m-scrollable">
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									System Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered <span class="m-badge m-badge--warning m-badge--wide">important</span></a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoice received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89% <span class="m-badge m-badge--success m-badge--wide">resolved</span></a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error</a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down <span class="m-badge m-badge--danger m-badge--wide">pending</span></a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Applications Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--info m-badge--wide">urgent</span></a>
										<span class="m-list-timeline__time">7 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered</a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoices received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89%</a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error <span class="m-badge m-badge--info m-badge--wide">pending</span></a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down</a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Server Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received</a>
										<span class="m-list-timeline__time">7 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered</a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoice received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89%</a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error</a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down</a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received</a>
										<span class="m-list-timeline__time">1117 hrs</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

 

		<!-- begin::Quick Nav -->

		<!--begin::Global Theme Bundle -->
		<script src="../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->
		<script src="../assets/demo/default/custom/crud/forms/widgets/bootstrap-markdown.js" type="text/javascript"></script>
	</body>

	<!-- end::Body -->
</html>