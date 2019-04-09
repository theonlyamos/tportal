<?php

session_start();

require_once '../functions.php';

if ($_POST){
	echo json_encode($_POST);

	$fullname = sanitizeString($_POST["fullname"]);
	$username = sanitizeString($_POST["username"]);
	$password = sanitizeString($_POST["password"]);
	$password = createHash($password, $email);
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
	
	$picture = NULL;
	if ($_FILES['picture']){
		$filename = $_FILES['picture']['name'];
		$picture = $email.$filename;
		move_uploaded_file($_FILES['picture']['tmp_name'], "assets/data/profiles/$picture");
	}

	$blindness = sanitizeString($_POST["blindness"]);
	$rating = sanitizeString($_POST["rating"]);
	$fideid = sanitizeString($_POST["fideid"]);
	$fiderating = sanitizeString($_POST["fiderating"]);
	$communication = serialize($_POST["communication"]);
	$id = $_SESSION['user']['id'];

	$medcert = NULL;
	if ($_FILES['medcert']){
		$filename = $_FILES['medcert']['name'];
		$medcert = $email.$filename;
		move_uploaded_file($_FILES['medcert']['tmp_name'], "assets/data/medical/$medcert");
	}

	$query = "UPDATE users SET profession='$profession',username='$username',dob='$dob',gender='$gender',blindness='$blindness',
	address='$address',postal='$postal',state='$state',city='$city',cell='$cell',phone='$phone',adhar='$adhar',rating='$rating',
	fideid='$fideid',fiderating='$fiderating',communication='$communication',picture='$picture',medcert='$medcert',
	completed=TRUE WHERE id='$id'";

	if (queryDB($query)){
		setLog('user', $user['id'], "$fullname registered as $profession", $country);
		$result = queryDB("SELECT * FROM users WHERE email = '$email'");
		$user = $result->fetch_array(MYSQLI_ASSOC);
		header("Location: /home");
		$_SESSION['user'] = $user;
	}
	else {
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
		<title>Player Register</title>
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

				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->

					<!-- END: Subheader -->
					<div class="m-content container">

            			<!--Begin::Section-->
						<div class="row">
							  <div class="col-xl-12">
								  <div class="m-portlet m-portlet--tabs  ">
									  <div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														<!-- Header -->
														Register as Player
													</h3>
												</div>
											</div>
										</div>
									  <div class="tab-content">
										  <div class="tab-pane active" id="m_user_profile_tab_1">
											  <form class="m-form m-form--fit m-form--label-align-right" action="player_register.php" method="post" enctype="multipart/form-data">
													<div class="form-group m-form__group p-0">
															<input class="form-control m-input" type="hidden" value="player" name="profession" required>
														</div>
												  <div class="m-portlet__body">
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
														<div class="form-group m-form__group row">
														  <label for="example-text-input" class="col-2 col-form-label text-left">Username</label>
														  <div class="col-10">
															  <input class="form-control m-input" type="text" value="" name="username", required>
														  </div>
													  </div>
													  <div class="form-group m-form__group row">
														  <label for="example-text-input" class="col-2 col-form-label text-left">Date of Birth</label>
														  <div class="col-10">
															  <input class="form-control m-input" type="date" value="" name="dob", required>
														  </div>
													  </div>
													  <div class="form-group m-form__group row">
														  <label for="example-text-input" class="col-2 col-form-label text-left">Gender: </label>
														  <div class="col-7">
															  <div class="m-radio-inline">
																  <label class="m-radio">
																	  <input type="radio" value="male" name="gender" required> Male
																	  <span></span>
																  </label>
																  <label class="m-radio">
																	  <input type="radio" value="female" name="gender" required> Female
																	  <span></span>
																  </label>
															  </div>
														  </div>
													  </div>

													  <div class="m-form__group form-group row align-items-center">
														  <label for="" class="col-2 col-form-label text-left">Type of Blindness</label>
														  <div class="col-10">
															  <select name="blindness" id="" class="form-control" required>
																  <option value="" selected></option>
																	<option value="partial">Partial</option>
																	<option value="full">Full</option>
															  </select>
														  </div>
													  </div>

													  <div class="form-group m-form__group row">
														  <div class="col-6">
															  <input class="form-control m-input" name="address" type="text" placeholder="Address">
														  </div>
														  <div class="col-6">
															  <input class="form-control m-input" name="postal" type="text" placeholder="Postal Code">
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
															  <input class="form-control m-input" type="text" placeholder="Cell No" name="cell" required>
														  </div>
														  <div class="col-6">
															  <input class="form-control m-input" type="text" placeholder="Phone No" name="phone" required>
														  </div>
													  </div>

													  <div class="form-row m-form__group">
														  <div class="col-6">
															  <input class="form-control m-input" type="text" placeholder="Adhar Card No" name="adhar" required>
														  </div>
														  <div class="col-6">
															  <input class="form-control m-input" name="rating" type="text" placeholder="National Rating">
														  </div>
													  </div>

													  <div class="form-row m-form__group">
														  <div class="col-6">
															  <input class="form-control m-input" type="text" placeholder="Fide ID" name="fideid" required>
														  </div>
														  <div class="col-6">
															  <input class="form-control m-input" type="text" placeholder="Fide Rating" name="fiderating" required>
														  </div>
													  </div>

													  <div class="form-group m-form__group row">
														  <label for="example-text-input" class="col-3 col-form-label text-left">Communication Preference:</label>
														  <div class="col-9">
															  <div class="m-checkbox-inline">
																  <label class="m-checkbox">
																	  <input type="checkbox" value="email" name="communication[]"> Email
																	  <span></span>
																  </label>
																  <label class="m-checkbox">
																	  <input type="checkbox" value="sms" name="communication[]"> SMS
																	  <span></span>
																  </label>
																  <label class="m-checkbox">
																	  <input type="checkbox" value="whatsapp" name="communication[]"> Whatsapp
																	  <span></span>
																  </label>
															  </div>
														  </div>
													  </div>


													  <div class="form-group m-form__group">

														  <label for=""  class="col-2 col-form-label text-left">Image:</label>
														  <div class="col-11 custom-file" style="margin-left: 15px">
															  <input type="file" name="picture" class="custom-file-input" id="customFile" accept="image/jpeg,image/png,image/gif" required="">
															  <label class="custom-file-label" for="customFile">Choose file (JPG,PNG,PDF)</label>
														  </div>

													  </div>
													  <div class="form-group m-form__group">

														  <label for=""  class="col-2 col-form-label text-left">Medical Certificate:</label>
														  <div class="col-11 custom-file" style="margin-left: 15px">
															  <input type="file" name="medcert" class="custom-file-input" id="customFile2" accept="image/jpeg,image/png,application/pdf" required="">
															  <label class="custom-file-label" for="customFile2">Choose file (JPG,PNG,PDF)</label>
														  </div>

													  </div>
												  </div>
												  <div class="m-portlet__foot">
													  <div class="m-form__actions">
														  <div class="row">
															  <div class="col-12 text-center">
																  <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Submit</button>&nbsp;&nbsp;
																  <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
															  </div>
														  </div>
													  </div>
												  </div>
											  </form>
										  </div>
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