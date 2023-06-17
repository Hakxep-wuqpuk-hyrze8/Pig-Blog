DROP TABLE IF EXISTS Tags;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Friends;
DROP TABLE IF EXISTS Collections;
DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Users;

CREATE TABLE Users (
    userID		INT IDENTITY(1, 1),
    username	NVARCHAR(50),
    email		NVARCHAR(50),
    password	NVARCHAR(50),
	PRIMARY	KEY (userID),
);

CREATE TABLE Posts (
	postID			INT IDENTITY(1, 1),
	userID			INT,
	title			NVARCHAR(32),
	content			NVARCHAR(512),
	createdAt		Date DEFAULT GETDATE(),
	PRIMARY KEY		(postID),
);

CREATE TABLE Tags (
	tagID		INT IDENTITY(1, 1),
    postID		INT,
    name		NVARCHAR(50),
	PRIMARY KEY (postID),
	FOREIGN KEY (postID) REFERENCES Posts(postID)
);

CREATE TABLE Comments (
	commentID   INT IDENTITY(1, 1),
	postID		INT,
	userID		INT,
	content		NVARCHAR(256),
	createdAt   Date DEFAULT GETDATE(),
	PRIMARY KEY (commentID, postID, userID),
	FOREIGN KEY (postID) REFERENCES Posts(postID),
	FOREIGN KEY (userID) REFERENCES Users(userID)
);

CREATE TABLE Friends (
	userID		INT,
	friendID	INT,
	PRIMARY KEY (userID, friendID),
	FOREIGN KEY (userID) REFERENCES Users(userID)
);

CREATE TABLE Collections (
	userID		INT,
	postID		INT,
	PRIMARY KEY (userID, postID),
	FOREIGN KEY (userID) REFERENCES Users(userID)
);