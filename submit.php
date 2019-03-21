<?php
session_start();


$servername = "localhost";
$username = "hafsa";
$password = "hafsa";

function test_input($data)

{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$conn = mysqli_connect("localhost", "hafsa", "hafsa","testdb");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Create connection
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
		<title>Metronic | Login Page - 3</title>
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
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="assets/demo/demo3/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/demo3/base/style.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />

		<script src="assets/demo/demo3/base/jquery.min.js"></script>
		<script src="assets/demo/demo3/base/scripts.js"></script>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url('assets/app/media/img/bg/bg-3.jpg');">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="assets/app/media/img/users/logo.jpg" style="max-width: 100px; height: auto;">
							</a>
						</div>
						
						
						
						
						
						
						


<?php

if($_POST['logininfo']=="FIRST")
{
  $email=$_POST['email'] ;
  $password=$_POST['password'];
   $sql="SELECT * FROM USER WHERE email='$email' && password='$password'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result)==1)
   {
       header("Location: index.php");
      $_SESSION['login_user'] = $email;
   }
   else
   {
   $error="incorrect username or password";
   $_SESSION['errMsg'] = "Invalid username or password!!!Please Enter correct values";
   header("Location: login.php");
       
   }
 }


else if ($_POST['logininfo']=="SECOND")

{
  
$profession="arbitar";
$email= test_input($_POST['email']);
$name=  test_input($_POST['name']);
$username= test_input($_POST['username']);
$trainertitle= test_input($_POST['title']);
$dob=  test_input($_POST['dob']);
$gender= test_input($_POST['gender']);
$cell=test_input($_POST['cell']);
$phone=  test_input($_POST['phone']);
$experience= test_input($_POST['experience']);
$address= test_input($_POST['address']);
$state= test_input($_POST['state']);
$district= test_input($_POST['district']);
$adhar= test_input($_POST['adhar']);
$pan= test_input($_POST['pan']);
$password= test_input($_POST['name']);

mysqli_autocommit($conn,FALSE);
$flag=true;

 
   $result=mysqli_query($conn,"SELECT * FROM USER WHERE email='$email'");
 if(mysqli_num_rows($result)>=1)
   {
   $_SESSION['errMsg'] = "The Email Account Already exists!!";
  header("Location: login.php");
       }
       
       
   else
   {

$sql = "INSERT INTO USER (Profession,email,password) VALUES ('$profession','$email','$password')";

if (mysqli_query($conn, $sql)) {
    echo "Congratulations you have succesfully created account";
} 
else {
    $flag=false;
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    
}

$sql2 = "INSERT INTO Arbiter (Name,Username,Email,TrainerTitle,Dob,gender,cellno,	phoneno,state,district,experience,address,adharcard,panno,userid) VALUES ('$name','$username','$email','$trainertitle','$dob','$gender','$cell','$phone','$state','$district','$experience','$address','$adhar','$pan',LAST_INSERT_ID())";

if (mysqli_query($conn, $sql2)) {
    echo "you have been subscribed as a arbitrater ";
} 

else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $flag=false;
    
}

if ($flag) {

   mysqli_commit($conn);
   echo "All queries were executed successfully";
   $_SESSION['login_user'] = $email;
  echo '<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">CONGRATULATIONS!!</h3>
								
							
									<div class="m-login__account">
							<span class="m-login__account-msg">
								Your Account Has Been Created!!
							</span>
							</div>
							
							
									<div class="m-login__account">
							<span class="m-login__account-msg">
								Profession Type: Arbitrater
							</span>&nbsp;&nbsp;
							</div>
							<div class="m-login__account">
							<span class="m-login__account-msg">EMAIL:'.$email.'
							</span>
							</div>
							
							<div class="m-login__account">
							<span class="m-login__account-msg">Password:'.$password.'
							</span>
							</div>
   <div class="m-login__account">
							<a href="index.php"><span class="m-login__account-msg">Get Started
							</span></a>
							</div>';
   
   
}

else {
 
   mysqli_rollback($conn);
   echo "Account cannot be created please check the data entered"; 
}

mysql_free_result( $result );

}


}


if($_POST['logininfo']=="THIRD")
 
 
 {

$profession="coach";
$email= test_input($_POST['email']);
$name=  test_input($_POST['name']);
$username= test_input($_POST['username']);
$trainertitle= test_input($_POST['title']);
$dob=  test_input($_POST['dob']);
$gender= test_input($_POST['gender']);
$cell=test_input($_POST['cell']);
$phone=  test_input($_POST['phone']);
$experience= test_input($_POST['experience']);
$address= test_input($_POST['address']);
$state= test_input($_POST['state']);
$district= test_input($_POST['district']);
$adhar= test_input($_POST['adhar']);
$pan= test_input($_POST['pan']);
$password= test_input($_POST['name']);

mysqli_autocommit($conn,FALSE);
$flag=true;

 
   $result=mysqli_query($conn,"SELECT * FROM USER WHERE email='$email'");
 if(mysqli_num_rows($result)>=1)
   {
   $_SESSION['errMsg'] = "The Email Account Already exists!!";
  header("Location: login.php");
       }
       
       
   else
   {

$sql = "INSERT INTO USER (Profession,email,password) VALUES ('$profession','$email','$password')";

if (mysqli_query($conn, $sql)) {
    echo "Congratulations you have succesfully created account";
} 
else {
    $flag=false;
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    
}

$sql2 = "INSERT INTO coach (Name,Username,Email,TrainerTitle,Dob,gender,cellno,	phoneno,state,district,experience,address,adharcard,panno,userid) VALUES ('$name','$username','$email','$trainertitle','$dob','$gender','$cell','$phone','$state','$district','$experience','$address','$adhar','$pan',LAST_INSERT_ID())";

if (mysqli_query($conn, $sql2)) {
    echo "you have been subscribed as a coach ";
} 

else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $flag=false;
    
}

if ($flag) {

   mysqli_commit($conn);
   echo "All queries were executed successfully";
   $_SESSION['login_user'] = $email;
  echo '<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">CONGRATULATIONS!!</h3>
								
							
									<div class="m-login__account">
							<span class="m-login__account-msg">
								Your Account Has Been Created!!
							</span>
							</div>
							
							
									<div class="m-login__account">
							<span class="m-login__account-msg">
								Profession Type: coach
							</span>;
							</div>
							
							<div class="m-login__account">
							<span class="m-login__account-msg">EMAIL:'.$email.'</span>
							</div>
							
							<div class="m-login__account">
							<span class="m-login__account-msg">Password:'.$password.'
							</span>
							</div>
   <div class="m-login__account">
							<a href="index.php"><span class="m-login__account-msg">Get Started
							</span></a>
							</div>';
   
   
}

else {
 
   mysqli_rollback($conn);
   echo "Account cannot be created please check the data entered"; 
}

mysql_free_result( $result );

}

   
   
    
    
    
}














$conn->close();



?>



</body>

</html>