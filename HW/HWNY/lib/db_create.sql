CREATE TABLE IF NOT EXISTS diff_tool
(
	ID int not null auto_increment,
	LINK varchar(100) not null,
	DATE date not null,
	TIME time not null,
	SHA_1_FILE varchar(45) not null,
	PRIMARY KEY (ID)
)