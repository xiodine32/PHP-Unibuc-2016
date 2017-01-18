CREATE TABLE books
(
  id          INT(11) PRIMARY KEY                                                                                                                           NOT NULL AUTO_INCREMENT,
  category_id INT(11)                                                                                                                                       NOT NULL,
  user_id     INT(11)                                                                                                                                       NOT NULL,
  title       TEXT                                                                                                                                          NOT NULL,
  link        TEXT                                                                                                                                          NOT NULL,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP                                                                                                            NOT NULL,
  thumbnail   VARCHAR(255) DEFAULT 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==' NOT NULL,
  CONSTRAINT books_categories_id_fk FOREIGN KEY (category_id) REFERENCES categories (id)
    ON DELETE CASCADE,
  CONSTRAINT books_users_id_fk FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
CREATE INDEX books_categories_id_fk
  ON books (category_id);
CREATE INDEX books_users_id_fk
  ON books (user_id);
CREATE TABLE caches
(
  id         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  value      LONGBLOB            NOT NULL,
  name       VARCHAR(255)        NOT NULL,
  expires_at DATETIME            NOT NULL
);
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
CREATE TABLE settings
(
  id    INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name  VARCHAR(255)        NOT NULL,
  value TEXT                NOT NULL
);
CREATE UNIQUE INDEX settings_name_uindex
  ON settings (name);
CREATE TABLE statistics
(
  id              INT(11) PRIMARY KEY                NOT NULL AUTO_INCREMENT,
  request_method  VARCHAR(10)                        NOT NULL,
  query_string    TEXT                               NOT NULL,
  http_referer    TEXT,
  http_user_agent TEXT                               NOT NULL,
  remote_addr     TEXT                               NOT NULL,
  request_uri     VARCHAR(100)                       NOT NULL,
  created_at      DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  session_id      VARCHAR(60)
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