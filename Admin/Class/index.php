<!DOCTYPE html>
<html lang="en">
<head>
	<title>Presence | Class Management</title>
    <?php include $_SERVER['DOCUMENT_ROOT']."/_Header.html"; ?>
    <script src="/assets/class_script.js" defer></script>
</head>
<body ng-app="App" ng-controller="Ctrl" class="bg-light">
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
      include $_SERVER['DOCUMENT_ROOT']."/_Navbar.html"; 
    ?>

	<div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
		<h3>Class Details
            <button class="btn btn-primary float-end" ng-click="addform=false" ng-show="addform">+ Add New</button>
        </h3>
		<hr/>
		<br/>
		<form action="insert.php" method="post" class="row" ng-hide="addform">
			<div class="col-md p-2">
				<input type="text" class="form-control" placeholder="Enter Class ID" name="ClassId" readonly="readonly" value="{{idfront}}_{{idback}}">
			</div>
			<div class="col-md p-2">
				<input type="text" class="form-control" placeholder="Enter Course" name="ClassCourse" ng-model="idfront" required>
			</div>
			<div class="col-md p-2">
				<input type="number" class="form-control" placeholder="Enter Year" name="ClassYear" ng-model="idback" required>
			</div>
            <div class="col-md p-2">
				<input type="number" class="form-control" placeholder="Current Semester" name="ClassSem" required>
			</div>
			<div class="col col-auto p-2">
				<button type="submit" name="submit" class="btn btn-primary">Save</button>
                <input type="button" value="Cancel" class="btn btn-light" ng-click="addform=true">
			</div>
		</form>
	</div>

    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
      <table class="table">
		<thead>
			<tr>
				<th>Class ID</th>
				<th>Course</th>
				<th>Year</th>
                <th>Current Semester</th>
				<th width="100px"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql="select * from class";
				$result=mysqli_query($con,$sql);
				if($result){
					while($row=mysqli_fetch_assoc($result)){
						$ClassId=$row['ClassId'];
						$ClassCourse=$row['ClassCourse'];
						$ClassYear=$row['ClassYear'];
                        $ClassSem=$row['ClassSem'];			
						echo '
                        <tr>
							<td>'.$ClassId.'</td>
							<td>'.$ClassCourse.'</td>
							<td>'.$ClassYear.'</td>
                            <td>'.$ClassSem.'</td>
							<td class="d-flex justify-content-around c-pointer">
<i class="material-icons c-pointer text-primary" data-bs-toggle="modal" data-bs-target="#updatemodal" ng-click="loadedit('."'$ClassId-$ClassCourse-$ClassYear-$ClassSem'".')">edit</i>
<i class="material-icons c-pointer text-danger" data-bs-toggle="modal" data-bs-target="#deletemodal" ng-click="del='."'$ClassId'".'">delete_forever</i>
							</td>
						</tr>';
					}
				}
			?>
		</tbody>
      </table>
    </div>

    <!--modal-->
    
    <div class="modal fade" role="dialog" tabindex="-1" id="deletemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--bs-danger);">
                    <h4 class="modal-title" style="color: var(--bs-light);">Alert</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The class will only be deleted if no student is regestered in class. Do you want to continue?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a href="delete.php?deleteClassId={{del}}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="updatemodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--bs-primary);">
                    <h4 class="modal-title" style="color: var(--bs-light);">Update Class Details</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update.php" method="post"> 
                    <div class="modal-body" id="widget">
                        <div class="form-group p-2">
                            <label>Class ID</label>
                            <input type="text" class="form-control" placeholder="Enter Class ID" name="ClassId" value="{{editdata[0]}}" required readonly>
                        </div>
                        <div class="form-group p-2">
                            <label>Course</label>
                            <input type="text" class="form-control" placeholder="Enter Course" name="ClassCourse" value="{{editdata[1]}}" required>
                        </div>
                        <div class="form-group p-2">
                            <label>Year</label>
                            <input type="number" class="form-control" placeholder="Enter Year" name="ClassYear" value="{{editdata[2]}}" required>
                        </div>
                        <div class="form-group p-2">
                            <label>Current Semester</label>
                            <input type="number" class="form-control" placeholder="Current Semester" name="ClassSem" value="{{editdata[3]}}" required>
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