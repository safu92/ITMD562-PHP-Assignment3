<?php
if (!defined("true-access"))
{
	die("cannot access");
}
//include_once("common.php");
/*
* database
*/
//getting all the list of users and returning in array as follows
function user_getAll()
{
	$users = array();
	list($dbc,$error) = connect_to_database();
	if ($dbc)
	{
		$query = "SELECT firstname,lastname,email from user;";
		
		
		$result = mysqli_query($dbc,$query);
		if ($result)
		{
			while ($user = mysqli_fetch_array($result))
			{
				$users[] = $user;
			}
		}
	}
	return $users;
}
//getting course details of each course by passing course id and returning courses in an array as follows
function course_get_detail($courseid)
{
	$courses = array();
	list($dbc,$error) = connect_to_database();
	if ($dbc)
	{
		$query = "SELECT * from courses WHERE id='".$courseid."';";
		
		
		$result = mysqli_query($dbc,$query);
		if ($result)
		{
			while ($course = mysqli_fetch_array($result))
			{
				$courses[] = $course;
			}
		}
	}
	return $courses;
}

?>