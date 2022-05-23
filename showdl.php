<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Show DL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php require_once('header.php'); ?>
        <br>
        <div class="row">
            <div class="col-lg-6 m-auto d-block">
            <ul class="list-group">
            <li class="list-group-item text-muted" contenteditable="false">DL:</li>
    <?php
        error_reporting(0);
        session_start();
        require_once('Connection.php');
        $dlno = $_SESSION['dlno'];
        $idNo = $_SESSION['idNo'];
        $obj = new Connection();
        $db = $obj->getNewConnection();
        $sql = "select * from dl where dlno=$dlno ANDidNo=$idNo";
        $res = $db->query($sql);
        $row = $res->fetch_assoc();
        $dlno = $row['dlno'];
        $name = $row['name'];
        $surname = $row['surname'];
        $dob = $row['dob'];
        $address = $row['address'];
        $idNo = $row['idNo'];
        $validity = $row['validity'];
        $issueDate = $row['issueDate'];
        print("<li class='list-group-item text-right'><span class='pull-left'><strong class=''>DL NO:</strong></span>$dlno</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Name:</strong></span>$name</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''> Surname:</strong></span>$surname</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>DOB:</strong></span>$dob</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Address:</strong></span>$address</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>idNo Number:</strong></span>$idNo</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Issue Date:</strong></span>$issueDate</li>
        <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Validity:</strong></span>$validity</li>");
        $db->close();
        session_destroy();
    ?>
    </ul>
    </div>
    </div><br>
    <?php require_once('footer.php'); ?>
    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>
</html>


