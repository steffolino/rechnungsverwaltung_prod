<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=localhost;dbname=rechnungstool',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'schemaCachingDuration' =>'10',
	
	/*
	'connectionString' => 'mysql:host=mysql1.000webhost.com;dbname=a7235298_rechnun',
	'emulatePrepare' => true,
	'username' => 'a7235298_stef',
	'password' => 'iLoveJVA88!',
	'charset' => 'utf8',
	
	/**
	$mysql_host = "mysql1.000webhost.com";
	$mysql_database = "a7235298_rechnun";
	$mysql_user = "a7235298_stef";
	$mysql_password = "iLoveJVA88!";
	**/
);