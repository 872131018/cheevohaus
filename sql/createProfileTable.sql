CREATE TABLE IF NOT EXISTS cheevohaus.profile
(
	id int NOT NULL AUTO_INCREMENT,
	xuid VARCHAR(64),
	hostId VARCHAR(32),
	Gamertag VARCHAR(32),
	GameDisplayName VARCHAR(32),
	AppDisplayName VARCHAR(32),
	Gamerscore VARCHAR(16),
	GameDisplayPicRaw VARCHAR(256),
	AppDisplayPicRaw VARCHAR(256),
	AccountTier VARCHAR(16),
	XboxOneRep VARCHAR(16),
	PreferredColor VARCHAR(256),
	TenureLevel VARCHAR(16),
	isSponsoredUser VARCHAR(8),
	PRIMARY KEY(id)
);
