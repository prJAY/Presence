<?php
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
if(isset($_GET['deleteClassId'])){
    $ClassId=$_GET['deleteClassId'];

    $sql="delete from class where ClassId='$ClassId'";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:/Admin/Class/');
    }else{
        echo '<meta http-equiv="refresh" content="3;url=/Admin/Class">';
        echo "<h1>Class with students can not be deleted.Redirecting back ...</h1>";
    }
}
?>