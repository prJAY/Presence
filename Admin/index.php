<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence | Admin Portal</title>
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/_Header.html"; 
      include $_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php";
    ?>
</head>
<body class="bg-light">
    <?php 
      include $_SERVER['DOCUMENT_ROOT']."/_Navbar.html"; 
    ?>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h2 class="m-0"><b>Welcome to admin portal</b></h2>
    </div>

	<div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h3 class="m-0">
			<a href="/Admin/Class/" class=" text-decoration-none text-dark d-flex justify-content-between"><span>Class Management</span><span class="material-icons my-auto">chevron_right</span></a>
		</h3>
    </div>

	<div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h3 class="m-0">
			<a href="/Admin/Student/" class=" text-decoration-none text-dark d-flex justify-content-between"><span>Student Management</span><span class="material-icons my-auto">chevron_right</span></a>
		</h3>
    </div>
</body>
</html>