<?php
defined("true-access") or die("No script kiddies please!");
include_once("common.php");

/*
* Main function
*/
//list of all the users is viewed by passing the data from the model and showing it on the page
function view($data)
{
		
	startOfPage();
	startContent();
	users_renderLoginForm();
	p("List of all the users in SIT :");
	$users = $data["users"];
	if (!empty($users))
	{
		foreach ($users as $user)
		{
			user_render($user);
		}
	}

	endContent();
	endOfPage();

}

/*
* user layout helpers
*/
function user_render($user)
{
	h3("Name : " .$user['firstname']." ".$user['lastname']);
	echo '<h3>Email : '.$user['email'].'</h3>';
	}


?>