<?php
session_start();
$PAGE_ICON = 'flaticon-questions-circular-button';
$PAGE_TITLE = 'Support';
$DOCUMENT_TITLE = 'Support | Tournament Portal';

if (!$_SESSION["loggedIn"]){
	header("Location: /login.html");
}

if ($_POST){
	require_once '../functions.php';

	$userid = $_SESSION['user']['id'];
	$rawMessage = $_POST['message'];
	$msg = sanitizeString($_POST['message']);
	$email = $_SESSION['user']['email'];
	$country = $_SESSION['user']['country'];

	$attachment = "";

	if ($_POST['reply']){
		$ticketnum = sanitizeString($_POST['ticketnum']);
		$result = queryDB("SELECT conversation FROM tickets WHERE ticketnum = '$ticketnum'");
		$ticket = $result->fetch_array(MYSQLI_ASSOC);
		$conversation = unserialize(base64_decode($ticket['conversation']));
		$message = array("type" => "in", "userId" => $userid, "userRole" => "user", "message" => $msg, 
										"date" => date(DATE_RFC2822), "attachment" => $attachment);
		array_push($conversation, $message);
		$conversation = base64_encode(serialize($conversation));

		if (queryDB("UPDATE tickets SET conversation = '$conversation' WHERE ticketnum='$ticketnum'")){

		}
	}
	else {
		$title = sanitizeString($_POST['title']);

		if ($_FILES){
			$filename = $_FILES['attachment']['name'];
			$fullpath = date(DATE_ISO8601)."_".$filename;
			// $ext = pathinfo($_FILES["bulkFile"]["name"])['extension'];
	
			move_uploaded_file($_FILES['attachment']['tmp_name'], '../assets/data/tickets/'.$fullpath);
			$attachment = $fullpath;
		}

		$conversation = array();
		$message = array("type" => "in", "userId" => $userid, "userRole" => "user", "message" => $msg, 
										"date" => date(DATE_RFC2822), "attachment" => $attachment);
		array_push($conversation, $message);
		$conversation = base64_encode(serialize($conversation));

		$query = "INSERT INTO tickets (id, userid, title, conversation, country) VALUES
						(UUID(), '$userid', '$title', '$conversation', '$country')";

		if (queryDB($query)){
			$result = queryDB("SELECT ticketnum FROM tickets WHERE (title = '$title' AND userid = '$userid') ORDER BY createdAt DESC LIMIT 1");
			$result = $result->fetch_array(MYSQLI_ASSOC);
			$body = "<h4>Hi, <strong>".$_SESSION['user']['fullname']."</strong></h4>
								<p>Your support ticket has been created successfully</p>
								<p>We will reply as soon as possible</p>
								<p>Ticket Details</p><br>
								<h5><strong>Ticket #</strong>".$result['ticketnum']."</h5>
								<h5><strong>Ticket subject: </strong>".$title."</h5>
								<h5><strong>Message </strong>".$result['ticketnum']."</h5>
								<p>".$rawMessage."</p>";
			$subject = $title." - ticket #".$result['ticketnum'];
			sendPHPMail($email, $_SESSION['user']['fullname'], $subject, $body, "Tportal Support");
			setLog("user", $_SESSION['user']['id'], "New support ticket: #".$result['ticketnum'], $_SESSION['user']['country']);
			$successMsg = "Support ticket #".$result['ticketnum']." created successfully!";
		}
		else {
			$errMsg = "Error created support ticket!";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?PHP echo $DOCUMENT_TITLE; ?></title>
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
							<div class="col-xl-3 col-lg-4 d-none d-lg-block">
								<?php
									require_once 'leftbar.php';
								?>
							</div>
							
							<!--Pages Section-->
							<div class="col-xl-6 col-lg-8">
<?php

if ($_GET['id']){
	require_once '../functions.php';

	$tid = sanitizeString($_GET['id']);

	$result = queryDB("SELECT * FROM tickets WHERE id='$tid'");

	if ($result->num_rows){
		$ticket = $result->fetch_array(MYSQLI_ASSOC);
	
		echo <<< _END
								<div class="m-portlet ticket-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h2 class="m-portlet__head-text" style="font-size: 1.5em; font-weight: bold;">
													ticket #$ticket[ticketnum]
												</h2>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<a href="/home/support.php" type="button" class="m-btn btn btn-dark btn-sm"	>
												<i class="fa fa-arrow-left"></i> 
												<span>Back</span>
											</a>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="alert alert-secondary text-center bg-secondary">
											<strong class="m-messenger__title"><h4>$ticket[title]</h4></strong>
										</div>
										<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
											<div class="m-messenger__messages m-scrollable" style="max-height: 350px; overflow: auto;">
_END;

$conversation = unserialize(base64_decode($ticket['conversation']));
$name = $_SESSION['user']['fullname'];
for ($c = 0; $c < sizeof($conversation); ++$c){
	$message = $conversation[$c]['message'];
	$message = str_replace("\\n", '<br>', $message );
	$message = str_replace("\\r", '', $message );
	$message = stripslashes($message);
	$type = $conversation[$c]['type'];
	$attachment = $conversation[$c]['attachment'];
	$time = $conversation[$c]['date'];

	if ($type == 'in'){
			echo <<< _END
												<div class="m-messenger__wrapper">
													<div class="m-messenger__message m-messenger__message--in">
														<div class="m-messenger__message-pic">
_END;
		if ($_SESSION['user']['picture']) {
			echo 										'<img src="/assets/data/profiles/'.$_SESSION['user']['picture'].'" alt="user picture" />';
		}
		else															{
			//echo 										'<img src="/assets/app/media/img/users/neutral.png" alt="user picture" />';
			$firstLetter = substr($_SESSION['user']['fullname'], 0, 1);
			echo <<< _END
															<div class="m-messenger__message-no-pic m--bg-fill-danger">
																<span>$firstLetter</span>
															</div>
_END;
		}
			echo <<< _END
														</div>
													<div class="m-messenger__message-body">
														<div class="m-messenger__message-arrow"></div>
														<div class="m-messenger__message-content">
															<div class="m-messenger__message-username">$name</div>
															<div class="m-messenger__message-text">$message
_END;
		if ($attachment){
			echo 											'<hr><a href="/assets/data/tickets/'.$attachment.'" target="_blank" style="font-size: 12px">';
			echo												'<i class="fa flaticon-attachment"></i> <span>'.substr($attachment, 0, 43).'</span></a>';
		} 

			echo <<< _END
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="m-messenger__datetime">$time</div>
_END;
	}
	else {
			echo <<< _END
											<div class="m-messenger__wrapper">
            						<div class="m-messenger__message m-messenger__message--out">
            							<div class="m-messenger__message-body">
            								<div class="m-messenger__message-arrow"></div>
            								<div class="m-messenger__message-content">
            									<div class="m-messenger__message-text">$message</div>
														</div>
													</div>
												</div>
											</div>
_END;
	}

}
			echo <<< _END
											</div>
											<div class="m-messenger__seperator"></div>
											<form class="m-messenger__form" method="post" enctype="multipart/form-data">
												<input type="hidden" name="reply" value="true"/>
												<input type="hidden" name="ticketnum" value="$ticket[ticketnum]"/>
												<input type="file" name="attachment" value="" hidden/>
												<div class="m-messenger__form-tools">
													<a href="" class="m-messenger__form-attachment">
														<i class="la la-paperclip"></i>
													</a>
												</div>
												<div class="m-messenger__form-controls">
													<input type="text" name="message" placeholder="Type here..." class="m-messenger__form-input" required>
												</div>
												<div class="m-messenger__form-tools">
													<button type="submit" class="m-messenger__form-attachment">
														<i class="fa fa-paper-plane"></i>
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>
_END;
	}
}
else {
	require_once '../functions.php';

		echo <<<_END
								<div class="m-portlet tickets-portlet d-none">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Support
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<button type="button" class="m-btn btn btn-dark btn-sm" id="backToTickets">
												<i class="fa fa-arrow-left"></i> 
												<span>Back</span>
											</button>
										</div>
									</div>
									<div class="m-portlet__body">
										<form class="m-form m-form--fit m-form--label-align-right" action="support.php" method="post" enctype="multipart/form-data">
                          <div class="form-group m-form__group row">
                            <div class="col-md-10 ml-auto">
                              <h3 class="m-form__section">Get Help</h3>
                            </div>
													</div>
							
_END;

if ($errMsg){
		echo <<< _END
													<div class='form-group m-form__group row justify-content-center align-items-center'>
														<div class="col-md-10 ml-auto">
															<div class='alert alert-danger'>$errMsg</div>
														</div>
													</div>
_END;
}
else if ($successMsg){
		echo <<< _END
													<div class='form-group m-form__group row justify-content-center align-items-center'>
														<div class="col-md-10 ml-auto">
															<div class='alert alert-success'>$successMsg</div>
														</div>
													</div>
_END;
}
		
											echo '<div class="form-group m-form__group row">';
		echo <<< _END
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
														<div class="col-sm-10">
_END;
															
													echo '<input class="form-control m-input" type="email" name="email" value="'.$_SESSION['user']['email'].'" required readonly>';
		echo <<< _END
                            </div>
                          </div>
													<div class="form-group m-form__group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
															<input class="form-control m-input" type="text" name="title" value="" required>
                            </div>
                          </div>
                          <div class="form-group m-form__group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Your Query</label>
                            <div class="col-sm-10">
                                <textarea class="form-control m-input" rows="4" name="message" required></textarea>
                            </div>
													</div>
													<div class="form-group m-form__group row">
														<label for="exampleInputEmail1" class="col-sm-2 col-form-label">Attachment</label>
														<div class="custom-file col-sm-10">
															<input type="file" name="attachment" class="custom-file-input form-control m-input" id="customFile" accept="image/jpeg, image/png, application/pdf">
															<label class="custom-file-label selected" for="customFile"></label>
														</div>
													</div>
													<div class="form-group m-form__group d-flex justify-content-end">
														<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Submit</button>&nbsp;&nbsp;
                          </div>
                      </form>
									</div>
								</div>
								
								<div class="m-portlet new-ticket-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Tickets
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<button type="button" class="m-btn btn btn-brand btn-sm" id="newTicket" title="Create new ticket">
												<i class="fa fa-plus"></i> 
												<span>New</span>
											</button>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="form-group m-form__group row">
											<div class="col-12 ml-auto">
												<div class="m-widget3">
_END;

$uid = $_SESSION['user']['id'];
$picture = $_SESSION['user']['picture'];

$result = queryDB("SELECT id, ticketnum, title, userid, conversation, status, createdAt FROM tickets WHERE (userid = '$uid') ORDER BY createdAt DESC");

if ($result->num_rows){
for ($j = 0; $j < $result->num_rows; ++$j){
	$result->data_seek($j);
	$ticket = $result->fetch_array(MYSQLI_ASSOC);
	$conversation = unserialize(base64_decode($ticket['conversation']));
	$message = $conversation[0]['message'];
	$message = str_replace("\\n", '<br>', $message );
	$message = str_replace("\\r", '', $message );
	$message = stripslashes($message);
	$type = $conversation[0]['type'];

	echo <<< _END
														<div class="m-widget3__item px-2 py-1" data-target="$ticket[id]">
														<a href="?id=$ticket[id]">
															<div class="m-widget3__header">
																<div class="m-widget3__user-img">
_END;
if ($picture){
				echo '<img class="m-widget3__img" src="../../assets/app/media/img/users/'.$picture.'" alt="">';
}
else {
				echo '<img class="m-widget3__img" src="../../assets/app/media/img/users/neutral.png" alt="">';
}
		echo <<< _END
																</div>
																<div class="m-widget3__info">
																	<span class="m-widget3__username">
																		$ticket[title] - 
_END;
if ($ticket['status'] == 'open') {
		echo <<< _END
																		<span class="m-badge m-badge-sm m-badge--info">
																			$ticket[status]
																		</span>
_END;
}
else {
		echo <<< _END
																		<span class="m-badge m-badge-sm m-badge--metal">
																			$ticket[status]
																		</span>
_END;
}
		echo <<< _END
																	</span><br>
																	<span class="m-widget3__time">
																		$ticket[createdAt]
_END;
if ($conversation[0]['attachment']){
														echo  	'<i class="la la-paperclip"></i>';
}
		echo <<< _END
																	</span>
																</div>
_END;
if ($type == 'in') {
		echo <<< _END
																<span class="m-widget3__status m--font-primary">
																 <i class="fa fa-share"></i>
																</span>
_END;
}
else {
		echo <<< _END
																<span class="m-widget3__status m--font-danger">
																	<i class="fa flaticon-reply"></i>
																</span>
_END;
}

		echo <<< _END
															</div>
															<div class="m-widget3__body">
																<p class="m-widget3__text">
																	$message
																</p>
															</div>
															</a>
														</div>
_END;

}
}
		echo <<< _END
													</div>
											</div>
										</div>
									</div>
								</div>
_END;
}
?>
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

		<!-- begin::Messages autoscroll to down -->
		<script type="text/javascript">
			var d = $(".m-scrollable");
      d.scrollTop(d[1].scrollHeight - d.height());
		</script>
		<!-- end::Messages autoscroll to down -->

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