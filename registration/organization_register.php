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
		<title>Organization Register</title>
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
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													<!-- Header -->
													Register as Organisation
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
													<form class="m-form m-form--fit m-form--label-align-right auth coach">
														<div class="form-group m-form__group p-0">
															<input class="form-control m-input" type="hidden" value="coach" name="profession" required>
														</div>
														<div class="m-portlet__body p-0">
															<div class="form-group m-form__group row">
																<div class="col-12">
																	<input class="form-control m-input" type="text" value="Contact No" name="contact" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-4">
																	<input class="form-control m-input" type="email" placeholder="Secondary Email" name="secondEmail" required>
																</div>
																<div class="col-4">
																	<input class="form-control m-input" type="text" placeholder="Mobile No" name="mobileNumber" required>
																</div>
																<div class="col-4">
																	<input class="form-control m-input" type="text" placeholder="Website URL" name="websiteUrl" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="number" placeholder="Total Experience of Coaching" name="experience" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Correspondence Address" name="address" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Name of Organizer" name="organizerName" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Organizer Email" name="organizerEmail" required>
																</div>
															</div>

															<div class="form-group m-form__group row">
																<label for=""  class="col-5 col-form-label text-left">Registration No (Public Trust or Society Reg No.):</label>
																<div class="col-11 custom-file" style="margin-left: 15px">
																	<input type="file" name="registrationNumber" class="custom-file-input" id="customFile2" accept="image/jpeg,image/png,application/pdf" required="">
																	<label class="custom-file-label" for="customFile2">Choose file (JPG,PNG,PDF)</label>
																</div>
															</div>

															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="PAN No" name="panNumber" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Aims & Objectives" name="aims" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-12">
																	List of Office Bearers
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-4">
																	<input class="form-control m-input" type="text" placeholder="Bearers Name" name="bearersName[]" required>
																</div>
																<div class="col-2">
																	<input class="form-control m-input" type="text" placeholder="Contact No" name="bearersNumber[]" required>
																</div>
																<div class="col-2">
																	<input class="form-control m-input" type="text" placeholder="Email Id" name="bearersEmail[]" required>
																</div>
																<div class="col-2">
																	<input class="form-control m-input" type="text" placeholder="PAN No" name="bearersPanNumber[]" required>
																</div>
																<div class="col-2">
																	<input class="form-control m-input" type="text" placeholder="Designation" name="bearersDesignation[]" required>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-12 text-right">
																	<button class="btn btn-success btn-sm">Add More</button>
																</div>
															</div>
															<div class="form-row m-form__group">
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Key Contact Person" name="keyContact" required>
																</div>
																<div class="col-6">
																	<input class="form-control m-input" type="text" placeholder="Contact No" name="keyContactNumber" required>
																</div>
															</div>
															<div class="form-group m-form__group row">
																<label for=""  class="col-5 col-form-label text-left">Logo:</label>
																<div class="col-11 custom-file" style="margin-left: 15px">
																	<input type="file" name="organizationLogo" class="custom-file-input" id="customFile" accept="image/jpeg,image/png,application/pdf" required="">
																	<label class="custom-file-label" for="customFile">Choose file (JPG,PNG,PDF)</label>
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