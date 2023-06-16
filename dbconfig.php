<?php
date_default_timezone_set('Asia/Calcutta');
error_reporting(0);
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ams'); 

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($con === false){
    die("<h1 style='color:red;'>Error: Could not connect to the database.</h1>");
}
error_reporting(E_ALL);
$uri = strtolower($_SERVER['REQUEST_URI']);

if(substr($uri,1,3) != "api")
{
    if($_SESSION['user_id'] == ""){
        header("location: /?q=auth");
    }
    else if(strtolower($_SESSION['user_type']) != substr($uri,1,1)){
        switch($_SESSION["user_type"])
        {
            case "A" : $destination = "Admin"; break;
            case "F" : $destination = "Faculty"; break;
        }
        header("location: /$destination");
    }
}
?>