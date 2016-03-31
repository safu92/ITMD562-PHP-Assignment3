<?php
//This is index page which allows administrator to change name of the website and subtitle
define('true-access',true);
include("lib/layout.php");

startOfPage();

//connecting to the database for the settings
include_once("lib/database.php");
list($dbc,$error) = connect_to_database();
	$modules = array();
	if ($dbc)
	{	
		$querysitename = "SELECT sitename from settings";
		$querysubtitle = "SELECT subtitle from settings";
		$result = mysqli_query($dbc,$querysitename);
		if ($result)
		{
			//aha we found you!
			while($name = mysqli_fetch_array($result))
			{
				$sitename = $name;
			}
		}
		$result = mysqli_query($dbc,$querysubtitle);
		if ($result)
		{
			//aha we found you!
			while($title = mysqli_fetch_array($result))
			{
				$subtitle = $title;
			}
		}
		$query = "SELECT * from modules";
		$result = mysqli_query($dbc,$query);
		
		if ($result)
		{
			//aha we found you!
			while($module = mysqli_fetch_array($result))
			{
				$modules[] = $module;
			}
		}
	}
//echo $modules;

$websitename = $sitename[0];
$websitetitle = $subtitle[0];
if(isset($_SESSION['admin'])){
echo '     <div class="container">    																																				';
h1("Admin Panel");
//Settings form
//it shows the default value from the database and if user change the value
//it updates the database with the new values
echo '         <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                                                       ';
echo '             <div class="panel panel-info" >                                                                                                                                  ';
echo '                     <div class="panel-heading">                                                                                                                              ';
echo '                         <div class="panel-title">Website Settings</div>                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                     <div style="padding-top:30px" class="panel-body" >                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                         <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                                                               ';
echo '                                                                                                                                                                              ';
echo '                         <form id="loginform" class="form-horizontal" role="form" method="POST" action="#">                                                                                            ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Site Name : </span>                                                      ';
echo '                                         <input id="sitename" type="text" class="form-control" name="sitename" value="'.$websitename.'" placeholder="'.$websitename.'">                ';                        
echo '                                     </div>                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Sub Title : </span>                                                      ';
echo '                                         <input id="subtitle" type="text" class="form-control" name="subtitle" value="'.$websitetitle.'" placeholder="'.$websitetitle.'">                              ';
echo '                                     </div>                                                                                                                                   ';
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
//if the form is passing something, then update the database with the new values
if (isset($_POST['sitename']) || isset($_POST['subtitle'])) {
   
	
	if ($dbc)
	{
		$newsitename = $_POST['sitename'];
		$newsubtitle = $_POST['subtitle'];
		$sitename_safe = mysqli_real_escape_string($dbc,$newsitename);
		$subtitle_safe = mysqli_real_escape_string($dbc,$newsubtitle);
		$query = "UPDATE settings SET sitename='".$sitename_safe."'";
		$query1 = "UPDATE settings SET subtitle='".$subtitle_safe."'";
		$result = mysqli_query($dbc,$query);
		$result1 = mysqli_query($dbc,$query1);
		if ($result)
		{
			echo "<h2>Site Name Updated!</h2><br/>";	
		}
		if ($result1)
		{
			echo "<h2>Sub Title Updated!</h2>";	
		}
		echo '<h4>Please Refresh, <a href="settings.php">Click here!</a></h4>';
	}
  }
    }
	
	else
	{
	Die("<h1>You are not logged in! Please login</h1>");
	}
endOfPage();

?>