<?php
session_start();

if (!$_SESSION['loggedIn'] && $_SESSION['user']['role'] != "admin") {
	header("Location: login.php");
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
		<title>Users | Tournament Portal</title>
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


		<!--end::Page Vendors Styles -->
		<link rel="shortcut icon" href="../assets/app/media/img/icons/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!--begin::User Modal-->
    <div class="modal fade modal-light" id="m_modal_user" tabindex="-1" role="dialog" aria-labelledby="userModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50%;">
        <div class="modal-content">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form_user" novalidate="novalidate" enctype="multipart/form-data">
						<input type="hidden" name="field" class="form-control m-input" placeholder="" value="users">
						<input type="hidden" name="action" class="form-control m-input" placeholder="" value="update">
						<input type="hidden" name="target" class="form-control m-input" placeholder="" value="">
						<div class="modal-header">
							<h5 class="modal-title" id="userModalTitle">User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true" data-height="200" style="min-height: 70vh; overflow: hidden;">
								<div class="m-portlet">
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<div class="col-lg-12 m-form__group-sub">
													<label class="form-control-label">Fullname</label>
													<input type="text" name="fullname" class="form-control m-input" placeholder="" value="">
												</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Email</label>
												<input type="text" name="email" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Username</label>
												<input type="text" name="username" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Profession</label>
												<input type="text" name="profession" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Trainter Title</label>
												<input type="text" name="trainertitle" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Date of Birth</label>
												<input class="form-control m-input" type="date" value="" name="dob" required>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Gender</label>
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
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Type of Blindness</label>
												<select name="blindness" id="" class="form-control" required>
													<option value="" selected></option>
													<option value="partial">Partial</option>
													<option value="full">Full</option>
												</select>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Address</label>
												<input type="text" name="address" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Postal Code</label>
												<input type="text" name="postal" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">District</label>
												<input type="text" name="district" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">City</label>
												<input type="text" name="city" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">State</label>
												<input type="text" name="state" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-row m-form__group">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Country</label>
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
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Cell Number</label>
												<input type="text" name="cell" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Phone Number</label>
												<input type="text" name="phone" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">FIDE ID</label>
												<input type="text" name="fideid" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">FIDE Rating</label>
												<input type="text" name="fiderating" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">PAN No.</label>
												<input type="text" name="pan" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Adhar Card No.</label>
												<input type="text" name="adhar" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">National Rating</label>
												<input type="text" name="national" class="form-control m-input" placeholder="" value="">
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Years of Experience</label>
												<input type="number" name="experience" class="form-control m-input" placeholder="" value="">
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<label class="form-control-label">Communication Preference</label>
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
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												<a href="#" class="profile-pic" target="_blank"><strong>Profile Picture</strong></a>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												<a href="#" class="medcert" target="_blank"><strong>Medical Certificate</strong></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" id="m_user_dismiss" data-dismiss="modal">Close</button>
							<div class="dropdown">
								<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
									<button class="dropdown-item text-primary action_user" type="button" data-action="approve" data-target=""><i class="fa fa-check-circle text-primary"></i> Approve</button>
									<button class="dropdown-item text-info action_user" type="button" data-action="reject" data-target=""><i class="fa fa-times-circle text-info"></i> Reject</button>
									<button class="dropdown-item text-dark feedback_user" type="button" data-action="feedback" data-toggle="modal" data-target="#m_modal_feed" data-id=""><i class="fa fa-share-alt text-dark"></i> Feedback</button>
									<button class="dropdown-item text-danger action_user" type="button" data-action="delete" data-target=""><i class="fa fa-trash text-danger"></i> Delete</button>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" id="m_user_submit"><i class="fa fa-save fa-fw"></i>Save</button>
						</div>
					</form>
        </div>
      </div>
    </div>
    <!--end::User Modal-->
		<!--begin::Feedback Modal-->
    <div class="modal fade modal-light" id="m_modal_feed" tabindex="-1" role="dialog" aria-labelledby="feedModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50%;">
        <div class="modal-content">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form_feed" novalidate="novalidate">
						<input type="hidden" name="field" class="form-control m-input" placeholder="" value="users">
						<input type="hidden" name="action" class="form-control m-input" placeholder="" value="feedback">
						<input type="hidden" name="target" class="form-control m-input" placeholder="" value="">
						<div class="modal-header">
							<h5 class="modal-title" id="feedModalTitle">Feedback</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="m-portlet">
								<div class="m-portlet__body">
									<div class="form-group m-form__group row">
										<div class="col-lg-12 m-form__group-sub">
											<label class="form-control-label">Title</label>
											<input type="text" name="title" class="form-control m-input" placeholder="" value="">
										</div>
									</div>
									<div class="form-group m-form__group">
											<label class="form-control-label">Message</label>
											<textarea rows="5" name="message" class="form-control m-input" placeholder=""></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" id="m_feed_dismiss" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" id="m_feed_submit"><i class="fa flaticon-paper-plane fa-fw"></i>Send</button>
						</div>
					</form>
        </div>
      </div>
    </div>
    <!--end::Feedback Modal-->
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

<?php
require_once 'header.php';
?>
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
							<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="users.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-users"></i><span
									 class="m-menu__link-text">Users</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="organizations.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-map"></i><span
									 class="m-menu__link-text">Organizations</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="uploaders.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon fa fa-cloud-upload-alt"></i><span
									 class="m-menu__link-text">Bulk Uploaders</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="reports.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-pie-chart"></i><span
									 class="m-menu__link-text">Reports</a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="feedback.html" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-share"></i><span
									 class="m-menu__link-text">Feedbacks</span></a>
							</li>
							<li class="m-menu__item  m-menu__item" aria-haspopup="true"><a href="support.php" class="m-menu__link"><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-info"></i><span
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
								<h3 class="m-subheader__title m-subheader__title--separator">Users</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon flaticon-users"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">Base</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">All Users</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<select class="form-control m_selectpicker" tabindex="-98">
									<option selected>All</option>
									<option value="players">Players</option>
									<option value="arbiters">Arbiters</option>
									<option value="coaches">Coaches</option>
									<option value="states">Organizations</option>
								</select>
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
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Users
									</div>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-bordered table-hover table-checkable" id="m_table_1">
									<thead>
										<tr>
											<th>Name</th>
											<th>Profession</th>
											<th>Country</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Med. Cert</th>
											<th>Verification</th>
											<th>Approval</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php

require_once '../functions.php';

$country = $_SESSION['user']['country'];

$result = queryDB("SELECT id, fullname, profession, country, email, phone, medcert, verified, approved, rejected FROM users ORDER BY createdAt DESC");

for ($j = 0; $j < $result->num_rows; ++$j){
$result->data_seek($j);
$user = $result->fetch_array(MYSQLI_ASSOC);
$userid = $user['id'];
echo <<< _END
									<tr class="$user[id]"><td class="fullname">$user[fullname]</td><td class="profession">$user[profession]</td>
									<td class="country">$user[country]</td><td class="email">$user[email]</td><td class="phone">$user[phone]</td>
_END;
if ($user['medcert']) echo '<td class="medcert"><a href="../assets/data/medical/'.$user['medcert'].'" class="nav-link" target="_blank"><i class="fa fa-link fa-fw"></li>View</a></td>';
else echo '<td class="medcert"></td>';
if ($user['verified']) echo '<td class="verified"><div class="m-badge m-badge--wide m-badge--primary">verified</div></td>';
else echo '<td class="verified"><div class="m-badge m-badge--wide verified">pending</div></td>';
if ($user['approved']) echo '<td class="approved"><div class="m-badge m-badge--wide m-badge--success approved-'.$userid.'">approved</div></td>';
else if ($user['rejected']) echo '<td class="approved"><div class="m-badge m-badge--wide m-badge--danger approved-'.$userid.'">rejected</div></td>';
else echo '<td class="approved><div class="m-badge m-badge--wide approved-'.$userid.'">pending</div></td>';
echo <<< _END
							<td class="d-flex align-items-center justify-content-center">
								<a href="#" class="btn btn-lg btn-secondary m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill user_details" data-toggle="modal" data-target="#m_modal_user" data-id="$user[id]">
									<i class="la la-plus m--hide" data-id="$user[id]"></i>
									<i class="la la-ellipsis-h" data-id="$user[id]"></i>
								</a>
							</td>
						</tr>
_END;
#if ($user['approved']) echo '<td><button disabled id="approve_user" data-target="'.$user['id'].'" class="btn btn-primary btn-sm m-btn m-btn--air">Approve</td></tr>';
#else echo '<td><button id="approve_user" data-target="'.$user['id'].'" class="btn btn-primary btn-sm m-btn m-btn--air">Approve</td></tr>';
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