<?php
session_start();

if (!$_SESSION['loggedIn']) {
	header("Location: /admin/login.php");
}
else if ($_SESSION['user']['role'] != "admin"){
	header("Location: /home");
}

$PAGE_TITLE = "Feedback";

?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php echo $PAGE_TITLE ?> | Tournament Portal</title>
		<meta name="description" content="Latest updates and statistic charts">
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
		<link href="../assets/demo/demo3/base/admin.css" rel="stylesheet" type="text/css" />
		<!--RTL version:<link href="../assets/demo/demo3/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->


		<!--end::Page Vendors Styles -->
		<link rel="shortcut icon" href="../assets/app/media/img/icons/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- BEGIN: Header -->
			<?php require_once 'header.php' ?>
			<!-- END: Header -->

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown " data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<?php require_once "leftmenu.php" ?>
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
									<h3 class="m-subheader__title m-subheader__title--separator">Feedback</h3>
									<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
										<li class="m-nav__item m-nav__item--home">
											<a href="#" class="m-nav__link m-nav__link--icon">
												<i class="m-nav__link-icon flaticon-feed"></i>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<span class="m-nav__link-text">Base</span>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<span class="m-nav__link-text">All feedback</span>
											</a>
										</li>
									</ul>
								</div>
							<div>
								<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
									<span class="m-subheader__daterange-label">
										<span class="m-subheader__daterange-title"></span>
										<span class="m-subheader__daterange-date m--font-brand"></span>
									</span>
									<a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="la la-angle-down"></i>
									</a>
								</span>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
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
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="m_user_profile_tab_1">
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<div class="col-12 ml-auto">
												<div class="m-widget3">
<?php
require_once '../functions.php';

if ($_GET['id']){
	$fid = sanitizeString($_GET['id']);
	$result = queryDB("SELECT feedbacks.id, sender, seen, feedbacks.role, title, message, fullname AS 'name' FROM feedbacks CROSS JOIN admins WHERE (feedbacks.id = '$fid')");

	if ($result->num_rows){
		$feed = $result->fetch_array(MYSQLI_ASSOC);

		echo <<< _END
														<a href="/home/feedback.php?id=$feed[id]">
															<div class="m-widget3__item" data-target="$feed[id]">
																<div class="m-widget3__header">
																	<div class="m-widget3__user-img">
																		<img class="m-widget3__img" src="../../assets/app/media/img/users/admin.png" alt="">
																	</div>
																	<div class="m-widget3__info">
																		<span class="m-widget3__username">
																			$feed[title]
																		</span><br>
																		<span class="m-widget3__time">
																			$feed[name] <span class="m-badge m-badge--info">Admin</span>
																		</span>
																	</div>
																</div>
																<div class="m-widget3__body">
																	<p class="m-widget3__text">
																		$feed[message]
																	</p>
																</div>
															</div>
														</a>
_END;

	}
}
else {
	$result = queryDB("SELECT feedbacks.id, sender, feedbacks.role, seen, title, message, fullname AS 'name' FROM feedbacks CROSS JOIN admins WHERE (admins.id = feedbacks.sender)");

	if ($result->num_rows){
	for ($j = 0; $j < $result->num_rows; ++$j){
		$result->data_seek($j);
		$feed = $result->fetch_array(MYSQLI_ASSOC);

		echo <<< _END
														<a href="/admin/feedback.php?id=$feed[id]">
															<div class="m-widget3__item" data-target="$feed[id]">
																<div class="m-widget3__header">
																	<div class="m-widget3__user-img">
																		<img class="m-widget3__img" src="../../assets/app/media/img/users/admin.png" alt="">
																	</div>
																	<div class="m-widget3__info">
																		<span class="m-widget3__username">
																			$feed[title]
																		</span><br>
																		<span class="m-widget3__time">
																			$feed[name] <span class="m-badge m-badge--info">Admin</span>
																		</span>
																	</div>
_END;
if ($feed['seen']){
		echo <<< _END
																	<span class="m-widget3__status m--font-danger">
																		<span class="m-badge m-badge--metal">read</span>
																	</span>
_END;
}
else {
		echo <<< _END
																	<span class="m-widget3__status m--font-danger">
																		<span class="m-badge m-badge--danger">new</span>
																	</span>
_END;
}
		echo <<< _END
																</div>
																<div class="m-widget3__body">
																	<p class="m-widget3__text">
																		$feed[message]
																	</p>
																</div>
															</div>
														</a>
_END;
		}
	}
}
?>
														</div>
												</div>
											</div>
										</div>
                  </div>
                </div>
              </div>
          </div>
				</div>
			</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			<?php require_once "footer.php" ?>
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
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__messages m-scrollable">
								
							</div>
							<div class="m-messenger__seperator"></div>
							<div class="m-messenger__form">
								<div class="m-messenger__form-controls">
									<input type="text" name="" data-target="" placeholder="Type here..." class="m-messenger__form-input">
								</div>
								<div class="m-messenger__form-tools">
									<a href="" class="m-messenger__form-attachment">
										<i class="la la-paperclip"></i>
									</a>
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

		<!--begin::Global Theme Bundle -->
		<script src="../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="../assets/app/js/dashboard.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/admin.js" type="text/javascript"></script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>