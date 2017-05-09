<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=localhost;dbname=prozzl_test',
	'emulatePrepare' => true,
	'username' => 'prozzl',
	'password' => 'prozzl',
	'charset' => 'utf8',
	
);