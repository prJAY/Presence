<?php

$con=new mysqli('localhost','root','',
'project');

echo "change to dbconfig"
if(!$con){
    die(mysqli_error($con));
}
?>