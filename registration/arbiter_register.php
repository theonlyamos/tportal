<?php

session_start();

require_once '../functions.php';

if ($_POST){
	$username = sanitizeString($_POST["username"]);
	$dob = $_POST["dob"];
	$gender = sanitizeString($_POST["gender"]);
	$phone = sanitizeString($_POST["phone"]);
	$city = sanitizeString($_POST["city"]);
	$state = sanitizeString($_POST["state"]);
	$country = sanitizeString($_POST["country"]);
	$adhar = sanitizeString($_POST["adhar"]);
	$pan = sanitizeString($_POST["pan"]);
	$cell = sanitizeString($_POST['cell']);
	$profession = sanitizeString($_POST['profession']);
	$address = sanitizeString($_POST['address']);
	$email = $_SESSION['user']['email'];

	$experience = sanitizeString($_POST["experience"]);
	$type = sanitizeString($_POST["type"]);
	$fideid = sanitizeString($_POST["fideid"]);
	$fiderating = sanitizeString($_POST["fiderating"]);
	$id = $_SESSION['user']['id'];

	$query = "UPDATE users SET profession='$profession',username='$username',dob='$dob',gender='$gender',type='$type',
	address='$address',state='$state',city='$city',cell='$cell',phone='$phone',adhar='$adhar',pan='$pan',
	fideid='$fideid',fiderating='$fiderating',experience='$experience', completed=TRUE WHERE id='$id'";

	if (queryDB($query)){
		$fullname = $_SESSION['user']['fullname'];
		setLog('user', $id, "$fullname registered as $profession", "user");
		$result = queryDB("SELECT * FROM users WHERE email = '$email'");
		$user = $result->fetch_array(MYSQLI_ASSOC);
		header("Location: /home");
		$_SESSION['user'] = $user;
	}
	else {
		setLog('user', $id, $email." update unsuccessful.", "user");
		$_SESSION['errMsg'] = "Error updating User. Try Again!";
	}

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
		<title>Arbiter Register</title>
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
						<div class="row">
							  <div class="col-xl-12">
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													<!-- Header -->
													Register as Arbiter
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">

										<!--Begin::Tab Content-->
										<div class="tab-content">

											<!--begin::tab 1 content-->
											<div class="tab-pane active" id="m_widget11_tab1_content">

												<!--begin::Widget 11-->
												<div class="m-widget11">
													<form class="m-form m-form--fit m-form--label-align-right auth arbiter" action="arbiter_register.php" method="post">
														<div class="m-portlet__body p-0">
<?php
$fullname = $_SESSION['user']['fullname'];
$email = $_SESSION['user']['email'];
echo <<< _END
					<div class="form-group m-form__group row">
						<label for="example-text-input" class="col-2 col-form-label text-left">Fullname</label>
						<div class="col-10">
							<input class="form-control m-input bg-secondary" type="text" value="$fullname" name="name" readonly>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label for="example-text-input" class="col-2 col-form-label text-left">Email</label>
						<div class="col-10">
							<input class="form-control m-input bg-secondary" type="text" value="$email" name="email" readonly>
						</div>
					</div>
_END;
?>
															<div class="form-group m-form__group p-0">
																<input class="form-control m-input" type="hidden" value="arbiter" name="profession" required>
															</div>
															<div class="form-group m-form__group row">
																<label for="example-text-input" class="col-2 col-form-label text-left">Username</label>
																<div class="col-10">
																	<input class="form-control m-input" type="text" value="" name="username", required>
																</div>
															</div>
															<div class="form-group m-form__group row">
																<label for="example-tel-input" class="col-2 col-form-label text-left">Date of Birth</label>
																<div class="col-10">
																	<input class="form-control m-input" type="date" value="" name="dob" required>
																</div>
															</div>
															<div class="m-form__group form-group row align-items-center">
																<label for="gender" class="col-2 col-form-label">Gender</label>
																<div class="m-radio-inline col-10">
																	<label class="m-radio">
																		<input type="radio" name="gender" value="male" required> Male
																		<span></span>
																	</label>
																	<label class="m-radio">
																		<input type="radio" name="gender" value="female" required> Female
																		<span></span>
																	</label>
																</div>
															</div>
															<div class="m-form__group form-group row align-items-center">
																<label for="" class="col-2 col-form-label text-left">Type of Arbiter</label>
																<div class="col-10">
																	<select name="type" id="" class="form-control" required>
																		<option selected></option>
																		<option value="national">National Arbiter</option>
																		<option value="international">International Arbiter</option>
																	</select>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Cell No" name="cell" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Phone No" name="phone" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-5">
																	<input class="form-control m-input" type="text" placeholder="Total Experience" name="experience" required>
																</div>
																<div class="col-7">
																	<input class="form-control m-input" type="text" placeholder="Correspondence Address" name="address" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="State" name="state" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="City" name="city" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Adhar Card No" name="adhar" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="PAN No" name="pan" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Fide Id" name="fideid" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Fide Rating" name="fiderating" required>
																</div>
															</div>

															<div class="form-group m-form__group text-center">
																<div class="m-login__form-action">
																	<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--square m-btn--custom m-btn--air  m-login__btn m-login__btn--primary btn-primary">Submit</button>&nbsp;&nbsp;
																	<button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--square m-btn--custom m-login__btn btn-danger">Cancel</button>
																</div>
															</div>
														</div>
													</form>
												</div>

												<!--end::Widget 11-->
											</div>
										</div>

										<!--End::Tab Content-->
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

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>