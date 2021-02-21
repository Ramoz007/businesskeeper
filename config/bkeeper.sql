CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `clients_contacts` (
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
);