<?php
if (!defined("true-access"))
{
	die("cannot access");
}
/*
* common database code
*/

//salt word
define("SALT","safdar");
include("configuration.php"); //including config file created by site itself
//function to connect to database
function connect_to_database()
{
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$error = "";
	
	if ($dbc)
	{
		//good news everyone!
		mysqli_set_charset($dbc,"utf8");
	}
	else
	{
		$error = mysqli_connect_error();
	}
	
	return array($dbc,$error);
}
?>