<!DOCTYPE html>
<html lang="en">
<head>
    <title>Presence | Teacher's Portal</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/_Header.html"; ?>
    <script src="/assets/ngreport.js" defer></script>
</head>
<body class="bg-light" ng-app="App" ng-controller="Ctrl">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/_Nav_Faculty.html";
    ?>

    <div class="container mt-5 p-4 rounded-3 shadow-sm bg-white">
        <h2>Search & Filter</h2>
        <hr/>
        <form action="report.php" method="post" class="row">
            <div class="col-md-4 p-2">
                <label class="form-label">Select Class</label>
                <select class="form-select" name="cls">
                    <?php
                        $sql = "select ClassId from class";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $ClassId = $row['ClassId'];
                                echo '
                                <option>' . $ClassId . '</option>
                                ';
                            }
                        }
                    ?>
                <select>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-4 p-2">
                <label class="form-label">Select Report Type</label>
                <div class="input-group">
                    <div class="input-group-text" ng-click="addform=false">
                        <input class="form-check-input mt-0" type="radio" value="S" id="rt1" name="rtype" checked="checked">
                    </div>
                    <label type="text" class="form-control" for="rt1" readonly>Summary</label>
                    <div class="input-group-text" ng-click="addform=true">
                        <input class="form-check-input mt-0" type="radio" value="D" id="rt2" name="rtype">
                    </div>
                    <label type="text" class="form-control" for="rt2" readonly >Detailed</label>
                </div>
            </div>
            <div class="col-md-4 p-2" ng-show="addform">
                <label class="form-label">Select Duration</label>
                <div class="input-group">
                    <div class="input-group-text" ng-click="specdate=false">
                        <input class="form-check-input mt-0" type="radio" value="A" id="d1" name="dura" checked="checked">
                    </div>
                    <label type="text" class="form-control" for="d1" readonly>All Time</label>
                    <div class="input-group-text" ng-click="specdate=true">
                        <input class="form-check-input mt-0" type="radio" value="S" id="d2" name="dura">
                    </div>
                    <label type="text" class="form-control" for="d2" readonly >Specific duration</label>
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 p-2" ng-show="specdate">
                <label class="form-label">From</label>
                <input type="date" name="fdt" class="form-control" value="<?php echo date("Y-m-d")?>"/>
            </div>
            <div class="col-md-4 p-2" ng-show="specdate">
                <label class="form-label">To</label>
                <input type="date" name="tdt" class="form-control" value="<?php echo date("Y-m-d")?>"/>
            </div>
            <div class="col-12 p-2 align-self-end">
                <button type="submit" name="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</body>
</html>