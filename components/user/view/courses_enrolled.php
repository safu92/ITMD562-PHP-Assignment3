<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/
//viewing the data of all courses enrolled, the data obtained from model is passed in view and it interprets all the data 
//and show it on the page
function view($data)
{
	startOfPage();

	users_renderLoginForm();
	$enrolledcourses = $data["enrolled"];
	h1("Courses you are enrolled : ");
	foreach($enrolledcourses as $enrolled)
	{
		enrolledcourses_render($enrolled);
	}
	endOfPage();
}

//all the data is showed in header format by passing the name of the enrolled course
function enrolledcourses_render($enrolled)
{
	h3($enrolled['id']." - ".$enrolled['name']);
}

?>