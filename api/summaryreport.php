<?php
    require($_SERVER['DOCUMENT_ROOT']."/dbconfig.php");

    $cid = $_GET['q'];
    $filename = "ams-summary-report-$cid-".date("d-m-Y").".xls";
    $bord = "";
    if(isset($_GET['dl'])){
        $bord = "border='1'";
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=$filename");
    }

    $query = "SELECT student.* , COUNT(aid) FROM student,attendance_master where stud_class='$cid' and attendance_master.class_id = '$cid' GROUP BY student.stud_Id";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0)
    {
        $count = 0;
            echo '
                <table class="table" '.$bord.'>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Working Days</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['stud_Id'];
                $fname = $row['stud_Fname'];
                $lname = $row['stud_Lname'];
                $workdays = $row['COUNT(aid)'];

                $sql2 = "SELECT count(*) FROM `attendance_master` WHERE present_list LIKE '%$id%'";
                $result2 = mysqli_query($con, $sql2);
                if ($result2) {
                    $count = 0;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $predays = $row2['count(*)'];
                        $absdays = $workdays - $predays;
                    }
                }
                $per = ($predays * 100) / $workdays;

                echo '
                        <tr>
                            <td>' . $id . '</td>
                            <td>' . $fname . " " . $lname . '</td>
                            <td>' . $workdays . '</td>
                            <td>' . $predays . '</td>
                            <td>' . $absdays . '</td>
                            <td>' . number_format($per, 1) . ' %</td>
                        </tr>';
            }
            echo '
                    </tbody>
                </table>';
    }
?>