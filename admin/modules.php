<?php
//This is modules page which allows administrator to enable or disable the components of the website
//There are currently two modules, user and course
define('true-access',true);
include("lib/layout.php");

startOfPage();

//connecting to database
include_once("lib/database.php");
list($dbc,$error) = connect_to_database();
	$coursestatus = array();
	$userstatus = array();
	if ($dbc)
	{	
		$querycourse = "SELECT enabled from modules where name='course'";
		$queryuser = "SELECT enabled from modules where name='user'";
		$result = mysqli_query($dbc,$querycourse);
		if ($result)
		{
			//aha we found you!
			while($course = mysqli_fetch_array($result))
			{
				$coursestatus[] = $course;
			}
		}
		$result = mysqli_query($dbc,$queryuser);
		if ($result)
		{
			//aha we found you!
			while($user = mysqli_fetch_array($result))
			{
				$userstatus[] = $user;
			}
		}
	}

$coursemodule = $coursestatus[0];
$usermodule = $userstatus[0];
//if the user is logged in show the form of components
if(isset($_SESSION['admin'])){
echo '     <div class="container">    																																				';
h1("Admin Panel");
//components form
//the components default value are taken from the database
//if the user change the settings then it is updated in the database
echo '         <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                                                       ';
echo '             <div class="panel panel-info" >                                                                                                                                  ';
echo '                     <div class="panel-heading">                                                                                                                              ';
echo '                         <div class="panel-title">Components Settings</div>                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                     <div style="padding-top:30px" class="panel-body" >                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                         <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                                                               ';
echo '                                                                                                                                                                              ';
echo '                         <form id="loginform" class="form-horizontal" role="form" method="POST" action="#">                                                                                            ';
echo '                                                                                                                                                                              ';
echo ' <div class="checkbox">												';
echo '   <label>                                                            ';
if($coursemodule[0]==1){
$coursechecked = "checked";
}
else{
$coursechecked = null;
}
echo '     <input type="checkbox" name="course" value="" '.$coursechecked.'> Course Component      ';
echo '   </label>                                                           ';
echo ' </div>                                                               ';
echo '                                                                                                                                                                              ';
echo ' <div class="checkbox">												';
echo '   <label>                                                            ';
if($usermodule[0]==1){
$userchecked="checked";
}
else{
$userchecked = null;
}
echo '     <input type="checkbox" name="user" value="" '.$userchecked.'> User Component      ';
echo '   </label>                                                           ';
echo ' </div>                                                               ';
echo '             <input type="hidden"  name="modules"  value="">                                                                                                                                                               ';
echo '                                                                                                                                                                              ';
echo '                                 <div style="margin-top:10px; margin-left:0px;" class="form-group">                                                                                             ';
echo '									<input type="submit" value="Update"/>';
echo '                                 </div>                                                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                                                                                                                                                                              ';
echo '                             </form>                                                                                                                                        ';
echo '                         </div>                                                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '         </div>                                                                                                                                                               ';

//check if the form passing something, if yes then update the database accordingly
if (!empty($_POST)){
   
	
	if ($dbc)
	{	
			if(isset($_POST['course'])){
			$newcourse = 1;
			}
			else{
			$newcourse = 0;
			}
			
			if(isset($_POST['user'])){
			$newuser = 1;
			}
			else{
			$newuser = 0;
			}
		
		$query = "UPDATE modules SET enabled='".$newcourse."' where name='course';";
		$query1 = "UPDATE modules SET enabled='".$newuser."' where name='user';";
		$result = mysqli_query($dbc,$query);
		$result1 = mysqli_query($dbc,$query1);
		if ($result)
		{
			echo "<h2>Course Component Settings Updated!</h2><br/>";	
		}
		if ($result1)
		{
			echo "<h2>User Component Settings Updated!</h2>";	
		}
		echo '<h4>Please Refresh, <a href="modules.php">Click here!</a></h4>';
	}
  }
    }
	
	else
	{
	Die("<h4>You are not logged in! Please login</h4>");
	}
endOfPage();

?>