<?php
session_start();
$PAGE_ICON = 'flaticon-trophy';
$PAGE_TITLE = 'Tournaments';
if (!$_SESSION["loggedIn"]){
	header("Location: /");
}
?>


<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Tournaments | Tournament Portal</title>
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
							<div class="col-xl-3 col-lg-3 d-none d-lg-block">
								<?php
									require_once 'leftbar.php';
								?>
							</div>
							
							<!--Pages Section-->
							<div class="col-xl-6 col-lg-8">
                
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                  <div class="m-portlet__head">
                      <div class="m-portlet__head-tools">
                          <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                              <li class="nav-item m-tabs__item">
                                  <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                      <i class="flaticon-share m--hide"></i>
                                      Tournaments
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane active p-4" id="m_user_profile_tab_1">
                      <div class="row">

                        <div class="col-12 px-0">

<?php
require_once '../functions.php';
require_once '../countries.php';

if ($_GET['id']){
	$tid = sanitizeString($_GET['id']);
	$uid = $_SESSION['user']['id'];
	
	$result = queryDB("SELECT * FROM posts WHERE type = 'tournament' AND id='$tid'");
	$tournament = $result->fetch_array(MYSQLI_ASSOC);
	$country = $countries[$tournament['country']];
	$registrants = unserialize($tournament['registrants']);
	$num_of_registrants = 0;
	if ($registrants) $num_of_registrants = count($registrants);

	echo <<< _END
								<div class="col-12 px-0 m-tournament">
									<div class="col-md-12 px-0">
										<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
											<div class="m-portlet__head m-portlet__head--fit">
												<div class="m-portlet__head-caption">
													<div class="m-portlet__head-action">
														<button type="button" class="btn btn-sm m-btn--pill  btn-primary"><i class="flaticon-placeholder-2"></i>$country</button>
													</div>
												</div>
											</div>
											<div class="m-portlet__body px-0">
												<div class="m-widget19">
													<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="max-height: 50vh; overflow: hidden;">
														<img src="../assets/app/media/img/bg/chess.png" alt="">
														<h3 class="m-widget19__title m--font-light">
															<i class="fa fa-trophy fa-2x fa-fw text-warning"></i>
															$tournament[title]
														</h3>
														<div class="m-widget19__shadow"></div>
													</div>
													<div class="m-widget19__content">
														<div class="m-widget19__header">
															<div class="m-widget19__user-img">
																<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt="">
															</div>
															<div class="m-widget19__info">
																<span class="m-widget19__username">
																	$tournament[author]
																</span><br>
																<span class="m-widget19__time">
																	$tournament[city]
																</span>
															</div>
															<div class="m-widget19__stats">
																<span class="m-widget19__number m--font-brand">
																	$num_of_registrants									
																</span>
																<span class="m-widget19__comment">
																	Registered
																</span>
															</div>
														</div>
														<div class="m-widget19__body mx-0">
															<table class="table table-striped table-hover table-borderless table-dark col-12 pr-0">
																<tbody>
																	<tr>
																		<th>Description</th>
																		<td>$tournament[description]</td>
																	</tr>
																	<tr>
																		<th>Address</th>
																		<td>$tournament[address]</td>
																	</tr>
																	<tr>
																		<th>Venue</th>
																		<td>$tournament[venue]</td>
																	</tr>
																	<tr>
																		<th>Organizer</th>
																		<td>$tournament[organizerName]</td>
																	</tr>
																	<tr>
																		<th>Organizer Phone</th>
																		<td>$tournament[organizerPhone]</td>
																	</tr>
																	<tr>
																		<th>Organizer Email</th>
																		<td>$tournament[organizerEmail]</td>
																	</tr>
																	<tr>
																		<th>Contact Person</th>
																		<td>$tournament[contactName]</td>
																	</tr>
																	<tr>
																		<th>Contact Phone</th>
																		<td>$tournament[contactPhone]</td>
																	</tr>
																	<tr>
																		<th>Contact Email</th>
																		<td>$tournament[contactEmail]</td>
																	</tr>
																	<tr>
																		<th>Appointed Arbiter</th>
																		<td>$tournament[arbiter]</td>
																	</tr>
																	<tr>
																		<th>Appointed Coach</th>
																		<td>$tournament[coach]</td>
																	</tr>
																	<tr class="bg-secondary text-dark">
																		<th>Start Dates</th>
																		<th>End Dates</th>
																	</tr>
_END;
$startDates = unserialize($tournament['startDates']);
$endDates = unserialize($tournament['endDates']);
for ($k = 0; $k < sizeof($startDates); ++$k){
	echo "<tr><td>".$startDates[$k]."</td><td>".$endDates[$k]."</td></tr>";
}
	echo <<< _END
																<tr class="bg-primary text-white"><th>Price</th><td><b>&dollar;$tournament[price]</b></td></tr>
																</tbody>
															</table>
														</div>
														<div class="m-widget19__action d-flex justify-content-end">
_END;
if (in_array($uid, $registrants)){
	echo <<< _END
															<button class="btn m-btn--pill btn-info m-btn" id="registerTournament" data-target="$tournament[id]" disabled>
																<i class="fa fa-check"></i>
																Registered
															</button>
_END;
}
else {
	echo <<< _END
															<button class="btn m-btn--pill btn-info m-btn" id="registerTournament" data-target="$tournament[id]">
																<i class="fa fa-check-circle"></i>
																Register
															</button>
_END;
}
	echo <<< _END
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
_END;
}
?>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane " id="m_user_profile_tab_2">
                    </div>
                    <div class="tab-pane " id="m_user_profile_tab_3">
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