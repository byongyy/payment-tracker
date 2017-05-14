DROP DATABASE IF EXISTS iou;

CREATE DATABASE IF NOT EXISTS iou;

Use iou;

DROP TABLE IF EXISTS payment;
CREATE TABLE IF NOT EXISTS payment
(
	Users CHAR(50) NOT NULL,
	Owers CHAR(50) NOT NULL,
	Description VARCHAR(140) NOT NULL,
	Amount FLOAT NOT NULL,	
	PRIMARY KEY(Users, Owers, Description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 collate=utf8_general_ci;

INSERT INTO payment (Users, Owers, Description, Amount) VALUES ("", "", "Initialization", 0);