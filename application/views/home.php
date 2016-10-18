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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Skeleton-2.0.4/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Skeleton-2.0.4/css/skeleton.css">
	<?php /*
	* Page CSS
	*/ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles.css">
  <?php /*
	* Favicon
	*/ ?>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>images/favicon.png">
</head>
<?php /*
* Primary Page Layout
*/ ?>
<body>
	<div class="section silver">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<h3>Enter your gamertag.</h3>
				</div>
				<div class="one-half column">
					<div id='inputDiv'>
						<form name="gamertagForm" action="#" method="POST">
							<label for='gamertagInput'>Gamertag: </label>
							<input type='text' name='gamertag' id='gamertag'>
							<input type="button" value="Gamertag Lookup" data-delegate="gamertag">
						</form>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class="one-third column"></div>
				<div class="one-third column">
					<h5 id='messageCenter'></h5>
				</div>
				<div class="one-third column"></div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class='container'>
			<div class='row'>
				<h5>Profile</h5>
				<div class="four columns">
					<div id="Gamertag"></div>
				</div>
				<div class="four columns">
					<div id="GameDisplayPicRaw"></div>
				</div>
				<div class="four columns">
					<div id="Gamerscore"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="section silver">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<h3>Gamercard</h3>
				</div>
				<div class="one-half column">
					<div id="gamercard"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<div id="presence"></div>
				</div>
				<div class="one-half column">
					<h3>Presence</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="section silver">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<h3>Friends</h3>
				</div>
				<div class="one-half column">
					<div id="friends"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<div id="recentActivity"></div>
				</div>
				<div class="one-half column">
					<h3>Recent Activity</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="section silver">
		<div class='container'>
			<div class='row'>
				<div class="one-half column">
					<h3>Xbox 360 Games</h3>
				</div>
				<div class="one-half column">
					<div id="xbox360Games"></div>
				</div>
			</div>
		</div>
	</div>
	<div class='row'>
		<div id='gamerDashboard' class='btn-group-vertical well'>Turn this into the wall!</div>
	</div>
	<?php /*
	* Must load the external sources first
	*/ ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php /*
	* Then load the internal sources second
	*/ ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/common/buttonManager.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/checkGamertag.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveProfile.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveGamercard.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrievePresence.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveFriends.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveRecentActivity.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveXbox360Games.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/retrieveScripts/retrieveAchievements.js"></script>
	<?php /*
	* Load the driver for execution
	*/ ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/home/homeDriver.js"></script>
</body>
</html>
