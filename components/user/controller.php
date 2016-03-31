<?php
defined("true-access") or die("No script kiddies please!");
//including all the user models and view
include_once("components/course/model/common.php");
include_once("components/user/model/courses_enrolled.php");
include_once("components/user/model/allusers.php");
include_once("components/user/view/common.php");

/**
* User component controller
*/
//function which asks user for the view, if found then it will return view otherwise it will return false
function get_view_enabled($view)
{
	if ($view == "list")
		return "execute_user_list";
	else if ($view == "login")
		return "execute_login";
	else if ($view == "logout")
		return "execute_logout";
	else if ($view == "enrollment")
		return "execute_enrollment";
	else
		return false;
}

function controller_route($view)
{
//getting the name of the view and invoking it as a method
	if ($method = get_view_enabled($view))
	{
		$method(); //dynamic method invocation
	}
	else
	{
		die ("404 not found"); //this could be a view too!
	}
	
}

//getting the list of the users
function execute_user_list()
{
	include_once("view/user_list.php");
	$data = array();
	$data["users"] = user_getAll();
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
//enrollment function allows you to enroll in specific course by passing the username
function execute_enrollment()
{
	include_once("view/courses_enrolled.php");
	$data = array();
	$username = $_SESSION['user'];
	$data["enrolled"] = enrollment_getAll($username);
	view($data);
	
}


?>