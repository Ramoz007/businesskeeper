CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(16) NOT NULL,
  PRIMARY KEY (`client_id`)
);

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`contact_id`)
);

CREATE TABLE `clients_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  FOREIGN KEY (`client_id`)
        REFERENCES `clients`(`client_id`)
        ON DELETE CASCADE,
  FOREIGN KEY (`contact_id`)
      REFERENCES `contacts`(`contact_id`)
      ON DELETE CASCADE,
  PRIMARY KEY (`id`)
);