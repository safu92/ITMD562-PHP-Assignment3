<?php
//This file logs out the user and deletes the session
session_start();

//removing the session on loading this page and then redirecting to index page

unset($_SESSION['admin']);
header('Location: index.php');


?>