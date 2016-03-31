<?php
//This is layout file in which layout functions are written which are used in all the admin pages
 if(!defined('true-access')) {
    die('Direct access not permitted');
}
session_start();
//starting function
function startOfPage()
{
echo '<!doctype html> '.PHP_EOL;
echo '<html>          '.PHP_EOL;
echo '<head>          '.PHP_EOL;
echo '<title>Admin Panel - Safdar\'s Blogging Platform</title>';
echo '<link rel="stylesheet" type="text/css" href="content/css/bootstrap.css">';

 
echo ' <style type="text/css">';
echo ' body {                 ';
echo '   padding-top: 20px;   ';
echo '   padding-bottom: 40px;';
echo ' }                      ';

 echo '.container-narrow {				';
 echo '       margin: 0 auto;           ';
 echo '       max-width: 700px;         ';
 echo '     }                           ';
 echo '     .container-narrow > hr {    ';
 echo '       margin: 30px 0;           ';
 echo '     }                           ';
echo '</style>                        ';



echo '</head>         '.PHP_EOL;
echo '<body>          '.PHP_EOL;

echo  '<div class="container-narrow">';
echo '       <div class="masthead"> ' ;
echo '  <ul class="nav nav-pills pull-right">						';
if(!isset($_SESSION['admin'])){
echo '  <li class="active"><a href="index.php">Login</a></li>    ';
}
echo '  <li class="active"><a href="settings.php">Settings</a></li>    ';
echo '  <li class="active"><a href="modules.php">Components</a></li>    ';
if(isset($_SESSION['admin'])){
echo '  <li class="active"><a href="logout.php">Logout</a></li>    ';
}
echo '  </ul>                                           ';
echo ' </div></div> ' ;

}
//ending function
function endOfPage()
{

echo '</body> '.PHP_EOL;
echo '</html> '.PHP_EOL;

}

//header function
function h1($content, $class="")
{
echo "<h1 class='$class'>$content</h1>";
}


?>