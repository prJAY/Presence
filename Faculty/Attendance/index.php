<!DOCTYPE html>
<html lang="en">
<head>
    <title>Presence | Teacher's Portal</title>
    <?php date_default_timezone_set('Asia/Calcutta');
      include $_SERVER['DOCUMENT_ROOT']."/_Header.html"; 
    ?>
    <link href="/assets/classlist.css" rel="stylesheet">
    <script src="/assets/angulartemplate.js" defer></script>
</head>
<body class="bg-light" ng-app="App" ng-controller="Ctrl" >
    <?php 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        include $_SERVER['DOCUMENT_ROOT']."/_Nav_Faculty.html"; 
        $classid = $_GET['q'];
        $sql="SELECT `c`.*, COUNT(stud_Id) AS `count` FROM `class` AS `c` LEFT JOIN `student` AS `s` ON `s`.`stud_Class` = `c`.`ClassId` WHERE `c`.`ClassId` = '".$classid."' GROUP By ClassId;";
            $sqltemp = "select ClassCourse,ClassYear,ClassSem,count(stud_id) from class c,student s where c.ClassId = s.stud_class GROUP BY c.ClassCourse,c.ClassYear,c.ClassSem";
            $result=mysqli_query($con,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $ClassCourse=$row['ClassCourse'];
                $ClassYear=$row['ClassYear'];
                $ClassSem=$row['ClassSem'];
                $studcount=$row['count'];
                $cid=$row['ClassId']; 
              }
            }
            if(isset($_GET['dt'])){
                $recdate = $_GET['dt'];
                $newDate = date("d-M-Y", strtotime($recdate));
                $hideinputs = TRUE;
            }
            else{
                $newDate= date("d-M-Y");
                $hideinputs = FALSE;
            }
    ?>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <div class="d-flex justify-content-between">
            <h2><b>Attendance</b></h2>
            <h5 class="align-self-center mt-1"><?php echo $newDate?></h5>
        </div>
        <br/>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <h3><?php echo $ClassCourse." ".$ClassYear?></h3>
                <h5 class="align-self-center mt-1 px-2">Sem <?php echo $ClassSem ?></h5>
            </div>
            <h5 class="align-self-center mt-1">Total Students: <?php echo $studcount ?></h5>
        </div>
    </div>

    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
      <table class="table">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Student Id</th>
            <th width="100px">Status</th>
            <th width="160px"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            
            $sql="SELECT * FROM student where stud_class='".$classid."'";
            $result=mysqli_query($con,$sql);
            if($result){
                $count = 0;
              while($row=mysqli_fetch_assoc($result)){
                $id=$row['stud_Id'];
                $fname=$row['stud_Fname'];
                $lname=$row['stud_Lname'];
                
                $ngclickval = "attendancelist[".$count."]";
                $ng_pval = $ngclickval."='P'";
                $ng_aval = $ngclickval."='A'";
                $count += 1;

                echo '
                <tr style="position:relative;">
                  <td>'.$fname. " " .$lname.'</td>
                  <td>'.$id.'</td>
                  <td>
                  <label class="ats {{'.$ngclickval.'}}" id="'.$id.'">{{'.$ngclickval.'}}</label>
                  </td>
                  <td>
                  <button class="btn btn-sm btn-success" ng-hide="'.$hideinputs.'" ng-click="'.$ng_pval.'">Present</button>
                  <button class="btn btn-sm btn-danger" ng-hide="'.$hideinputs.'" ng-click="'.$ng_aval.'">Absent</button>
                  </td>
                </tr>';
              }
            }
          ?>
        </tbody>
      </table>
        <div class="w-100" style="height:3px; background:black;">          
        </div>
        <br />
        <div class="w-100 d-flex justify-content-end" ng-hide="<?php echo $hideinputs?>">          
            <button class="btn btn-primary" onClick="logs()" data-bs-toggle="modal" data-bs-target="#updatemodal">Save Attendance</button>
        </div>
    </div>


    <div class="modal fade" role="dialog" tabindex="-1" id="updatemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--bs-primary);">
                    <h4 class="modal-title" style="color: var(--bs-light);">Confirm Attendance</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="record.php" method="POST"> 
                    <div class="modal-body" id="widget">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Total Students: <label id="tot">30</label></th>
                            </tr>
                            </thead>
                            <tr>
                                <td><label class="text-success" id="tot_p">Present Students</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" name="list_p" id="list_p" rows="3" readonly></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="text-danger" id="tot_a">Absent Students</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" name="list_a" id="list_a" rows="3" readonly></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="classid" id="classid" value="<?php echo $classid?>"/>
                        <input type="hidden" name="total_p" id="total_p" value=""/>
                        <input type="hidden" name="total_a" id="total_a" value=""/>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>