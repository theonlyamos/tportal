<?php 
session_start();
$PAGE_ICON = 'flaticon-feed';
$PAGE_TITLE = 'Feedback';
if (!$_SESSION["loggedIn"]){
	header("Location: /login.html");
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
			<?php
          require_once 'header.php';
      ?>
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
								</div>
                <div class="tab-content">
                  <div class="tab-pane active" id="m_user_profile_tab_1">
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<div class="col-12 ml-auto">
													<div class="m-widget3">
<?php
require_once '../functions.php';
$uid = $_SESSION['user']['id'];

if ($_GET['id']){
	$fid = sanitizeString($_GET['id']);
	$result = queryDB("SELECT feedbacks.id, sender, seen, feedbacks.role, title, message, fullname AS 'name' FROM feedbacks CROSS JOIN admins WHERE (feedbacks.id = '$fid' AND admins.id = feedbacks.sender)");

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
	
	if (!$feed['seen']){
		queryDB("UPDATE feedbacks SET seen = TRUE WHERE id = '$fid'");
		setLog('user', $uid, $_SESSION['user']['email']." read feedback: <strong>".$feed['title']."</strong>", $_SESSION['user']['country']);
	}
	}
}
else {
	$result = queryDB("SELECT feedbacks.id, sender, feedbacks.role, seen, title, message, fullname AS 'name' FROM feedbacks CROSS JOIN admins WHERE (admins.id = feedbacks.sender AND userid = '$uid')");

	if ($result->num_rows){
	for ($j = 0; $j < $result->num_rows; ++$j){
		$result->data_seek($j);
		$feed = $result->fetch_array(MYSQLI_ASSOC);
		$message = substr($feed['message'], 0, 100)."...";

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
																		$message
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