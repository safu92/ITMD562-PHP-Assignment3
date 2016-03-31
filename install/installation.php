<?php
define("true-access",true);
//function to connect to database
function connect_to_database($dbhost,$dbuser,$dbpass,$database)
{
	$dbc = mysqli_connect($dbhost,$dbuser,$dbpass,$database);
	$error = "";
	
	if ($dbc)
	{
		//good news everyone!
		mysqli_set_charset($dbc,"utf8");
	}
	else
	{
		$error = mysqli_connect_error();
	}
	
	return array($dbc,$error);
}
//form asking user to enter db host,db user,db pass and db name
echo '<html>';
echo '<title> Safdars Blackboard Script </title>';
echo '<head>';
echo '<link rel="stylesheet" type="text/css" href="../content/css/bootstrap.css">';
echo '</head>';
echo '<body>';
echo '     <div class="container">    																																				';
echo '         <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                                                       ';
echo '             <div class="panel panel-info" >                                                                                                                                  ';
echo '                     <div class="panel-heading">                                                                                                                              ';
echo '                         <div class="panel-title">Configuration Details</div>                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                     <div style="padding-top:30px" class="panel-body" >                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                         <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                                                               ';
echo '                                                                                                                                                                              ';
echo '                         <form id="loginform" class="form-horizontal" role="form" method="POST" action="#">                                                                                            ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Database Host</span>                                                      ';
echo '                                         <input id="hostname" type="text" class="form-control" name="hostname" value="" placeholder="">                ';                        
echo '                                     </div>                                                                                                                                   ';
echo '                                                                                                                                                                              ';
echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Database Name</span>                                                      ';
echo '                                         <input id="databasename" type="text" class="form-control" name="databasename" placeholder="">                              ';
echo '                                     </div>                                                                                                                                   ';


echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Username</span>                                                      ';
echo '                                         <input id="username" type="text" class="form-control" name="username" placeholder="">                              ';
echo '                                     </div>                                                                                                                                   ';
echo '                                                                                                                                                                              ';

echo '                             <div style="margin-bottom: 25px" class="input-group">                                                                                            ';
echo '                                         <span class="input-group-addon">Password</span>                                                      ';
echo '                                         <input id="password" type="text" class="form-control" name="password" placeholder="">                              ';
echo '                                     </div>                                                                                                                                   ';
echo '                                 <div style="margin-top:10px; margin-left:0px;" class="form-group">                                                                                             ';
echo '									<input type="submit" value="Install"/>';
echo '                                 </div>                                                                                                                                       ';
echo '                                                                                                                                                                              ';
echo '                                                                                                                                                                              ';
echo '                             </form>                                                                                                                                        ';
echo '                         </div>                                                                                                                                               ';
echo '                     </div>                                                                                                                                                   ';
echo '         </div>                                                                                                                                                               ';
    

echo '</body>';
echo '</html>';

//on clicking install if all value is set
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['databasename']) && isset($_POST['hostname'])){
$username = $_POST['username']; //db user
$password = $_POST['password']; //db pass
$databasename = $_POST['databasename']; //db name
$hostname = $_POST['hostname']; //host name
//it connect to database with all detail passed by user
list($dbc,$error) = connect_to_database($hostname,$username,$password,$databasename);
//create config variable with details
$config = '<?php
define("DB_HOST","'.$hostname.'");
define("DB_USER","'.$username.'");
define("DB_PASSWORD","'.$password.'");
define("DB_NAME","'.$databasename.'");
?>
';
//if connection successful then write the configuration php file with config variable created above
		if ($dbc){
		file_put_contents("../configuration.php", 
		$config.PHP_EOL,
		LOCK_EX);
		//after writing the file show alert message and include tables file where all the database table will be installed
		echo '<script>alert("Connection Established! Your website will be setup in the next step.");</script>';
	include("tables.php");
		}
		else{
		//else print out the error
		echo $error;
		}
}
?>