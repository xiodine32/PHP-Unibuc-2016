# Create SQL Query

CREATE TABLE categories
(
  id        INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name      TEXT                NOT NULL,
  parent_id INT(11),
  CONSTRAINT categories_categories_id_fk FOREIGN KEY (parent_id) REFERENCES categories (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
CREATE INDEX categories_categories_id_fk
  ON categories (parent_id);


CREATE TABLE roles
(
  id   INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name TEXT                NOT NULL
);


CREATE TABLE userroles
(
  user_id INT(11) NOT NULL,
  role_id INT(11) NOT NULL
);


CREATE TABLE users
(
  id       INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name     TEXT                NOT NULL,
  email    VARCHAR(64)         NOT NULL,
  password VARCHAR(64)         NOT NULL
);
CREATE UNIQUE INDEX email
  ON users (email);