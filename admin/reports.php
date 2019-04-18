<?php
session_start();

if (!$_SESSION['loggedIn'] && $_SESSION['user']['role'] != "admin") {
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Bulk Uploaders | Tournament Portal</title>
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
		<!--begin::Modal-->
    <div class="modal fade modal-light" id="m_modal_sheet" tabindex="-1" role="dialog" aria-labelledby="sheetModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form_sheet" novalidate="novalidate" enctype="multipart/form-data">
						<input type="hidden" name="field" class="form-control m-input" placeholder="" value="sheets" required>
						<input type="hidden" name="name" class="form-control m-input editor-name" placeholder="" value="" required>
						<input type="hidden" name="target" class="form-control m-input editor-target" placeholder="" value="" required>
						<input type="hidden" name="action" class="form-control m-input" placeholder="" value="edit" required>
						<input type="hidden" class="form-control old-particular" placeholder="" value="" required>
						<input type="hidden" class="form-control old-amount" placeholder="" value="" required>
						<input type="hidden" class="form-control old-pan" placeholder="" value="" required>
						<div class="modal-header">
							<h5 class="modal-title" id="tournamentModalTitle">Edit Sheet</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group m-form__group row">
								<div class="col-lg-12 m-form__group-sub">
									<label class="form-control-label">Particular</label>
									<input type="text" name="particular" class="form-control m-input editor-particular" placeholder="" value="">
									<span class="m-form__help">Please enter the name of the particular</span>
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-6 m-form__group-sub">
									<label class="form-control-label">Amount</label>
									<input type="number" name="amount" step="0.01" class="form-control m-input editor-amount" placeholder="" value="">
									<span class="m-form__help">Please enter the price of the particular</span>
								</div>
								<div class="col-lg-6 m-form__group-sub income-only">
									<label class="form-control-label">PAN</label>
									<input type="text" name="pan" class="form-control m-input editor-pan" placeholder="" value="">
									<span class="m-form__help">Please enter the PAN of the particular</span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" id="m_sheet_dismiss" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary m-btn m-btn--air" id="m_sheet_edit"><i class="fa fa-save fa-fw"></i>Save</button>
						</div>
					</form>
        </div>
      </div>
    </div>
    <!--end::Modal-->
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
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown " data-menu-vertical="true" m-menu-dropdown="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="/admin" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">Dashboard</span></a></li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="tournaments.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-trophy"></i><span
									 class="m-menu__link-text">Tournaments</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="users.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-users"></i><span
									 class="m-menu__link-text">Users</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="organizations.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-map"></i><span
									 class="m-menu__link-text">Organizations</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="uploaders.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon fa fa-cloud-upload-alt"></i><span
									 class="m-menu__link-text">Bulk Uploaders</a>
							</li>
							<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="reports.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-pie-chart"></i><span
									 class="m-menu__link-text">Reports</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="feedback.html" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-share"></i><span
									 class="m-menu__link-text">Feedbacks</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="support.html" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-info"></i><span
									 class="m-menu__link-text">Support</span></a>
							</li>
							<li class="m-menu__item  m-menu__item--submenu m-menu__item--bottom-2" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-settings"></i><span
									 class="m-menu__link-text">Settings</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu m-menu__submenu--up"><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent m-menu__item--bottom-2" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Settings</span></span></li>
										<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link m-menu__toggle"><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span
												 class="m-menu__link-text">Profile</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
											<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-computer"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">Pending</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--warning">10</span></span> </span></span></a></li>
													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-signs-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">Urgent</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">6</span></span> </span></span></a></li>
													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">Done</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">2</span></span> </span></span></a></li>
													<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-multimedia-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
																	<span class="m-menu__link-text">Archive</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--info m-badge--wide">245</span></span> </span></span></a></li>
												</ul>
											</div>
										</li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Accounts</span></a></li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Help</span></a></li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Notifications</span></a></li>
									</ul>
								</div>
							</li>
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
								<h3 class="m-subheader__title "></h3>
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
					<div class="m-content row">

						<!--Begin::Section-->
						<!--Datatable Insert-->
						<div class="col-lg-6">
							<div class="m-portlet m-portlet--full-height m-portlet--mobile">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Income Sheet
										</div>
									</div>
								</div>
								<div class="m-portlet__body portal_income">
									<form action="" method="POST" enctype="multipart/form-data" id="income_sheet_form" class="row"  novalidate="novalidate">
										<input type="hidden" name="action" value="sheet" required/>
										<input type="hidden" name="name" value="income" required/>
										<div class="form-group m-form__group col-6">
											<input class="form-control" type="text" name="particular" placeholder="Particular" aria-label="Particular" required/>
										</div>
                    <div class="input-group col-4">
                      <div class="input-group-preppend">
                        <span class="input-group-text">&dollar;</span>
                      </div>
											<input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" aria-label="Amount" required/>
										</div>
                    <div class="form-group m-form__group col-2">
											<input class="form-control" type="text" name="pan" placeholder="PAN" arai-label="PAN"/>
										</div>
										<div class="form-group m-form__group d-flex align-items-end justify-content-end col-12">
											<button type="submit" id="income_sheet_submit" class="btn btn-success m-btn m-btn--air">
                        <i class="fa fa-cogs fa-fw"></i> Generate
                      </button>
										</div>
									</form>
                  <div class="mt-2" style="max-height: 70vh">
                    <table class="table table-hover table-striped table-success sheet-table" id="income_sheet_table">
                      <thead>
                        <tr>
                          <th><b>Particular</b></th>
                          <th><b>Amount</b></th>
                          <th><b>PAN</b></th>
													<th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot class="bg-dark text-white">
												<tr>
													<th><b>Total</b></th>
													<th columnspan="2"><b id="income_sheet_total">0.00</b></th>
													<th></th>
													<th></th>
												</tr>
                      </tfoot>
                    </table>
                  </div>
								</div>
								</div>
						</div>
						<div class="col-lg-6">
							<div class="m-portlet m-portlet--full-height m-portlet--mobile">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<h3 class="m-portlet__head-text">
												Expenditure Sheet
										</div>
									</div>
								</div>
								<div class="m-portlet__body portal_expense">
									<form action="" method="POST" enctype="multipart/form-data" id="expense_sheet_form" class="row"  novalidate="novalidate">
										<input type="hidden" name="action" value="sheet" required/>
										<input type="hidden" name="name" value="expense" required/>
										<div class="form-group m-form__group col-7">
											<input class="form-control" type="text" name="particular" placeholder="Particular" aria-label="Particular" required/>
										</div>
                    <div class="input-group col-5">
                      <div class="input-group-preppend">
                        <span class="input-group-text">&dollar;</span>
                      </div>
											<input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" aria-label="Amount" required/>
										</div>
										<div class="form-group m-form__group d-flex align-items-end justify-content-end col-12">
											<button type="submit" id="expense_sheet_submit" class="btn btn-danger m-btn m-btn--air">
                        <i class="fa fa-cogs fa-fw"></i> Generate
                      </button>
										</div>
									</form>
                  <div class="mt-2" style="max-height: 70vh">
                    <table class="table table-hover table-striped table-danger sheet-table" id="expense_sheet_table">
                      <thead>
                        <tr>
                          <th><b>Particular</b></th>
                          <th><b>Amount</b></th>
													<th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot class="bg-dark text-white">
												<tr>
													<th><b>Total</b></th>
													<th><b id="expense_sheet_total">0.00</b></th>
													<th></th>
												</tr>
                      </tfoot>
                    </table>
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
								2019 &copy; Tournament Portal by <a href="mailto:amosamissah@outlook.com" class="m-link">@amosamissah</a>
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
								<li class="m-nav__item">
									<a href="#" class="m-nav__link">
										<span class="m-nav__link-text">Purchase</span>
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

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

		<!-- begin::Quick Nav -->

		<!-- begin::Quick Nav -->

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