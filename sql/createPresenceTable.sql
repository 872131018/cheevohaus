CREATE TABLE IF NOT EXISTS cheevohaus.presence
(
	id int NOT NULL AUTO_INCREMENT,
	xuid VARCHAR(32),
	state VARCHAR(16),
	deviceType VARCHAR(16),
	titleId VARCHAR(32),
	name VARCHAR(32),
	placement VARCHAR(16),
	stateOfApp VARCHAR(16),
	lastModified VARCHAR(32),
	PRIMARY KEY(id)
);
