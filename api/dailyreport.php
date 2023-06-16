<?php
    date_default_timezone_set('Asia/Calcutta');
    require($_SERVER['DOCUMENT_ROOT']."/dbconfig.php");

    if(isset($_GET['dt'])){
        $recdate = $_GET['dt'];
    }
    else{
        $recdate= date("Y-m-d");
    }
    $cid = $_GET['q'];
    $query = "select * from attendance_master where class_id='".$cid."' and date = '".$recdate."'";
    $get_data = mysqli_query($con,$query);
    if(mysqli_num_rows($get_data) > 0)
    {
        $response;
        while($row = mysqli_fetch_assoc($get_data))
        {
            $response[] = $row;
        }
        $myJSON = json_encode($response);
        echo $myJSON;
    }
?>