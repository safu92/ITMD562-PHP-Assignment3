<?php
defined("true-access") or die("No script kiddies please!");

//including all the models and views of course components
include_once("model/common.php");
include_once("model/courses.php");
include_once("model/enroll.php");
include_once("model/users.php");
include_once("view/common.php");

/**
* Course component controller
*/
//getting the view from the get command from user and accordingly returning the string
function get_view_enabled($view)
{
	if ($view == "default")
			return "default_fun";
	else if ($view == "list")
		return "execute_course_list";
	else if ($view == "login")
		return "execute_login";
	else if ($view == "logout")
		return "execute_logout";
	else if ($view == "detail")
		return "execute_course_detail";
	else if ($view == "enroll")
		return "execute_enroll";
	else
		return false;
}

function controller_route($view)
{
//the string returned from above function work as a function
	if ($method = get_view_enabled($view))
	{
		$method(); //dynamic method invocation
	}
	else
	{
		die ("404 not found"); //this could be a view too!
	}
	
}

//executing all the courses list
function execute_course_list()
{
	include_once("view/course_list.php");
	$data = array();
	$data["courses"] = course_getAll();
	view($data);
}
//execute details of all the courses when clicked on any course
function execute_course_detail()
{	
	include_once("view/course_detail.php");
	$data = array();
	$data["courses"] = course_get_detail($courseid);
	view($data);
}
//login function
function execute_login()
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$success = users_checkExists($username,$password);
	execute_course_list(); //view courses after logging in
}
//logout function
function execute_logout()
{
	/*
	* Logout and clear the session submission page
	*/
	session_unset ();
	execute_course_list(); //view courses after logging out
}
//executing enroll function if user enrolled in any course
function execute_enroll()
{
	include_once("view/enroll.php");
	$courseid = $_POST['courseid'];
	$username = $_POST['username'];
	enroll($courseid,$username);
	view();	//this does not pass any variable because it just show a page saying you are enrolled and add an entry to database
}


function default_fun()
{
	include_once("view/default_fun.php");
	view();	
}


?>