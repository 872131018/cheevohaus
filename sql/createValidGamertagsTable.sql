CREATE TABLE IF NOT EXISTS cheevohaus.validGamertags
(
	id int NOT NULL AUTO_INCREMENT,
	xuid VARCHAR(64),
	gamertag VARCHAR(64),
	PRIMARY KEY(id)
);
