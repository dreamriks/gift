/*
    Creation of table for operators and admins
*/
CREATE TABLE IF NOT EXISTS #__im_operators (
  operator_id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(11) unsigned NOT NULL,
  num_posts int(11) unsigned NOT NULL DEFAULT 0,
  last_post timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  rank int(1) unsigned NOT NULL,
  status int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (operator_id)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
    Creation of table for posts
*/
CREATE TABLE IF NOT EXISTS #__im_posts (
  post_id int(11) unsigned NOT NULL AUTO_INCREMENT,
  ticket_id int(11) unsigned NOT NULL,
  post_body text COLLATE utf8_unicode_ci NOT NULL,
  post_order int(11) unsigned NOT NULL,
  cdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  post_author_id int(11) unsigned NOT NULL,
  PRIMARY KEY (post_id)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*
    Creation of table for tickets
*/
CREATE TABLE IF NOT EXISTS #__im_tickets (
  ticket_id int(11) unsigned NOT NULL AUTO_INCREMENT,
  ticket_number varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  author_id int(11) unsigned NOT NULL,
  order_id int(11) unsigned DEFAULT NULL,
  ticket_subject varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  cdate datetime NOT NULL,
  mdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  open int(1) NOT NULL DEFAULT 1,
  status int(1) unsigned NOT NULL DEFAULT 1,
  num_posts int(11) NOT NULL DEFAULT 1,
  resolved int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (ticket_id),
  UNIQUE KEY ticket_number (ticket_number)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
