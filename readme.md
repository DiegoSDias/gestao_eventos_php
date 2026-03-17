USE crud_gestao_eventos;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100),
	email VARCHAR(100),
	password VARCHAR(255),
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

CREATE TABLE events (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(100),
	description text,
	event_date DATETIME,
	location VARCHAR(100),
	created_at TIMESTAMP,
	number_registrations int,
	created_by INT, 
	updated_at TIMESTAMP,
	FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE registrations (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id int,
	event_id int,
	registration_date DATETIME,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (event_id) REFERENCES EVENTS(id)
);