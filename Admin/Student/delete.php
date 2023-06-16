<?php
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
if(isset($_GET['deleteid'])){
    $stud_Id=$_GET['deleteid'];

    $sql="delete from student where stud_Id='$stud_Id'";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:/Admin/Student');
    }else{
        die(mysqli_error($con));
    }
}
?>