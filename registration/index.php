<?php
session_start();

if ($_SESSION['user']['completed']){
  header("Location: /home");
}
if ($_SESSION['user']['profession'] == 'state'){
  header("Location: organization_register.html");
}
?>

<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Registration</title>
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

		<!--RTL version:<link href="../assets/demo/demo3/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->

		<!--begin::Page Vendors Styles -->
		<link href="../assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Page Vendors Styles -->
		<link rel="shortcut icon" href="../assets/app/media/img/icons/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<!-- END: Subheader -->
					<div class="m-content container">

            			<!--Begin::Section-->
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-6">
								<div class="m-form__group form-group row align-items-center">
									<label for="" class="col-4 col-form-label text-left">Choose Profession</label>
									<div class="col-10">
										<select name="profession" id="" class="form-control">
											<option selected></option>
											<option value="player">Player</option>
											<option value="coach">Coach</option>
											<option value="arbiter">Arbiter</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- end:: Body -->
		</div>

		<!-- end:: Page -->

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
		<script src="../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="../assets/app/js/dashboard.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(()=>{
				$("select[name='profession']").on('change', (e)=>{
					window.location = e.target.value+'_register.php';
				})
			})
		</script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>