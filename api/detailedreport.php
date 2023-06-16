<?php
    
    require($_SERVER['DOCUMENT_ROOT']."/dbconfig.php");

    $cid = $_GET['q'];
    $filename = "ams-detail-report-$cid-".date("d-m-Y").".xls";
    $bord = "";
    if(isset($_GET['dl'])){
        $bord = "border='1'";
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=$filename");
    }

    $query = "SELECT * FROM student where stud_class='$cid'";
    $result = mysqli_query($con,$query);
    $stud_data = [];
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($stud_data,$row);
        }
    }

    if(isset($_GET['fdt']) and isset($_GET['tdt'])){
        $fdt = $_GET['fdt'];
        $tdt = $_GET['tdt'];
        $q2 = "select * from attendance_master where class_id = '$cid' and (date between '$fdt' and '$tdt') order by date";
    }
    else{
        $q2 = "select * from attendance_master where class_id = '$cid' order by date";
    }
    
    $r2 = mysqli_query($con,$q2);
    $ats_data = [];
    if(mysqli_num_rows($r2) > 0)
    {
        while ($row2 = mysqli_fetch_assoc($r2)) {
            array_push($ats_data,$row2);
        }
    }

    echo '
        <table class="table" '.$bord.'>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>';
    foreach($ats_data as $record){
        $dt = $record['date'];
        $newDate = date("d M Y", strtotime($dt));
        echo        '<th>'.$newDate.'</th>';
    }
    echo'
                </tr>
            </thead>
            <tbody>';
    foreach($stud_data as $student){
        $id = $student['stud_Id'];
        $fname = $student['stud_Fname'];
        $lname = $student['stud_Lname'];
        echo '
                <tr>
                    <td>' . $id . '</td>
                    <td>' . $fname . " " . $lname . '</td>';
        foreach($ats_data as $record){
            $pre_list = $record['present_list'];
            $stat = "A";
            if(str_contains($pre_list,$id))
            {
                $stat = "P";
            }
            echo        '<td>'.$stat.'</td>';
        }
        echo'
                </tr>';
    }
    echo '
            </tbody>
        </table>';
?>