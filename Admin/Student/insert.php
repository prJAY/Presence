<?php
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
if(isset($_POST['submit'])){

    $stud_Id=$_POST['stud_Id'];
    $stud_Fname=$_POST['stud_Fname'];
    $stud_Lname=$_POST['stud_Lname'];
    $stud_Class=$_POST['stud_Class'];

    $sql="insert into student (stud_Id,stud_Fname,stud_Lname,stud_Class) values ('$stud_Id','$stud_Fname','$stud_Lname','$stud_Class')";
    $result=mysqli_query($con,$sql);
    if($result){
      
        header('location:/Admin/Student/');
      }else {
        die(mysqli_error($con));
      }
}
?>