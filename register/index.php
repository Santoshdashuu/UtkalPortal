<?php 
include '../core/init.php';
logged_in_redirect();
ob_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<link rel="stylesheet" href="http://necolas.github.io/normalize.css/2.1.3/normalize.css">
	<link rel="stylesheet" href="css/jquery.idealforms.css">
	<link rel="stylesheet" href="../css/reg_header.css">
  
<meta charset=utf-8 />
<title> Register - Placement Portal - Utkal University </title>
<link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
	<style>
	body {
	font-size: 1em;
	}
	.content {
	margin: 0 400px 0 300px;
	}
	.field.buttons button {
	margin-right: .5em;
	}
	#invalid {
	display: none;
	float: left;
	width: 290px;
	margin-left: 120px;
	margin-top: .5em;
	color: #CC2A18;
	font-size: 130%;
	font-weight: bold;
	}
	.idealforms.adaptive #invalid {
	margin-left: 0 !important;
	}
	.idealforms.adaptive .field.buttons label {
	height: 0;
	}
	</style>

<style type="text/css">
#result { border: 1px solid green; width: 300px; margin: 0 0 35px 0; padding: 10px 20px; font-weight: bold; }
#change-image { font-size: 0.8em; float: right; }
</style>
  
 <script src="js/rightclick_disable.js"></script>
</head>
<body onload="document.getElementById('captcha-form').focus()" oncontextmenu="return false">

<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width">
		
			<a href="../index.php" class="round button dark ic-left-arrow image-left ">Return to Placement Portal</a>

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	<!-- HEADER -->
	<div id="header">
		
		<div class="page-full-width cf">
	
			<div id="login-intro" class="fl">
			
				<h1>Register For Placement Portal - Utkal University</h1>
				<h5>Enter your informations below</h5>
			
			</div> <!-- login-intro -->
			
			
			<!-- The logo will automatically be resized to 79px height. -->
			<a href="#" id="company-branding" class="fr"><img src="../images/uuLogo.png" alt="Utkal Placement" /></a>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
	
	<div class="content" class="content" style="width: 50%; background: #EFEFF8;border: solid 1px #CCCCFF;">
    <div class="idealsteps-container">
<?php
if(empty($_POST) === false) {
	$required_fields = array('first_name', 'last_name', 'email', 'phone', 'dob', 'sex', 'address', 'dept_name', 'deptrn', 'password', 'confirmpass', 'captcha' );
	foreach($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true) {
		 $errors[] = 'Fields marked with an asterisk are required.';
		 break 1;
		}
	}
	
	if(empty($errors) === true) {
		if(preg_match("/\\s/", $_POST['email']) == true) {
			$errors[] = '<h2 align="center"><font color=red>Your username must not contain spaces.</font></h2>';
		}
		if(strlen($_POST['password']) < 6) {
			$errors[] = '<h2 align="center"><font color=red>Your password must be at least 6 character.</font></h2>';
		}
		if($_POST['password'] !== $_POST['confirmpass']) {
			$errors[] = '<h2 align="center"><font color=red>Your passwords do not match.</font></h2>';
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = '<h2 align="center"><font color=red>A valid email address is required.</font></h2>';
		}
		if(email_exists($_POST['email']) === true) {
			$errors[] = '<h2 align="center"><font color=red>Sorry, the email \''.$_POST['email'] .'\'  already exists in our database.</font></h2>';
		}
		if (($_POST['captcha']) != $_SESSION['captcha']) {
			$errors[] = '<h2 align="center"><font color=red>You have entered an invalid Security text.</font></h2>';
			unset($_SESSION['captcha']);
		}
	}
}

if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<form id="login-form">
		<br>
		<div class="confirmation-box round"><h1> You've been registered successfully ! </h1></div>
		<div class="information-box round"> <h1> Please Check your email to Activate your account ! </h1> </div>
		<br />
		<a href="../" class="button round blue image-right ic-right-arrow">LOG IN NOW</a>
	</form>
	<br><br><br><br><br><br>
<?php
} else {
	
	if(empty($_POST) === false && empty($errors) === true) {
		$register_data = array (
			'first_name'  => $_POST['first_name'],
			'middle_name' => $_POST['middle_name'],
			'last_name'   => $_POST['last_name'],
			'email' 	  => $_POST['email'],
			'phone' 	  => $_POST['phone'],
			'dob' 		  => $_POST['dob'],
			'sex'     	  => $_POST['sex'],
			'address'     => $_POST['address'],
			'dept_name'   => $_POST['dept_name'],
			'deptrn' 	  => $_POST['deptrn'],
			'uuregno' 	  => $_POST['uuregno'],
			'password'	  => $_POST['password'],
			'email_code'  => md5($_POST['email'] + microtime())
		
		);
		register_user($register_data);
		header('Location: index.php?success ');
		exit();
	} else if(empty($errors) === false){
		echo output_errors($errors);
		
	}
?>
      <form action="" method="post" novalidate autocomplete="off" class="idealforms">

        <div class="idealsteps-wrap">

          <!-- Step 1 -->

          <section class="idealsteps-step" style="padding-left:15px; padding-top:15px;">

            <div class="field">
              <label class="main">First Name * :</label>
              <input name="first_name" type="text">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main">Middle Name  :</label>
              <input name="middle_name" type="text">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main">Last Name * :</label>
              <input name="last_name" type="text">
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Email * :</label>
              <input name="email" type="email" data-idealforms-ajax="ajax.php" placeholder="email@example.com">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main"> Mobile *:</label>
              <input name="phone" type="text" placeholder="000-000-0000">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main">DOB *:</label>
              <input name="dob" type="text" placeholder="yyyy/mm/dd" class="datepicker">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main"> Sex *:</label>
              <p class="group">
                <label><input name="sex" type="radio" value="male" checked>Male</label>
                <label><input name="sex" type="radio" value="female">Female</label>
              </p>
              <span class="error"></span>
            </div>
			
			<div class="field">
				<label class="main">Permanent Address  * :</label>
				<textarea name="address" cols="10" rows="5"> </textarea>
				<span class="error"></span>
			</div>
			
			
			<div class="field">
              <label class="main">Department *:</label>
              <select name="dept_name" id="">
                <option value="default">&ndash; Select an option &ndash;</option>
                <option value="Integrated MCA">Integrated MCA</option>
                <option value="Integrated MBA">Integrated MBA</option>
                <option value="Integrated LAW">Integrated LAW</option>
                <option value="M. Tech. Computer Science And Engineering">M. Tech. Computer Science And Engineering</option>
                <option value="M. Tech. in Computer Science">M. Tech. in Computer Science</option>
				<option value="M. Tech. in Information Technology">M. Tech. in Information Technology</option>
				<option value="M.Sc. in Computer Science">M.Sc. in Computer Science</option>
				<option value="Computer Science and Applications">Computer Science and Applications</option>
				<option value="Master in Finance & Control">Master in Finance & Control</option>
				<option value="Business Administration">Business Administration</option>
				<option value="Master in Pharmacy">Master in Pharmacy</option>
				<option value="P.G. Course in Environmental Science">P.G. Course in Environmental Science</option>
				<option value="P.G. Course in Applied & Industrial Micro Bio.">P.G. Course in Applied & Industrial Micro Bio.</option>
				<option value="Master of Rural Development">Master of Rural Development</option>
				<option value="P.G Diploma in Yoga Education">P.G Diploma in Yoga Education</option>
				<option value="M.A. in Women Studies">M.A. in Women Studies</option>
				<option value="P.G. Diploma in Remote Sensing and GIS">P.G. Diploma in Remote Sensing and GIS</option>
				<option value="M.A. in Development Journalism & Electronic And Communication">M.A. in Development Journalism & Electronic And Communication</option>
				<option value="M.Sc. in Fisheries and Aquaculture">M.Sc. in Fisheries and Aquaculture</option>
				<option value="Analytical and Applied Economics">Analytical and Applied Economics</option>
				<option value="Ancient Indian History, Culture and Archaeology">Ancient Indian History, Culture and Archaeology</option>
				<option value="Anthropology">Anthropology</option>
				<option value="Biotechnology">Biotechnology</option>
				<option value="Botany">Botany</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Commerce">Commerce</option>
				<option value="English">English</option>
				<option value="Geography">Geography</option>
				<option value="Geology">Geology</option>
				<option value="History">History</option>
				<option value="Law">Law</option>
				<option value="Library and Information Science">Library and Information Science</option>
				<option value="Integrated MCA">Mathematics</option>
				<option value="Integrated MCA">Oriya</option>
				<option value="PMIR">PMIR</option>
				<option value="Philosophy">Philosophy</option>
				<option value="Physics">Physics</option>
				<option value="Political Science">Political Science</option>
				<option value="Psychology">Psychology</option>
				<option value="Public Administration">Public Administration</option>
				<option value="Sanskrit">Sanskrit</option>
				<option value="Sociology">Sociology</option>
				<option value="Statistics">Statistics</option>
				<option value="Zoology">Zoology</option>
				
				
              </select>
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main">Dept. Roll No * :</label>
              <input name="deptrn" type="text">
              <span class="error"></span>
            </div>
			
			<div class="field">
              <label class="main">UU Reg No :</label>
              <input name="uuregno" type="text">
              <span class="error"></span>
            </div>

						
            <div class="field">
              <label class="main">Password * :</label>
              <input name="password" type="password">
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Confirm * :</label>
              <input name="confirmpass" type="password">
              <span class="error"></span>
            </div>
			
			<div class="field">
				<label class="main"> Enter the Security text * :</label>
				<img src="captcha.php" id="captcha"/><br/>
				<!-- CHANGE TEXT LINK -->
				<label class="main"></label>
				<a href="javascript:;" onclick="
				document.getElementById('captcha').src='captcha.php?'+Math.random();
				document.getElementById('captcha-form').focus();"
				id="change-image">Not readable? Change text.</a><br>
				<label class="main"></label>
				<input type="text" name="captcha" id="captcha-form" autocomplete="off" onblur="myfun(this.value)" onkeyup="myfun(this.value)" /><br>
				<div id="status" align="right"></div>
				<br>
				<span class="error"></span>
			</div>

            

            <div class="field buttons">
              <label class="main">&nbsp;</label>
              <button type="submit" class="submit"> Register </button>
            </div>

          </section>

        </div>

        <span id="invalid"></span>

      </form>
	<?php 
	}

	?>
    </div>

  </div>

  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="js/out/jquery.idealforms.js"></script>
  <!--<script src="js/out/jquery.idealforms.min.js"></script>-->
  <script src="js/formvalidator.js"></script>
  <script src="js/captchavalidator.js"></script>
		
	</div> <!-- end content -->
<?php include '../includes/footer.php'; ?>
