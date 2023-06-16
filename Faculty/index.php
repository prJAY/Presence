<!DOCTYPE html>
<html lang="en">
<head>
    <title>Presence | Teacher's Portal</title>
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/_Header.html"; 
    ?>
    <link href="/assets/classlist.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
      include $_SERVER['DOCUMENT_ROOT']."/_Nav_Faculty.html"; 
    ?>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h2 class="m-0"><b>Welcome to teacher's portal</b></h2>
    </div>

	<div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h3 class="m-0">
			<a href="/Faculty/Reports/" class=" text-decoration-none text-dark d-flex justify-content-between"><span>Reports</span><span class="material-icons my-auto">chevron_right</span></a>
		</h3>
    </div>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Class</th>
            <th>Current Semester</th>
            <th>Students</th>
            <th width="100px"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql="SELECT `c`.*, COUNT(stud_Id) AS `count` FROM `class` AS `c` LEFT JOIN `student` AS `s` ON `s`.`stud_Class` = `c`.`ClassId`GROUP By ClassId;";
            $sqltemp = "select ClassCourse,ClassYear,ClassSem,count(stud_id) from class c,student s where c.ClassId = s.stud_class GROUP BY c.ClassCourse,c.ClassYear,c.ClassSem";
            $result=mysqli_query($con,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $ClassCourse=$row['ClassCourse'];
                $ClassYear=$row['ClassYear'];
                $ClassSem=$row['ClassSem'];
                $studcount=$row['count'];
                $cid=$row['ClassId']; 
                echo '
                <tr style="position:relative;">
                  <td>'.$ClassCourse. " " .$ClassYear.'</td>
                  <td>'.$ClassSem.'</td>
                  <td>'.$studcount.'</td>
                  <td><a href="/Faculty/Attendance/?q='.$cid.'" class="text-decoration-none stretched-link">View</a></td>
                </tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
</body>
</html>