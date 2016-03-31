<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/

//when the user does not pass and component and view so it goes to default view which is just a login form
function view()
{
	startOfPage();
	users_renderLoginForm();
	h1("Controllers :");
	echo '<a href="index.php?option=course&view=list">';
	p("Course Controller");
	echo '</a>';
	echo '<a href="index.php?option=user&view=list">';
	p("User Controller");
	echo '</a>';
}

?>