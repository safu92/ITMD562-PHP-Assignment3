<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/
//function to view the courses list by passing the data into the view obtained from the model
function view($data)
{
		
	startOfPage();
	startContent();
	users_renderLoginForm();
p("Following are the courses offered at SIT :");
	$courses = $data["courses"];
	if (!empty($courses))
	{
		foreach ($courses as $course)
		{
			courses_render($course);
		}
	}

	endContent();
	endOfPage();

}

/*
* course layout helpers
*/
//displaying the courses list and description
function courses_render($course)
{
	echo '<a href="index.php?option=course&view=detail&id='.$course['id'].'">';
	h3($course['id']." - ".$course['name']);
	echo '</a>';
	p($course['description']);
	//echo "<h5>Credit Hours : ".$course['credithours']."</h5>";
	
}


?>