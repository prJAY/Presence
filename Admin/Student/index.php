<?php
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Presence | Student Management</title>
    <?php include $_SERVER['DOCUMENT_ROOT']."/_Header.html"; ?>
    <script src="/assets/class_script.js" defer></script>
</head>
<body ng-app="App" ng-controller="Ctrl" class="bg-light">
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/_Navbar.html"; 
    ?>

    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
		<h3>Student Details
            <button class="btn btn-primary float-end" ng-click="addform=false" ng-show="addform">+ Add New</button>
        </h3>
		<hr/>
		<br/>
   		<form action="insert.php" method="post" class="row" ng-hide="addform"> 
   			<div class="col-md p-2">
    			<input type="text" class="form-control" placeholder="Enter student id" name="stud_Id">
	  		</div>
  			<div class="col-md p-2">
				<input type="text" class="form-control" placeholder="Enter first name" name="stud_Fname">
			</div>
			<div class="col-md p-2">
				<input type="text" class="form-control" placeholder="Enter last name" name="stud_Lname">
			</div>
			<div class="col-md p-2">
                <select class="form-select" name="stud_Class">
                    <?php
                    
                    $sql="select ClassId from class";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $ClassId=$row['ClassId'];
                            echo '
                            <option>'.$ClassId.'</option>
                            ';
                        }
                    }
                    ?>    
                <select>
			</div>
			<div class="col col-auto p-2">
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
                <input type="button" value="Cancel" class="btn btn-light" ng-click="addform=true">
			</div>
  		</form>
	</div>

    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <div class="table-responsive">
        <table class="table" style="min-width:max-content;">
		<thead>
			<tr>
				<th>Student ID</th>
				<th>Student Name</th>
				<th>Class ID</th>
				<th width="100px"></th>
			</tr>
		</thead>
		<tbody>
			<?php

				$sql="select * from student order by stud_Id";
				$result=mysqli_query($con,$sql);
                $preclass = "";
				if($result){
					while($row=mysqli_fetch_assoc($result)){
						$studid=$row['stud_Id'];
						$studfname=$row['stud_Fname'];
						$studlname=$row['stud_Lname'];
                        $classid=$row['stud_Class'];
                        
                        if($preclass == $classid){

                        }
                        else{
                            echo '<tr><td colspan="5" class="border-bottom border-dark text-center">'.$classid.'</td></tr>';
                        }
                        $preclass = $classid;
						echo '
						<tr>
							<td>'.$studid.'</td>
							<td>'.$studfname.' '.$studlname.'</td>
							<td>'.$classid.'</td>
							<td class="d-flex justify-content-around c-pointer">
<i class="material-icons c-pointer text-primary" data-bs-toggle="modal" data-bs-target="#updatemodal" ng-click="loadedit('."'$studid-$studfname-$studlname-$classid'".')">edit</i>
<i class="material-icons c-pointer text-danger" data-bs-toggle="modal" data-bs-target="#deletemodal" ng-click="del='."'$studid'".'">delete_forever</i>
							</td>
						</tr>';
					}
				}
			?>
		</tbody>
        </table>
        </div>
    </div>

    <!--modal-->
    
    <div class="modal fade" role="dialog" tabindex="-1" id="deletemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--bs-danger);">
                    <h4 class="modal-title" style="color: var(--bs-light);">Alert</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The student will be deleted permenantly. Do you want to continue?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a href="delete.php?deleteid={{del}}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="updatemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--bs-primary);">
                    <h4 class="modal-title" style="color: var(--bs-light);">Update Student Details</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update.php" method="post"> 
                    <div class="modal-body" id="widget">
                        <div class="form-group p-2">
                            <label>Student ID</label>
                            <input type="text" class="form-control" placeholder="Enter Student ID" name="stud_Id" value="{{editdata[0]}}" required readonly>
                        </div>
                        <div class="form-group p-2">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name" name="stud_Fname" value="{{editdata[1]}}" required>
                        </div>
                        <div class="form-group p-2">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="stud_Lname" value="{{editdata[2]}}" required>
                        </div>
                        <div class="form-group p-2">
                            <label>Class ID</label>
                            <input type="text" class="form-control" placeholder="Enter Class ID" name="stud_Class" value="{{editdata[3]}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>