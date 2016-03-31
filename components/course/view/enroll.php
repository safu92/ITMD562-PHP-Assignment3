<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/
//just a simple page showing the confirmation that the user has been enrolled successfully
function view()
{
	startOfPage();
	users_renderLoginForm();
	h1("Course Enrolled Successfully!");
}

?>