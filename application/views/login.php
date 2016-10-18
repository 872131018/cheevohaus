<!DOCTYPE html>
<html lang="en">
<head>
	<?php /*
	* Basic Page Needs
	*/ ?>
  <meta charset="utf-8">
  <title>Your page title here :)</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <?php /*
	* Mobile Specific Metas
	*/ ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php /*
	* Other Meta
	*/ ?>
	<meta charset='utf-8'>
  <?php /*
	* Font
	*/ ?>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <?php /*
	* CSS
	*/ ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Skeleton-2.0.4/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Skeleton-2.0.4/css/skeleton.css">
	<?php /*
	* Page CSS
	*/ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles.css">
  <?php /*
	* Favicon
	*/ ?>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>resources/Skeleton-2.0.4/images/favicon.png">
</head>
<?php /*
* Primary Page Layout
*/ ?>
<body>
	<div class="section silver">
		<div class="container">
			<div class="row">
				<div class="one-half column">
					<h1>Enter Credentials</h1>
					<h3>Sign in and start boosting!</h3>
				</div>
				<div class="one-half column">
					<form name="loginForm" action="#" method="POST">
						<label for='username'>Username: </label>
						<input type='text' name='username' id='username' class='form-control'>
						<label for='password'>Password: </label>
						<input type='password' name='password' id='password' class='form-control'>
						<input type="button" id="login" value="Log In!" class="blue">
					</form>
					<div id='messageCenter'></div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="one-half column">
					<!--<div id='messageCenter'></div>-->
				</div>
				<div class="one-half column">
					<div id='gamerDashboard' class='btn-group-vertical well'>Turn this into the wall!</div>
				</div>
			</div>
		</div>
	</div>
	<?php /*
	* Must load the external sources first
	*/ ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php /*
	* Then load the internal sources second
	*/ ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/common/buttonManager.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/login/checkLogin.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/login/addUser.js"></script>
	<?php /*
	* Load the driver for execution
	*/ ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/login/loginDriver.js"></script>
<body>
</html>
