<?php
session_start();

if (!$_SESSION['loggedIn']) {
	header("Location: /admin/login.php");
}
else if ($_SESSION['user']['role'] != "admin"){
	header("Location: /home");
}

$PAGE_TITLE = "Bulk Uploaders";

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
							<?php require_once 'leftmenu.php' ?>
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
						<div class="m-accordion m-accordion--default m-accordion--toggle-arrow col-12" id="m_accordion_5" role="tablist">

							<!--begin::Item-->
							<div class="m-accordion__item">
								<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_2_head" data-toggle="collapse" href="#m_accordion_5_item_2_body" aria-expanded="false">
									<span class="m-accordion__item-icon"><i class="fa  fa-clipboard-list"></i></span>
									<span class="m-accordion__item-title"><b>FIDE Bulk Upload</b></span>
									<span class="m-accordion__item-mode"></span>
								</div>
								<div class="m-accordion__item-body collapse" id="m_accordion_5_item_2_body" role="tabpanel" aria-labelledby="m_accordion_5_item_2_head" data-parent="#m_accordion_5" style="">
									<div class="m-accordion__item-content">
										<form method="POST" enctype="multipart/form-data" id="bulk_fide_form" class="row"  novalidate="novalidate">
											<input type="hidden" name="action" value="bulk" required/>
											<input type="hidden" name="name" value="fide" required/>
											<div class="form-group m-form__group col-12">
												<div class="custom-file" style="margin-left: 15px">
													<input type="file" name="bulkFile" class="custom-file-input" id="customFile2" accept=".csv,text/csv" required>
													<label class="custom-file-label" for="customFile2">Choose file (CSV)</label>
												</div>
											</div>
											<div class="form-group m-form__group d-flex align-items-end justify-content-end col-12 px-0">
												<button type="submit" id="bulk_fide_submit" class="btn btn-primary m-btn m-btn--air">Upload</button>
											</div>
										</form>
										<div class="m-accordion" id="m_accordion_1" role="tablist">
	<?php
	require_once '../functions.php';

	$result = queryDB("SELECT id, name, type FROM bulk_uploads WHERE type='fide' ORDER BY createdAt DESC");
	if ($result->num_rows){
		$count;
		for ($j = 0; $j < $result->num_rows; ++$j){
			$result->data_seek($j);
			$file = $result->fetch_array(MYSQLI_ASSOC);
			$filename = $file['name'];
			$fileid = $file['id'];
			$filetype = $file['type'];
			$count++;
			echo <<< _END
												<!--begin::Item-->
												<div class="m-accordion__item">
_END;
										echo '<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_'.$count.'_head" data-toggle="collapse" href="#m_accordion_1_item_'.$count.'_body" aria-expanded="false">';
										echo '<span class="m-accordion__item-icon"><i class="fa  flaticon-list-2"></i></span>';
			echo <<< _END
														<span class="m-accordion__item-title">$filename</span>
														<span class="m-accordion__item-mode expand" data-type="$filetype" data-name="$filename" data-target="$fileid"></span>
													</div>
_END;
											echo '<div class="m-accordion__item-body collapse" id="m_accordion_1_item_'.$count.'_body" role="tabpanel" aria-labelledby="m_accordion_1_item_'.$count.'_head" data-parent="#m_accordion_1">';
			echo <<< _END
														<div class="m-accordion__item-content" style="overflow: auto; max-height: 60vh !important;">
															<table class="table table-secondary" data-id="$fileid">
															</table>
														</div>
													</div>
												</div>

												<!--end::Item-->
_END;
		}
	}
	?>
											</div>
									</div>
								</div>
							</div>

							<!--end::Item-->

							<!--begin::Item-->
							<div class="m-accordion__item">
								<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_3_head" data-toggle="collapse" href="#m_accordion_5_item_3_body" aria-expanded="false">
									<span class="m-accordion__item-icon"><i class="fa  fa-clipboard-list"></i></span>
									<span class="m-accordion__item-title"><b>National Rating Bulk Upload</b></span>
									<span class="m-accordion__item-mode"></span>
								</div>
								<div class="m-accordion__item-body collapse" id="m_accordion_5_item_3_body" role="tabpanel" aria-labelledby="m_accordion_5_item_3_head" data-parent="#m_accordion_5" style="">
									<div class="m-accordion__item-content">
									<form method="POST" enctype="multipart/form-data" id="bulk_rating_form" class="row"  novalidate="novalidate">
											<input type="hidden" name="action" value="bulk" required/>
											<input type="hidden" name="name" value="rating" required/>
											<div class="form-group m-form__group col-12">
												<div class="custom-file" style="margin-left: 15px">
													<input type="file" name="bulkFile" class="custom-file-input" id="customFile2" accept=".csv,text/csv" required>
													<label class="custom-file-label" for="customFile2">Choose file (CSV)</label>
												</div>
											</div>
											<div class="form-group m-form__group d-flex align-items-end justify-content-end col-12 px-0">
												<button type="submit" id="bulk_rating_submit" class="btn btn-primary m-btn m-btn--air">Upload</button>
											</div>
										</form>
										<div class="m-accordion" id="m_accordion_1" role="tablist">
	<?php
	require_once '../functions.php';

	$result = queryDB("SELECT id, name, type FROM bulk_uploads WHERE type='rating' ORDER BY createdAt DESC");
	if ($result->num_rows){
		$count;
		for ($j = 0; $j < $result->num_rows; ++$j){
			$result->data_seek($j);
			$file = $result->fetch_array(MYSQLI_ASSOC);
			$filename = $file['name'];
			$fileid = $file['id'];
			$filetype = $file['type'];
			$count++;
			echo <<< _END
												<!--begin::Item-->
												<div class="m-accordion__item">
_END;
										echo '<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_'.$count.'_head" data-toggle="collapse" href="#m_accordion_1_item_'.$count.'_body" aria-expanded="false">';
										echo '<span class="m-accordion__item-icon"><i class="fa  flaticon-list-2"></i></span>';
			echo <<< _END
														<span class="m-accordion__item-title">$filename</span>
														<span class="m-accordion__item-mode expand" data-type="$filetype" data-name="$filename" data-target="$fileid"></span>
													</div>
_END;
											echo '<div class="m-accordion__item-body collapse" id="m_accordion_1_item_'.$count.'_body" role="tabpanel" aria-labelledby="m_accordion_1_item_'.$count.'_head" data-parent="#m_accordion_1">';
			echo <<< _END
														<div class="m-accordion__item-content" style="overflow: auto; max-height: 60vh !important;">
															<table class="table table-secondary" data-id="$fileid">
															</table>
														</div>
													</div>
												</div>

												<!--end::Item-->
_END;
		}
	}
	?>
											</div>
									</div>
								</div>
							</div>

							<!--end::Item-->
						</div>
          </div>
				</div>
			</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			<?php require_once 'footer.php' ?>
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