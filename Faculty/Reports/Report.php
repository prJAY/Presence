<?php
    if(isset($_POST['submit'])){
        $cls = $_POST['cls'];
        $rtype = $_POST['rtype'];
        $dura = $_POST['dura'];
        $fdt = $_POST['fdt'];
        $tdt = $_POST['tdt'];

        $msg = substr($cls, 0, -5) . " " . substr($cls, -4) . " Attendance ";
        if($rtype == "S"){
            $msg .= "Summary";
            $path = "/api/summaryreport.php?q=".$cls;
        }
        else{
            $msg .= "Detail Report";
            if($dura == "A"){
                $path = "/api/detailedreport.php?q=".$cls;
            }
            else{
                $path = "/api/detailedreport.php?q=$cls&fdt=$fdt&tdt=$tdt";
            }
        }
    }
    else{

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/_Header.html"; ?>
    <title>Report</title>
    <script src="/assets/jquery.min.js" defer></script>
    <script src="/assets/loadreport.js" defer></script>
</head>
<body class="bg-light">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/_Nav_Faculty.html";
    ?>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <div class="m-0 d-flex justify-content-between">
            <h2><?php echo $msg; ?></h2>
            <a class="btn btn-link" href="<?php echo $path; ?>&dl">Download Report</a>            
        </div>
    </div>
    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <input type="hidden" id="path" value="<?php echo $path; ?>" />
        <div class="table-responsive" id="fetchdiv">

        </div>
    </div>
</body>
</html>