CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

create table IF NOT EXISTS component_type (
  id_component_type int (10) AUTO_INCREMENT,
  pc_part_type varchar (20) NOT NULL,
  PRIMARY KEY (id_component_type)
);

create table IF NOT EXISTS stock (
  id_stock int AUTO_INCREMENT,
  name varchar (60) NOT NULL,
  quantity_avaible smallint unsigned NOT NULL,
  price mediumint unsigned NOT NULL,
  id_component_type int NOT NULL,
  PRIMARY KEY (id_stock),
  FOREIGN KEY (id_component_type) REFERENCES component_type (id_component_type) ON DELETE CASCADE ON UPDATE CASCADE
);

create table IF NOT EXISTS client (
  id_client int AUTO_INCREMENT,
  email varchar (60) NOT NULL,
  last_name varchar (50) NOT NULL,
  name varchar (50) NOT NULL,
  password varchar (256) NOT NULL,
  birth_date date NOT NULL,
  account_number varchar(15) NOT NULL,
  PRIMARY KEY (id_client)
);

create table IF NOT EXISTS necessary_improvement (
  id_necessary_improvement int AUTO_INCREMENT,
  id_component_type int NOT NULL,
  id_client int NOT NULL,
  PRIMARY KEY (id_necessary_improvement),
  FOREIGN KEY (id_component_type) REFERENCES component_type (id_component_type) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_client) REFERENCES client (id_client) ON DELETE CASCADE ON UPDATE CASCADE
);

create table IF NOT EXISTS position (
  id_position int AUTO_INCREMENT,
  position varchar (60) NOT NULL,
  PRIMARY KEY (id_position)
);

create table IF NOT EXISTS employee (
  id_employee int AUTO_INCREMENT,
  last_name varchar (50) NOT NULL,
  name varchar (50) NOT NULL,
  id_position int NOT NULL,
  PRIMARY KEY (id_employee),
  FOREIGN KEY (id_position) REFERENCES position (id_position) ON DELETE CASCADE ON UPDATE CASCADE
);

create table IF NOT EXISTS order_status (
  id_order_status int AUTO_INCREMENT,
  status varchar (40) NOT NULL,
  PRIMARY KEY (id_order_status)
);

create table IF NOT EXISTS orders (
  id_order int AUTO_INCREMENT,
  id_client int NOT NULL,
  id_employee int NOT NULL,
  id_order_status int NOT NULL,
  total_price mediumint unsigned NOT NULL,
  PRIMARY KEY (id_order),
  FOREIGN KEY (id_client) REFERENCES client (id_client) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_employee) REFERENCES employee (id_employee) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_order_status) REFERENCES order_status (id_order_status) ON DELETE CASCADE ON UPDATE CASCADE
);

create table IF NOT EXISTS warranty_certificate (
  id_warranty_certificate int AUTO_INCREMENT,
  id_order int NOT NULL,
  valid_until date NOT NULL,
  PRIMARY KEY (id_warranty_certificate),
  FOREIGN KEY (id_order) REFERENCES orders (id_order) ON DELETE CASCADE ON UPDATE CASCADE
);

  INSERT INTO component_type (pc_part_type) VALUES
  ('CPU'),
  ('GPU'),
  ('Motherboard'),
  ('PSU'),
  ('RAM'),
  ('CPU cooler'),
  ('Case'),
  ('SSD'),
  ('HDD'),
  ('Fan');

  INSERT INTO stock (name, quantity_avaible, price, id_component_type) VALUES
  ('AMD Ryzen 5 5600X OEM', '7', '16540', '1'),
  ('AMD Ryzen 5 7600X OEM', '4', '27320', '1'),
  ('NVIDIA GeForce RTX 3060 Ti Gigabyte 8Gb', '10', '53500', '2'),
  ('NVIDIA GeForce RTX 4070 MSI 12Gb', '5', '73620', '2'),
  ('MSI B550-A PRO', '9', '12240', '3'),
  ('ASUS TUF GAMING X670E-PLUS', '5', '35150', '3'),
  ('1000W ASUS TUF Gaming 1000W Gold', '12', '18840', '4'),
  ('750W ASUS TUF Gaming 750B', '8', '11510', '4'),
  ('32Gb DDR4 3200MHz Kingston Fury Beast Black', '15', '8700', '5'),
  ('64Gb DDR4 3200MHz Kingston Fury Beast Black', '7', '15780', '5'),
  ('Be Quiet Dark Rock 4', '8', '9250', '6'),
  ('ID-COOLING SE-224-XTS BLACK', '6', '2260', '6'),
  ('Be Quiet Pure Base 500DX Black', '10', '15400', '7'),
  ('Be Quiet Dark Base 700 RGB LED Black', '5', '23340', '7'),
  ('SSD 1Tb Samsung 970 EVO Plus', '13', '7860', '8'),
  ('SSD 500Gb Samsung 870 EVO', '15', '4360', '8'),
  ('1Tb SATA-III WD Caviar Blue', '10', '4980', '9'),
  ('2Tb SATA-III Seagate Barracuda', '15', '6800', '9'),
  ('Noctua NF-A20 PWM', '5', '4910', '10'),
  ('Cooler Master SickleFlow 200 ARGB', '15', '2850', '10');

  INSERT INTO client (email, last_name, name, password, birth_date, account_number) VALUES
  ('sidorova_ya@gmail.com', 'Sidorova', 'Yaroslava', 'VSk0Ubko63Kgife', '2008-05-20', '408944605705214'),
  ('ponomarev_denis@gmail.com', 'Ponomarev', 'Denis', 'U5DQ7WHoVQJObfz', '2009-03-04', '533745368893800'),
  ('andrianova_amelia@gmail.com', 'Andrianova', 'Amelia', 'bD1lhsqdmLcQWlf', '2004-02-18', '503431001436713'),
  ('alex_ulianov@gmail.com', 'Ulyanov', 'Alexey', 'GBXNa1FFtp3OoDq', '2014-02-09', '372451268737257'),
  ('volkova_daria@gmail.com', 'Volkova', 'Daria', 'IPcgpEtRxo4mPd7', '2008-02-01', '881001551593627'),
  ('popova_polina@gmail.com', 'Popova', 'Polina', 'yoV98cMxlKhQW34', '2016-01-25', '384777941732795'),
  ('davidova_avrora@gmail.com', 'Davydova', 'Aurora', 'rbopFUuvyeXASef', '2003-03-09', '584919950490251'),
  ('litvionova_mariana@gmail.com', 'Litvinova', 'Mariana', 'OEPQFHNcyq3B8qN', '2001-11-27', '649938077789596'),
  ('burova_alice@gmail.com', 'Burova', 'Alice', 'l1OilkQCfXt7cw6', '2007-09-16', '333068229868840'),
  ('fomina_alice@gmail.com', 'Fomina', 'Alice', 'VCr4Bl185fuJWfL', '2008-11-23', '149630169120056');

  INSERT INTO necessary_improvement (id_component_type, id_client) VALUES
  ('1', '1'),
  ('3', '1'),
  ('6', '1'),
  ('9', '1'),
  ('5', '2'),
  ('2', '3'),
  ('7', '4'),
  ('8', '4'),
  ('10', '4'),
  ('4', '5'),
  ('3', '6'),
  ('5', '6'),
  ('8', '7'),
  ('9', '7'),
  ('2', '8'),
  ('4', '9'),
  ('5', '9'),
  ('7', '9'),
  ('10', '9'),
  ('1', '10');

  INSERT INTO position (position) VALUES
  ('manager'),
  ('senior specialist'),
  ('junior specialist'),
  ('database administrator'),
  ('technical specialist');

  INSERT INTO employee (last_name, name, id_position) VALUES
  ('Kurlyandskaya', 'Natalya', '1'),
  ('Voronov', 'Nikolay', '2'),
  ('Novikov', 'Roman', '3'),
  ('Usov', 'Aleksandr', '3'),
  ('Solovyev', 'Matvey', '2'),
  ('Frolov', 'Ilya', '4'),
  ('Karpov', 'Grigoriy', '5'),
  ('Vinogradov', 'Mark', '5'),
  ('Zakharov', 'Egor', '2'),
  ('Vasiliev', 'Leonid', '2');

  INSERT INTO order_status (status) VALUES
  ('No status'),
  ('In line'),
  ('Accepted by the specialist'),
  ('In the process of upgrading'),
  ('Upgrade accomplished'),
  ('Sent'),
  ('Delivered');

  INSERT INTO orders (id_client, id_employee, id_order_status, total_price) VALUES
  ('1', '2', '4', '43010'),
  ('3', '2', '3', '73620'),
  ('5', '3', '6', '18840'),
  ('2', '5', '4', '15780'),
  ('10', '4', '7', '27320'),
  ('7', '4', '5', '12840'),
  ('9', '3', '4', '47600'),
  ('8', '9', '4', '53500'),
  ('6', '9', '3', '50930'),
  ('4', '10', '4', '32610');

  INSERT INTO warranty_certificate (id_order, valid_until) VALUES
  ('5', '2024-06-07'),
  ('3', '2024-05-12'),
  ('6', '2024-03-15'),
  ('1', '2025-01-01'),
  ('4', '2024-10-23'),
  ('7', '2024-09-28'),
  ('8', '2025-01-04'),
  ('10', '2024-11-20');