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
	* Skeleton CSS
	*/ ?>
  <link rel="stylesheet" href="Skeleton-2.0.4/css/normalize.css">
  <link rel="stylesheet" href="Skeleton-2.0.4/css/skeleton.css">
	<?php /*
	* Page CSS
	*/ ?>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
  <?php /*
	* Favicon
	*/ ?>
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<?php /*
* Primary Page Layout
*/ ?>
<body>
	<div class="container">
		<div class="row">
			<div class="one-half column" style="margin-top: 25%">
				<h1>Enter Credentials</h1>
				<p>This index.html page is a placeholder with the CSS, font and favicon. It's just waiting for you to add some content! If you need some help hit up the <a href="http://www.getskeleton.com">Skeleton documentation</a>.</p>
				<div class='row well'>
					<form name="loginForm" action="#" method="POST">
						<label for='username'>Username: </label>
							<input type='text' name='username' id='username' class='form-control'>
						<label for='password'>Password: </label>
							<input type='password' name='password' id='password' class='form-control'>
						<input type="button" id="loginButton" value="Log In!" class="btn">
					</form>
				</div>
				<div class='row'>
					<div id='messageCenter'></div>
				</div>
				<div id='gamerDashboard' class='btn-group-vertical well'>Turn this into the wall!</div>
			</div>
		</div>
	</div>
	<?php /*
	* Must load the external sources first
	*/ ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<?php /*
	* Then load the internal sources second
	*/ ?>
	<script type="text/javascript" src="js/wrappers/jqueryUIWrapper.js"></script>
	<script type="text/javascript" src="js/common/buttonManager.js"></script>
	<script type="text/javascript" src="js/login/loginScripts.js"></script>
	<?php /*
	* Load the driver for execution
	*/ ?>
	<script type="text/javascript" src="js/login/loginDriver.js"></script>
<body>
</html>
