<?php

include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
if(isset($_POST['submit'])){
    $ClassId=$_POST['ClassId'];
    $ClassCourse=$_POST['ClassCourse'];
    $ClassYear=$_POST['ClassYear'];
    $ClassSem=$_POST['ClassSem'];

    $sql="insert into class (ClassId,ClassCourse,ClassYear,ClassSem) values ('$ClassId','$ClassCourse','$ClassYear','$ClassSem')";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:/Admin/Class/');
    }else{
        die(mysqli_error($con));
    }
}
?>