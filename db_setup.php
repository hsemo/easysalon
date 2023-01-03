<?php

// this is a one time setup file
// just run this file once and it will create 
// the necessary database and tables.

require("dbcon.php");

con_close();
create_con($db='');

// database creation
$qry = "CREATE DATABASE easysalon;";
$result = query($qry);
echo "Database created</br>";

$con->select_db('easysalon');
echo "Database selected.</br>";

// users table creation
$qry = "CREATE TABLE users(
id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
CONSTRAINT U_email UNIQUE (email)
);";
// "CONSTRAINT U_email UNIQUE (email)" so that the user can not enter duplicate email

$result = query($qry);
echo "users table created.</br>";

// admins table creation
$qry = "CREATE TABLE admins LIKE users;";
$result = query($qry);
echo "admins table created.</br>";

// salons table creation
$qry = "CREATE TABLE salons(
id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
salon_name VARCHAR(200) NOT NULL,
address VARCHAR(100) NOT NULL,
owner_name VARCHAR(30) NOT NULL,
mobile VARCHAR(10) NOT NULL,
CONSTRAINT U_name UNIQUE (name)
);";
$result = query($qry);
echo "salons table created.</br>";

// appointments table creation
$qry = "CREATE TABLE appointments(
id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_email VARCHAR(50) NOT NULL,
salon_name VARCHAR(200) NOT NULL,
time TIMESTAMP NOT NULL
);";
$result = query($qry);
echo "appointments table created.</br>";

con_close();
?>