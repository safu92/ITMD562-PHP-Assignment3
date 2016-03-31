<?php

if (!defined("true-access"))
{
	die("cannot access");
}

include_once("common.php");
/*
* database
*/
//enrolling function which inserts the value in database passed by user which is courseid and username
function enroll($courseid, $username)
{
	list($dbc, $error) = connect_to_database();
	
	$courseid_safe = mysqli_real_escape_string($dbc, $courseid); //protect ourselves
	$username_safe = mysqli_real_escape_string($dbc,$username); //protect ourselves
	
	$results = mysqli_query($dbc,"insert into enrollment (username, courseid) values ('".$username_safe."','".$courseid_safe."');");
	
	return $results;
}

//not needed function , as copied from the professor from the example of books application
function purchases_getAll($username)
{
	list($dbc, $error) = connect_to_database();

	$username_safe = mysqli_real_escape_string($dbc,$username); //protect ourselves
	
	$results = mysqli_query($dbc,"select * from purchases join books on purchases.book = books.id where username='$username_safe'");
	
	$allPurchases = array();
	
	if ($results)
	{
		while ($purchase = mysqli_fetch_array($results,MYSQLI_ASSOC))
		{
			$allPurchases[] = $purchase;
		}
	}
	
	return $allPurchases;
}


?>