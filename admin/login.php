<?php
require_once '../functions.php';

$errMsg = "";
if ($_POST){
	$email = sanitizeString($_POST['email']);
	$password = sanitizeString($_POST['password']);
	$password = createHash($password, $email);

	$result = queryDB("SELECT * FROM admins WHERE email='$email' AND password='$password'");
	if ($result->num_rows){
		$admin = $result->fetch_array(MYSQLI_ASSOC);
		session_start();
		header("Location: /admin");
		$_SESSION['loggedIn'] = true;
		$_SESSION['user'] = $admin;
	}
	else {
		$errMsg = "Authentication Error!!!";
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
		<title>Login | Tournament Portal</title>
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

		<!--begin::Global Theme Styles -->
		<link href="../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="../assets/demo/demo3/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/demo/demo3/base/style.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="../assets/demo/demo3/media/img/logo/favicon.ico" />

		<script src="../assets/demo/demo3/base/jquery.min.js"></script>
		<script src="../assets/demo/demo3/base/scripts.js"></script>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url('../assets/app/media/img/bg/bg-7.jpg');">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						
						<div class="m-login__logo">
							<a href="/">
								<img src="../assets/app/media/img/logos/logo-chess.gif" style="max-width: 100px; height: auto;">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">Admin Login</h3>
							</div>
							<form class="m-login__form m-form login" action="login.php" method="POST">
<?php
if ($errMsg){
	echo "<div class='alert alert-danger'><strong>$errMsg</strong> Try again</div>";
}
?>
								<input type="hidden" name="profession" value="state">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--focus">
											<input type="checkbox" name="remember"> Remember me
											<span></span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button type="submit" id="admin_login_signin_submit" class="btn btn-focus m-btn m-btn--square m-btn--custom m-btn--air m-login__btn btn-primary">Sign In</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">Forgotten Password ?</h3>
								<div class="m-login__desc">Enter your email to reset your password:</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--square m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">Request</button>&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--square m-btn--custom m-login__btn btn-danger">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Global Theme Bundle -->
		<script src="../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="../assets/snippets/custom/pages/user/stateLogin.js" type="text/javascript"></script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>