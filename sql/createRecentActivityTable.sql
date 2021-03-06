CREATE TABLE IF NOT EXISTS cheevohaus.recentActivity
(
	id VARCHAR(32),
	startTime VARCHAR(32),
	endTime VARCHAR(32),
	sessionDurationInMinutes VARCHAR(8),
	contentImageUri VARCHAR(256),
	bingId VARCHAR(64),
	contentTitle VARCHAR(256),
	vuiDisplayName VARCHAR(256),
	platform VARCHAR(32),
	titleId VARCHAR(32),
	description VARCHAR(256),
	date VARCHAR(32),
	hasUgc VARCHAR(8),
	activityItemType VARCHAR(16),
	contentType VARCHAR(8),
	shortDescription VARCHAR(32),
	itemText VARCHAR(256),
	itemImage VARCHAR(256),
	shareRoot VARCHAR(256),
	feedItemId VARCHAR(256),
	itemRoot VARCHAR(256),
	hasLiked VARCHAR(8),
	gamertag VARCHAR(32),
	realName VARCHAR(32),
	displayName VARCHAR(32),
	userImageUri VARCHAR(256),
	userXuid VARCHAR(32)
);
