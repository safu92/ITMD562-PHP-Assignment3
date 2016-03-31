<?php

if (!defined("true-access"))
{
	die("cannot access");
}

//include_once("common.php");
/*
* database
*/
//getting the list of all the courses enrolled by the logged in user, it takes the username as argument and return
//the courses enrolled from the database as follows
function enrollment_getAll($username)
{
	list($dbc, $error) = connect_to_database();

	$username_safe = mysqli_real_escape_string($dbc,$username['username']); //protect ourselves
	$results = mysqli_query($dbc,"select * from courses join enrollment on courses.id = enrollment.courseid where username='".$username_safe."'");
	
	$allEnrollments = array();
	
	if ($results)
	{
		while ($enrollment = mysqli_fetch_array($results,MYSQLI_ASSOC))
		{
			$allEnrollments[] = $enrollment;
		}
	}
	
	return $allEnrollments;
}


?>