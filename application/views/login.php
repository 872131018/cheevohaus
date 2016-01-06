<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<title>Login!</title>
	</head>
	<body class='text-center text-primary'>
		<div class='container'>
			<div id='leftColumn' class='col-xs-3'></div>
			<div class='col-xs-6'>
				<div class='row'>
					<h1>Enter Credentials</h1>
				</div>
				<div class='row'>
					<div id='messageCenter'></div>
				</div>
				<div class='row'>
					<div id='inputDiv'>
						<div class='row well'>
							<form name="loginForm" action="#" method="POST">
								<label for='username'>Username: </label>
									<input type='text' name='username' id='username' class='form-control'>
								<label for='password'>Password: </label>
									<input type='password' name='password' id='password' class='form-control'>
								<input type="button" id="loginButton" value="Get Gamertag!" class="btn">
							</form>
						</div>
						<div class='row'>
							<div id='gamerDashboard' class='btn-group-vertical well'>Turn this into the wall!</div>
						</div>
					</div>
				</div>
			</div>
			<div class='col-xs-3'></div>
		</div>
	</body>
	<!-- must load the external sources first -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!-- then load the internal sources second -->
	<script type="text/javascript" src="js/wrappers/jqueryUIWrapper.js"></script>
	<script type="text/javascript" src="js/common/buttonManager.js"></script>
	<script type="text/javascript" src="js/login/loginScripts.js"></script>
	<!-- load the driver for execution -->
	<script type="text/javascript" src="js/login/loginDriver.js"></script>
</html>
