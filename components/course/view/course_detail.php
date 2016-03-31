<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/
//getting the courseid from the get parameter
$courseid = $_GET['id'];
//viewing the detail of the course by the data passed from the model of course
function view($data)
{
		
	startOfPage();
	startContent();
	users_renderLoginForm();
	p("Detail of the course is as follows : ");
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
//all details of course are mentioned with a link to a id
function courses_render($course)
{
	echo '<a href="index.php?option=course&view=detail&id='.$course['id'].'">';
	h3($course['id']." - ".$course['name']);
	echo '</a>';
	p($course['description']);
	echo "<h5>Credit Hours : ".$course['credithours']."</h5>";
	if (users_loggedIn()) {
		course_renderEnrollmentForm($course); //show a enrollment button if the user is logged in
	}
}
//form to enroll in the database
function course_renderEnrollmentForm($course) {

	echo '<form id="enroll'.$course['id'].'" action="index.php?option=course&view=enroll" method="POST">       '.PHP_EOL;
	echo '	<input name="username" type="hidden" value="'.$_SESSION['user']['username'].'"/>'.PHP_EOL;
	echo '	<input name="courseid" type="hidden" value="'.$course['id'].'"/>'.PHP_EOL;
	echo '	<input type="submit" value="Enroll"/>                     '.PHP_EOL;
	echo '</form> ';    
}


?>