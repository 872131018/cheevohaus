CREATE TABLE IF NOT EXISTS cheevohaus.gamercard
(
	id int NOT NULL AUTO_INCREMENT,
	gamertag VARCHAR(32),
	name VARCHAR(32),
	location VARCHAR(64),
	bio VARCHAR(512),
	gamerscore VARCHAR(16),
	tier VARCHAR(16),
	motto VARCHAR(256),
	avatarBodyImagePath VARCHAR(256),
	gamerpicSmallImagePath VARCHAR(256),
	gamerpicLargeImagePath VARCHAR(256),
	gamerpicSmallSslImagePath VARCHAR(256),
	gamerpicLargeSslImagePath VARCHAR(256),
	avatarManifest VARCHAR(2048),
	PRIMARY KEY(id)
);
