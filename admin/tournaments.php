<?php
session_start();

if (!$_SESSION['loggedIn']) {
	header("Location: /admin/login.php");
}
else if ($_SESSION['user']['role'] != "admin"){
	header("Location: /home");
}

$PAGE_TITLE = "Tournaments"

?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php $PAGE_TITLE ?> | Tournament Portal</title>
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
		<link href="../assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->
		<link rel="shortcut icon" href="../assets/app/media/img/icons/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!--begin::Modal-->
    <div class="modal fade modal-light" id="m_modal_tournament" tabindex="-1" role="dialog" aria-labelledby="tournamentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50%;">
        <div class="modal-content">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form_tournament" novalidate="novalidate" enctype="multipart/form-data">
						<input type="hidden" name="field" class="form-control m-input" placeholder="" value="tournaments">
						<input type="hidden" name="action" class="form-control m-input" placeholder="" value="post">
						<input type="hidden" name="target" class="form-control m-input" placeholder="" value="">
						<div class="modal-header">
							<h5 class="modal-title" id="tournamentModalTitle">Tournament</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body px-2">
							<div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="200" style="min-height: 70vh; overflow: hidden;">
								<div class="m-portlet">
									<div class="m-portlet__body px-3">
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Title:</label>
												<input type="text" name="title" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the title of the Tournament</span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Organization:</label>
												<input type="text" name="author" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Tournament author</span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Description:</label>
												<div class="md-editor" id="1553185306142">
													<textarea name="description" class="form-control md-input" data-provide="markdown" rows="5" style="resize: none;"></textarea>
													<div class="md-fullscreen-controls"><a href="#" class="exit-fullscreen" title="Exit fullscreen"><span class="fa fa-compress"></span></a></div>
													<span class="m-form__help">Please enter the description of the Tournament</span>
												</div>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Address:</label>
												<input type="text" name="address" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the address of the venue</span>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">City:</label>
												<input type="text" name="city" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the city of the venue</span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Address:</label>
												<select name="country" class="form-control m-input" required>
													<option value="" selected>Select Country</option>
													<option value="AF">Afghanistan</option>
													<option value="AX">Åland Islands</option>
													<option value="AL">Albania</option>
													<option value="DZ">Algeria</option>
													<option value="AS">American Samoa</option>
													<option value="AD">Andorra</option>
													<option value="AO">Angola</option>
													<option value="AI">Anguilla</option>
													<option value="AQ">Antarctica</option>
													<option value="AG">Antigua and Barbuda</option>
													<option value="AR">Argentina</option>
													<option value="AM">Armenia</option>
													<option value="AW">Aruba</option>
													<option value="AU">Australia</option>
													<option value="AT">Austria</option>
													<option value="AZ">Azerbaijan</option>
													<option value="BS">Bahamas</option>
													<option value="BH">Bahrain</option>
													<option value="BD">Bangladesh</option>
													<option value="BB">Barbados</option>
													<option value="BY">Belarus</option>
													<option value="BE">Belgium</option>
													<option value="BZ">Belize</option>
													<option value="BJ">Benin</option>
													<option value="BM">Bermuda</option>
													<option value="BT">Bhutan</option>
													<option value="BO">Bolivia, Plurinational State of</option>
													<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
													<option value="BA">Bosnia and Herzegovina</option>
													<option value="BW">Botswana</option>
													<option value="BV">Bouvet Island</option>
													<option value="BR">Brazil</option>
													<option value="IO">British Indian Ocean Territory</option>
													<option value="BN">Brunei Darussalam</option>
													<option value="BG">Bulgaria</option>
													<option value="BF">Burkina Faso</option>
													<option value="BI">Burundi</option>
													<option value="KH">Cambodia</option>
													<option value="CM">Cameroon</option>
													<option value="CA">Canada</option>
													<option value="CV">Cape Verde</option>
													<option value="KY">Cayman Islands</option>
													<option value="CF">Central African Republic</option>
													<option value="TD">Chad</option>
													<option value="CL">Chile</option>
													<option value="CN">China</option>
													<option value="CX">Christmas Island</option>
													<option value="CC">Cocos (Keeling) Islands</option>
													<option value="CO">Colombia</option>
													<option value="KM">Comoros</option>
													<option value="CG">Congo</option>
													<option value="CD">Congo, the Democratic Republic of the</option>
													<option value="CK">Cook Islands</option>
													<option value="CR">Costa Rica</option>
													<option value="CI">Côte d'Ivoire</option>
													<option value="HR">Croatia</option>
													<option value="CU">Cuba</option>
													<option value="CW">Curaçao</option>
													<option value="CY">Cyprus</option>
													<option value="CZ">Czech Republic</option>
													<option value="DK">Denmark</option>
													<option value="DJ">Djibouti</option>
													<option value="DM">Dominica</option>
													<option value="DO">Dominican Republic</option>
													<option value="EC">Ecuador</option>
													<option value="EG">Egypt</option>
													<option value="SV">El Salvador</option>
													<option value="GQ">Equatorial Guinea</option>
													<option value="ER">Eritrea</option>
													<option value="EE">Estonia</option>
													<option value="ET">Ethiopia</option>
													<option value="FK">Falkland Islands (Malvinas)</option>
													<option value="FO">Faroe Islands</option>
													<option value="FJ">Fiji</option>
													<option value="FI">Finland</option>
													<option value="FR">France</option>
													<option value="GF">French Guiana</option>
													<option value="PF">French Polynesia</option>
													<option value="TF">French Southern Territories</option>
													<option value="GA">Gabon</option>
													<option value="GM">Gambia</option>
													<option value="GE">Georgia</option>
													<option value="DE">Germany</option>
													<option value="GH">Ghana</option>
													<option value="GI">Gibraltar</option>
													<option value="GR">Greece</option>
													<option value="GL">Greenland</option>
													<option value="GD">Grenada</option>
													<option value="GP">Guadeloupe</option>
													<option value="GU">Guam</option>
													<option value="GT">Guatemala</option>
													<option value="GG">Guernsey</option>
													<option value="GN">Guinea</option>
													<option value="GW">Guinea-Bissau</option>
													<option value="GY">Guyana</option>
													<option value="HT">Haiti</option>
													<option value="HM">Heard Island and McDonald Islands</option>
													<option value="VA">Holy See (Vatican City State)</option>
													<option value="HN">Honduras</option>
													<option value="HK">Hong Kong</option>
													<option value="HU">Hungary</option>
													<option value="IS">Iceland</option>
													<option value="IN">India</option>
													<option value="ID">Indonesia</option>
													<option value="IR">Iran, Islamic Republic of</option>
													<option value="IQ">Iraq</option>
													<option value="IE">Ireland</option>
													<option value="IM">Isle of Man</option>
													<option value="IL">Israel</option>
													<option value="IT">Italy</option>
													<option value="JM">Jamaica</option>
													<option value="JP">Japan</option>
													<option value="JE">Jersey</option>
													<option value="JO">Jordan</option>
													<option value="KZ">Kazakhstan</option>
													<option value="KE">Kenya</option>
													<option value="KI">Kiribati</option>
													<option value="KP">Korea, Democratic People's Republic of</option>
													<option value="KR">Korea, Republic of</option>
													<option value="KW">Kuwait</option>
													<option value="KG">Kyrgyzstan</option>
													<option value="LA">Lao People's Democratic Republic</option>
													<option value="LV">Latvia</option>
													<option value="LB">Lebanon</option>
													<option value="LS">Lesotho</option>
													<option value="LR">Liberia</option>
													<option value="LY">Libya</option>
													<option value="LI">Liechtenstein</option>
													<option value="LT">Lithuania</option>
													<option value="LU">Luxembourg</option>
													<option value="MO">Macao</option>
													<option value="MK">Macedonia, the former Yugoslav Republic of</option>
													<option value="MG">Madagascar</option>
													<option value="MW">Malawi</option>
													<option value="MY">Malaysia</option>
													<option value="MV">Maldives</option>
													<option value="ML">Mali</option>
													<option value="MT">Malta</option>
													<option value="MH">Marshall Islands</option>
													<option value="MQ">Martinique</option>
													<option value="MR">Mauritania</option>
													<option value="MU">Mauritius</option>
													<option value="YT">Mayotte</option>
													<option value="MX">Mexico</option>
													<option value="FM">Micronesia, Federated States of</option>
													<option value="MD">Moldova, Republic of</option>
													<option value="MC">Monaco</option>
													<option value="MN">Mongolia</option>
													<option value="ME">Montenegro</option>
													<option value="MS">Montserrat</option>
													<option value="MA">Morocco</option>
													<option value="MZ">Mozambique</option>
													<option value="MM">Myanmar</option>
													<option value="NA">Namibia</option>
													<option value="NR">Nauru</option>
													<option value="NP">Nepal</option>
													<option value="NL">Netherlands</option>
													<option value="NC">New Caledonia</option>
													<option value="NZ">New Zealand</option>
													<option value="NI">Nicaragua</option>
													<option value="NE">Niger</option>
													<option value="NG">Nigeria</option>
													<option value="NU">Niue</option>
													<option value="NF">Norfolk Island</option>
													<option value="MP">Northern Mariana Islands</option>
													<option value="NO">Norway</option>
													<option value="OM">Oman</option>
													<option value="PK">Pakistan</option>
													<option value="PW">Palau</option>
													<option value="PS">Palestinian Territory, Occupied</option>
													<option value="PA">Panama</option>
													<option value="PG">Papua New Guinea</option>
													<option value="PY">Paraguay</option>
													<option value="PE">Peru</option>
													<option value="PH">Philippines</option>
													<option value="PN">Pitcairn</option>
													<option value="PL">Poland</option>
													<option value="PT">Portugal</option>
													<option value="PR">Puerto Rico</option>
													<option value="QA">Qatar</option>
													<option value="RE">Réunion</option>
													<option value="RO">Romania</option>
													<option value="RU">Russian Federation</option>
													<option value="RW">Rwanda</option>
													<option value="BL">Saint Barthélemy</option>
													<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
													<option value="KN">Saint Kitts and Nevis</option>
													<option value="LC">Saint Lucia</option>
													<option value="MF">Saint Martin (French part)</option>
													<option value="PM">Saint Pierre and Miquelon</option>
													<option value="VC">Saint Vincent and the Grenadines</option>
													<option value="WS">Samoa</option>
													<option value="SM">San Marino</option>
													<option value="ST">Sao Tome and Principe</option>
													<option value="SA">Saudi Arabia</option>
													<option value="SN">Senegal</option>
													<option value="RS">Serbia</option>
													<option value="SC">Seychelles</option>
													<option value="SL">Sierra Leone</option>
													<option value="SG">Singapore</option>
													<option value="SX">Sint Maarten (Dutch part)</option>
													<option value="SK">Slovakia</option>
													<option value="SI">Slovenia</option>
													<option value="SB">Solomon Islands</option>
													<option value="SO">Somalia</option>
													<option value="ZA">South Africa</option>
													<option value="GS">South Georgia and the South Sandwich Islands</option>
													<option value="SS">South Sudan</option>
													<option value="ES">Spain</option>
													<option value="LK">Sri Lanka</option>
													<option value="SD">Sudan</option>
													<option value="SR">Suriname</option>
													<option value="SJ">Svalbard and Jan Mayen</option>
													<option value="SZ">Swaziland</option>
													<option value="SE">Sweden</option>
													<option value="CH">Switzerland</option>
													<option value="SY">Syrian Arab Republic</option>
													<option value="TW">Taiwan, Province of China</option>
													<option value="TJ">Tajikistan</option>
													<option value="TZ">Tanzania, United Republic of</option>
													<option value="TH">Thailand</option>
													<option value="TL">Timor-Leste</option>
													<option value="TG">Togo</option>
													<option value="TK">Tokelau</option>
													<option value="TO">Tonga</option>
													<option value="TT">Trinidad and Tobago</option>
													<option value="TN">Tunisia</option>
													<option value="TR">Turkey</option>
													<option value="TM">Turkmenistan</option>
													<option value="TC">Turks and Caicos Islands</option>
													<option value="TV">Tuvalu</option>
													<option value="UG">Uganda</option>
													<option value="UA">Ukraine</option>
													<option value="AE">United Arab Emirates</option>
													<option value="GB">United Kingdom</option>
													<option value="US">United States</option>
													<option value="UM">United States Minor Outlying Islands</option>
													<option value="UY">Uruguay</option>
													<option value="UZ">Uzbekistan</option>
													<option value="VU">Vanuatu</option>
													<option value="VE">Venezuela, Bolivarian Republic of</option>
													<option value="VN">Viet Nam</option>
													<option value="VG">Virgin Islands, British</option>
													<option value="VI">Virgin Islands, U.S.</option>
													<option value="WF">Wallis and Futuna</option>
													<option value="EH">Western Sahara</option>
													<option value="YE">Yemen</option>
													<option value="ZM">Zambia</option>
													<option value="ZW">Zimbabwe</option>
												</select>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Venue Description:</label>
												<div class="md-editor" id="1553185306142">
													<textarea name="venue" class="form-control md-input" data-provide="markdown" rows="5" style="resize: none;"></textarea>
													<div class="md-fullscreen-controls"><a href="#" class="exit-fullscreen" title="Exit fullscreen"><span class="fa fa-compress"></span></a></div>
													<span class="m-form__help">Please enter the description of the tournament venue</span>
												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg my-3"></div>
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">Tentative Dates</h3>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-md-4 m-form__group-sub">
												<input type="date" name="tentativeDates[]" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-md-4 m-form__group-sub">
												<input type="date" name="tentativeDates[]" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-md-4 m-form__group-sub">
												<input type="date" name="tentativeDates[]" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-md-12 m-form__group-sub">
												<label class="form-control-label">Price Money:</label>
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar-sign"></i></span></div>
													<input type="number" step="0.01" name="price" class="form-control m-input" placeholder="" value="">
												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg my-3"></div>
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">Contact Details</h3>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Contact Person's Name</label>
												<input type="text" name="contactName" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the name of the contact person</span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Contact Number</label>
												<input type="phone" name="contactPhone" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the phone number of the contact person</span>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Contact Email</label>
												<input type="email" name="contactEmail" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the email of the contact person</span>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg my-3"></div>
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">Organizer Details</h3>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Organizer Name</label>
												<input type="text" name="organizerName" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the name of the organizer</span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Organizer Number</label>
												<input type="phone" name="organizerPhone" class="form-control m-input" placeholder="" value="">
												<span class="m-form__help">Please enter the phone number of the organizer</span>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Organizer Email</label>
												<input type="email" name="organizerEmail" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div id="arbiters">
											<div class="form-group m-form__group row">
												<div class="col-11 m-form__group-sub">
													<label class="form-control-label">Arbiters</label>
													<input type="phone" id="add_arbiter_input" class="form-control m-input" placeholder="Enter name of an arbiter" value="" list="arbiters_list">
													<datalist id="arbiters_list">
													</datalist>
												</div>
												<div class="col-1 m-form__group-sub">
													<label class="form-control-label text-center">&#8203;</label>
													<button type="button" class="btn m-btn btn-primary" id="add_arbiter" title="Add Arbiter">+</button>
												</div>
											</div>
										</div>
										<br>
										<div id="coaches">
											<div class="form-group m-form__group row">
												<div class="col-11 m-form__group-sub">
													<label class="form-control-label">Coaches</label>
													<input type="phone" id="add_coache_input" class="form-control m-input" placeholder="Enter name of a coach" value="" list="coaches_list">
													<datalist id="coaches_list">
													</datalist>
												</div>
												<div class="col-1 m-form__group-sub">
													<label class="form-control-label text-center">&#8203;</label>
													<button type="button" class="btn m-btn btn-primary" id="add_coache" title="Add Coach">+</button>
												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg my-3"></div>
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
												<label class="form-control-label">Tournament Picture:</label>
												<div class="custom-file">
													<input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<span class="m-form__help">Select a picture to be used as the tournament picture</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" id="m_tournament_dismiss" data-dismiss="modal">Close</button>
							<div class="dropdown">
								<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
									<button class="dropdown-item text-primary action_tournament" type="button" data-action="approve" data-target=""><i class="fa fa-check-circle text-primary"></i> Approve</button>
									<button class="dropdown-item text-info action_tournament" type="button" data-action="reject" data-target=""><i class="fa fa-times-circle text-info"></i> Reject</button>
									<button class="dropdown-item text-dark feedback_tournament" type="button" data-action="feedback" data-target=""><i class="fa fa-share-alt text-dark"></i> Feedback</button>
									<button class="dropdown-item text-danger action_tournament" type="button" data-action="delete" data-target=""><i class="fa fa-trash text-danger"></i> Delete</button>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" id="m_tournament_submit"><i class="fa fa-save fa-fw"></i>Save</button>
						</div>
					</form>
        </div>
      </div>
    </div>
    <!--end::Modal-->
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
								<h3 class="m-subheader__title ">Tournaments</h3>
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

						<!--Begin::Section-->
						<!--Datatable Insert-->
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Tournaments
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-target="#m_modal_tournament">
												<span>
													<i class="la la-cart-plus"></i>
													<span>New Tournament</span>
												</span>
											</a>
										</li>
										<li class="m-portlet__nav-item"></li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-bordered table-hover table-checkable" id="m_table_1">
									<thead>
										<tr>
											<th>Title</th>
											<th>Organization</th>
											<th>Country</th>
											<th>Venue</th>
											<th>Registered</th>
											<th>Price</th>
											<th>Approval</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php

require_once '../functions.php';
require_once '../countries.php';

$country = $_SESSION['user']['country'];

$result = queryDB("SELECT * FROM posts WHERE type = 'tournament' ORDER BY createdAt DESC");

for ($j = 0; $j < $result->num_rows; ++$j){
	$result->data_seek($j);
	$tournament = $result->fetch_array(MYSQLI_ASSOC);
	$tournamentid = $tournament['id'];
	$country = $countries[$tournament['country']];
	$registrants = unserialize($tournament['registrants']);
	$num_of_registrants = 0;
	if ($registrants) $num_of_registrants = count($registrants);
	echo <<< _END
									<tr class="$tournament[id]"><td class="title">$tournament[title]</td><td class="author">$tournament[author]</td><td class="country">$country</td>
									<td class="venue">$tournament[venue]</td><td class="registered">$num_of_registrants</td><td class="price">&dollar;$tournament[price]</td>
_END;
if ($tournament['approved']) echo '<td class="approved approved-'.$tournamentid.'">4</td>';
else if ($tournament['rejected']) echo '<td class="approved approved-'.$tournamentid.'">3</td>';
else echo '<td class="approved approved-'.$tournamentid.'">1</td>';
if ($tournament['status'] == 'not started') echo '<td class="status status-'.$tournamentid.'">1</td>';
else if ($tournament['status'] == 'in progress') echo '<td class="status status-'.$tournamentid.'">7</td>';
else echo '<td class="status status-'.$tournamentid.'">4</td>';
echo <<< _END
							<td class="d-flex align-items-center justify-content-center">
								<a href="#" class="btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill tournament_details" data-toggle="modal" data-target="#m_modal_tournament" data-id="$tournament[id]">
									<i class="la la-plus m--hide" data-id="$tournament[id]"></i>
									<i class="la la-ellipsis-h" data-id="$tournament[id]"></i>
								</a>
						</td>
					</tr>
_END;
#if ($tournament['approved']) echo '<td><button disabled id="approve_tournament" data-target="'.$tournament['id'].'" class="btn btn-primary btn-sm m-btn m-btn--air">Approve</td></tr>';
#else echo '<td><button id="approve_tournament" data-target="'.$tournament['id'].'" class="btn btn-primary btn-sm m-btn m-btn--air">Approve </td></tr>';
}
?>
									</tbody>
								</table>
							</div>
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

		<!-- begin::Quick Sidebar -->

		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

		<!-- begin::Quick Nav -->
		<ul class="m-nav-sticky" style="margin-top: 30px;">
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Create Tournament" data-placement="left">
				<a href="" data-toggle="modal" data-target="#m_modal_tournament"><i class='flaticon-add-circular-button text-primary'></i></a>
			</li>
		</ul>

		<!-- begin::Quick Nav -->

		<!--begin::Global Theme Bundle -->
		<script src="../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<script src="../assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="../assets/app/js/dashboard.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/admin.js" type="text/javascript"></script>
		<script src="../assets/demo/demo3/base/datatables.js" type="text/javascript"></script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>