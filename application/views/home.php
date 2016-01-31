<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<title>Home Page!</title>
	</head>
	<body class='text-center text-primary'>
		<div class='container'>
			<div id='leftColumn' class='col-xs-4 well accordion'></div>
			<div id='middleColumn' class='col-xs-4'>
				<div class='row'>
					<h1>Enter a Gamertag!</h1>
				</div>
				<div class='row'>
					<div id='messageCenter'></div>
				</div>
				<div class='row'>
					<div id='inputDiv'>
						<div class='row well'>
							<form name="gamertagForm" action="#" method="POST">
								<label for='gamertagInput'>Gamertag: </label>
								<input type='text' name='gamertag' id='gamertag'>
								<input type="button" id="loginButton" value="Get Gamertag!" class="btn">
							</form>
						</div>
						<div class='row'>
							<div id='gamerDashboard' class='btn-group-vertical well'>Turn this into the wall!</div>
						</div>
					</div>
				</div>
			</div>
			<div id='rightColumn' class='col-xs-4 well accordion disabled'></div>
		</div>
		<!-- must load the external sources first -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<!-- then load the internal sources second -->
		<script type="text/javascript" src="js/common/buttonManager.js"></script>
		<script type="text/javascript" src="js/wrappers/jqueryUIWrapper.js"></script>
		<script type="text/javascript" src="js/home/checkGamertag.js"></script>
		<script type="text/javascript" src="js/home/addGamertagToAccount.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveProfile.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveGamercard.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrievePresence.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveFriends.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveRecentActivity.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveXbox360Games.js"></script>
		<script type="text/javascript" src="js/home/retrieveScripts/retrieveAchievements.js"></script>
		<!-- load the driver for execution last -->
		<script type="text/javascript" src="js/home/homeDriver.js"></script>
	</body>
</html>
