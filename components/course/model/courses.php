<?php
if (!defined("true-access"))
{
	die("cannot access");
}
include_once("common.php");
/*
* database
*/
//getting the list of all the courses from the database as follows
function course_getAll()
{
	$courses = array();
	list($dbc,$error) = connect_to_database();
	if ($dbc)
	{
		$query = "SELECT * from courses;";
		
		
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
//getting the detail of a single course as follows by passing the course id
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