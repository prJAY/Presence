<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
if(isset($_POST['submit'])){
    $ClassId=$_POST['classid'];
    $total_p=$_POST['total_p'];
    $total_a=$_POST['total_a'];
    $list_p=$_POST['list_p'];
    $list_a=$_POST['list_a'];
    $recby= $_SESSION['user_name'];
    $recdate= date("Y-m-d");


    $sql="delete from attendance_master where class_id = '$ClassId' and date = '$recdate'";
    $result=mysqli_query($con,$sql);
    if($result)
    {
        $sql="insert into attendance_master (class_id,present_no,absent_no,present_list,absent_list,record_by,date) values ('$ClassId','$total_p','$total_a','$list_p','$list_a','$recby','$recdate')";
        $result=mysqli_query($con,$sql);
        if($result)
        {
            header('location:/Faculty/Attendance/?q='.$ClassId);
        }
        else{
            echo "Syntex error insert aborted";
        }
    }
    else{
        echo "Syntex error update aborted";
    }
}
else{
    echo "No data received";
}
?>