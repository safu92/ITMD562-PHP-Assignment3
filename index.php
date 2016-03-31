<?php
define("true-access", true);
session_start();
ob_start();

//this will check if the configuration file exists or not
if (file_exists("configuration.php")){
//if it exist then it will check if install folder exist or not, if it does not exist it will go in the block below
 if(!file_exists("install")) {
//the function which checks for the enabled modules in the database, there are two modules: user and course
//which are enabled by default in the beginning
//you can disable it from the admin panel
function get_option_enabled($option)
{
include("components/course/model/common.php");
list($dbc,$error) = connect_to_database();
	$coursestatus = array(); //course array
	$userstatus = array(); //user array
	if ($dbc)
	{	//running module queries
		$querycourse = "SELECT enabled from modules where name='course'";
		$queryuser = "SELECT enabled from modules where name='user'";
		$result = mysqli_query($dbc,$querycourse);
		if ($result)
		{
			//if got result
			while($course = mysqli_fetch_array($result))
			{
			//take the result value and add to a variable
				$coursestatus[] = $course;
			}
		}
		$result = mysqli_query($dbc,$queryuser);
		if ($result)
		{
			//user module result
			while($user = mysqli_fetch_array($result))
			{
			//user module value we got from result is added to variable
				$userstatus[] = $user;
			}
		}
	}
	
$coursemodule = $coursestatus[0]; //assigning the value to a variable
$usermodule = $userstatus[0]; //assigning the value to a variable

//if the user is asking for a course component 
	if ($option == "course")
	{
	//it checks if the course component is enabled or not
		if($coursemodule[0] == 1){
		return "course/controller.php";
		}
		else{
		return false;
		}
	}
	//if the user is asking for a user component 
	else if ($option == "user")
	{
	//it checks if the user component is enabled or not
		if($usermodule[0] == 1){
		return "user/controller.php";
		}
		else{
		return false;
		}
	}
	
	else
		return false;
}

//A Basic Router Function
//requires registering components and their router files
function route()
{
		//get query params from header and the default value is option is course and view is default
		$option = empty($_GET["option"]) ? "course" : $_GET["option"];
		$view = empty($_GET["view"]) ? "default" : $_GET["view"];
		
		//get files to include from database
		if ($controller = get_option_enabled($option))
		{
			//include correct router
			include_once('components/'.$controller);
			controller_route($view); //router in controller should execute for a particular view - router in controller should implement function router_route($view)
		}
		else
		{
			die("404 - No Controller for specified option"); //no controller found
		}
}

//invoke basic router - the starting point of the journey
route();
}
//if configuration file is found and install directory also found, it will die printing the following
else
{
die("<h1>Install directory not deleted</h1>");
}
}//if configuration file is not found it assumes that website is not installed so it will redirect to install page
else{
echo '<script>window.location = "install/";</script>';
}

ob_end_flush();


?>