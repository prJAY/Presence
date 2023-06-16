<?php
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

if(isset($_POST['submit'])){
    $ClassId=$_POST['ClassId'];
    $ClassCourse=$_POST['ClassCourse'];
    $ClassYear=$_POST['ClassYear'];
    $ClassSem=$_POST['ClassSem'];

    $sql="update class set ClassCourse='$ClassCourse',ClassYear='$ClassYear',ClassSem='$ClassSem' where ClassId='$ClassId'";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "updated successfully";
        header('location:/Admin/Class');
    }else{
        die(mysqli_error($con));
    }
}
?>