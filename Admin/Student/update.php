<?php
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

if(isset($_POST['submit'])){
    $stud_Id=$_POST['stud_Id'];
    $stud_Fname=$_POST['stud_Fname'];
    $stud_Lname=$_POST['stud_Lname'];
    $stud_Class=$_POST['stud_Class'];
 

    $sql="update student set stud_Fname='$stud_Fname',stud_Lname='$stud_Lname',stud_Class='$stud_Class' where stud_Id='$stud_Id'";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "updated successfully";
        header('location:/Admin/Student/');
    }else{
        die(mysqli_error($con));
    }
}
?>