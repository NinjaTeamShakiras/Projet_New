<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',

	'connectionString' => 'mysql:host=localhost;dbname=prozzl_test',
	'emulatePrepare' => true,
	'username' => 'prozzl',
	'password' => 'prozzl',
	'charset' => 'utf8',
);