<?php
    session_start();
    $_SESSION['user_id'] = $_SESSION['user_name'] = $_SESSION['user_type'] = "";
    $err_msg = $msg_class = "";

    if(isset($_GET['q']) && $_GET['q'] == "logout")
    {
        $msg_class = "text-green-600";
        $err_msg = "You have logged out successfully.";   
    }
    if(isset($_GET['q']) && $_GET['q'] == "auth")
    {
        $msg_class = "text-red-600";
        $err_msg = "Please login to continue.";   
    }
    if(isset($_POST['user_id']) && isset($_POST['user_password']))
    {
        $userid = $pass = "";
        if(empty(trim($_POST["user_id"])) || empty(trim($_POST["user_password"])))
        {
            
            $msg_class = "text-red-600";
            $err_msg = "Please provide User Id and Password.";
            
        }
        else
        {
            
            $userid = trim($_POST["user_id"]);
            $pass = trim($_POST["user_password"]);

            require("dbconfig.php");
            $query = "select * from user_master where user_id = '$userid' and user_pass = '$pass'";
            $get_data = mysqli_query($con,$query);
            if(mysqli_num_rows($get_data) == 1)
            {
                
                while($row = mysqli_fetch_assoc($get_data))
                {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['user_type'] = $row['user_type'];

                    switch($_SESSION["user_type"])
                    {
                        case "A" : $destination = "Admin"; break;
                        case "F" : $destination = "Faculty"; break;
                    }
                    header("location: /$destination");
                }
            }
            else
            {
                
                $msg_class = "text-red-600";
                $err_msg = "Please enter valid User ID / Password";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence</title>
    <link href="./assets/index.css" rel="stylesheet">
    <link href="./assets/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/img/ico.svg" sizes="any" type="image/svg+xml">
</head>
<body class="bg-gradient-to-br from-indigo-500 to-indigo-700 overflow-hidden h-screen">
    <div class="bgcontainer  grid-cols-3 absolute h-full w-full hidden md:grid overflow-hidden">
        <div class="objs1 ">
            <img src="./assets/img/ob1.png" class="h-60 obj"/>
        </div>
        <div class="objs2 ">
            <img src="./assets/img/ob2.png" class="h-60 obj"/>
        </div>
        <div class="objs3 ">
            <img src="./assets/img/ob3.png" class="h-60 obj"/>
        </div>
        <div class="objs2 ">
            <img src="./assets/img/ob4.png" class="h-60 obj"/>
        </div>
        <div class="objs4 ">
            <img src="./assets/img/ob5.png" class="h-60 obj"/>
        </div>
        <div class="objs1">
            <img src="./assets/img/ob6.png" class="h-60 obj"/>
        </div>
    </div>
    
    <nav class="flex items-center py-10 justify-center text-gray-100 fixed w-full">
        <div class="bg-white rounded-full shadow-2xl h-28 w-28 flex items-center justify-center">
            <strong class="text-5xl logofont text-transparent bg-clip-text bg-gradient-to-br from-indigo-700 to-indigo-800 p-2 z-20">Presence</strong>
        </div>
    </nav>

    <div class="mainContainer grid grid-cols-1 lg:gap-2 lg:grid-cols-3 items-center justify-center p-10 lg:p-20 xl:p-40 2xl:p-60 overflow-auto h-full">

        <div class="infocard col-span-2 rounded-xl shadow-md items-center justify-center leading-relaxed p-14 g-6 bg-white h-full  hidden md:grid">
            <img src="./assets/img/chart.png" class="m-auto h-60" />
            <b class="text-2xl lg:text-3xl xl:text-5xl text-transparent bg-clip-text bg-gradient-to-br from-indigo-400 to-indigo-600">Managing student attendance made easy</b>
        </div>

        <div class="logincard rounded-xl p-14 flex shadow-md items-center justify-center bg-gray-50 mt-10 lg:mt-0 h-full ">
            <div class="max-w-md w-full space-y-8">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-auto text-indigo-600 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd" />
                </svg>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="/" method="POST">
                <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="userid" class="sr-only">User ID</label>
                    <input id="userid" name="user_id" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="User Id">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="user_password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
                </div>

                <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    </span>
                    Sign in
                </button>
                </div>

                <div class="msg <?php echo $msg_class;?>">
                    <?php echo $err_msg;?>
                </div>
            </form>
            </div>
        </div>

    </div>
</body>
</html>