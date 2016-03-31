<?php
defined("true-access") or die("No script kiddies please!");

/*
* common layout
*/
//starting of the page
function startOfPage()
{
include_once("components/course/model/common.php");
//connecting to database to get the site name and sub title as follows
list($dbc,$error) = connect_to_database();
if($dbc){
	$sitename= array();
	$subtitle = array();
	$query = "SELECT sitename from settings";
	$querysubtitle = "SELECT subtitle from settings";
	$result = mysqli_query($dbc,$query);
	$resultsubtitle = mysqli_query($dbc,$querysubtitle);
	if ($result)
		{
			while ($site = mysqli_fetch_array($result))
			{
				$sitename = $site;
			}
		}	
	if ($resultsubtitle)
	{
		while ($sub = mysqli_fetch_array($resultsubtitle))
			{
				$subtitle = $sub;
			}
		}
	
	echo '<!doctype html> '.PHP_EOL;
	echo '<html><head>          '.PHP_EOL;
	echo '<title>'.$sitename[0].'</title>'; //the subtitle obtained is used as title in browser
	echo ' <link rel="stylesheet" type="text/css" href="content/css/bootstrap.css">';
	echo '<center><h1>'.$sitename[0].'</h1>'; //sitename showing on top of every page
	echo '<h3>'.$subtitle[0].'</h3>'; //subtitle showing on top of every page
	
	//menu buttons
	echo '<a href="index.php"><button type="button" class="btn btn-primary">Home</button></a>&nbsp;';
	echo '<a href="index.php?option=course&view=list"><button type="button" class="btn btn-primary">Course List</button></a>&nbsp;';
	echo '<a href="index.php?option=user&view=list"><button type="button" class="btn btn-primary">User List</button></a>&nbsp;';
	if(isset($_SESSION['user'])){
	echo '<a href="index.php?option=user&view=enrollment"><button type="button" class="btn btn-primary">My Enrolled Courses</button></a>&nbsp;';
	echo '<a href="index.php?option=course&view=logout"><button type="button" class="btn btn-primary">Logout</button></a>';
	}
	echo '</center></head>         '.PHP_EOL;
	echo '<body><div style="margin-right:100px;margin-left:100px">          '.PHP_EOL;
}
}
//end of page
function endOfPage()
{
	echo '</div></body> '.PHP_EOL;
	echo '</html> '.PHP_EOL;
}
//start content
function startContent()
{
	echo '<article>'.PHP_EOL;
}
//end content
function endContent()
{
	echo '</article>'.PHP_EOL;
}
//start aside
function startAside()
{
	echo '<aside>'.PHP_EOL;
}
//endaside
function endAside()
{
	echo '</aside>'.PHP_EOL;
}
//header function with h1
function h1($content)
{
	echo "<h1>".$content."</h1>".PHP_EOL;
}
//header function with h3
function h3($content)
{
	echo "<h3>".$content."</h3>".PHP_EOL;
}
//header function with h2
function h2($content)
{
	echo "<h2>".$content."</h2>".PHP_EOL;
}
//paragraph function
function p($content)
{
	echo "<p>".$content."</p>".PHP_EOL;
}
//if logged in then return true
function users_loggedIn()
{
	return (isset($_SESSION['user']));
}

function users_username()
{
	
}
//user login form
function users_renderLoginForm()
{
//if not logged in
	if (!users_loggedIn()) {
//show login form	
	echo '         <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                                                       ';
echo '             <div class="panel panel-info" >                                                                                                                                  ';
echo '                     <div class="panel-heading">                                                                                                                              ';
echo '                         <div class="panel-title">Sign In</div>                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                     <div style="padding-top:30px" class="panel-body" >                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                         <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                                                               ';
echo '                                                                                                                                                                              ';
echo '                         <form id="loginform" class="form-horizontal" role="form" method="POST" action="index.php?option=course&view=login">                                                                                            ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>                                                      ';
echo '                                         <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                ';                        
echo '                                     </div>                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>                                                      ';
echo '                                         <input id="login-password" type="password" class="form-control" name="password" placeholder="password">                              ';
echo '                                     </div>                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                                 <div style="margin-top:10px; margin-left:0px;" class="form-group">                                                                                             ';
echo '									<input type="submit" value="Login"/>';
echo '                                 </div>                                                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                                                                                                                                                                              ';
echo '                             </form>                                                                                                                                        ';
echo '                         </div>                                                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '         </div>        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>                                                                                                                                                       ';
	
		
	}
	else
	{
//if logged in
		p("Welcome user!");
		
	}
}


?>