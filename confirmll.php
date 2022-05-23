

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirm New DL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php require_once('header.php'); ?>
    <div class="row">
        <div class="col-lg-6 m-auto d-block">
        <ul class="list-group">
    <?php
    session_start();
    require_once('Connection.php');
    $llno = $_SESSION['llno'];
    $idNo = $_SESSION['idNo'];
    $obj = new Connection();
    $db = $obj->getNewConnection();
    $sql = "select * from ll where llno=$llno AND idNo=$idNo";
    $res = $db->query($sql);
    $row = $res->fetch_assoc();
    $name = $row['name'];
    $surname = $row['surname'];
    $dob = $row['dob'];
    $address = $row['address'];
    $idNo = $row['idNo'];
    $validity = $row['validity'];
    $issueDate = $row['issueDate'];
    $gender = $row['gender'];
    $mobileno = $row['mobileNumber'];
    $email = $row['email'];
    $district = $row['district'];
    print("<li class='list-group-item text-muted' contenteditable='false'>LL</li>

                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>LL Number:</strong></span>$llno</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Name:</strong></span>$name</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>id Number:</strong></span>$idNo</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>surname:</strong></span>$surname</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>DOB:</strong></span>$dob</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Address:</strong></span>$address</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Issue Date:</strong></span>$issueDate</li>
                <li class='list-group-item text-right'><span class='pull-left'><strong class=''>Validity:</strong></span>$validity</li>
                ");
    if (isset($_POST['confirm']))
    {
        
        // die();
        // header("Location: checkDLStatus.php");
        echo "1";
        $Date = date("Y-m-d");
        $examDate = date('Y-m-d', strtotime($Date . ' + 15 days'));
        $q = "insert into dl(name, surname, dob, address, idNo, gender, mobileNumber, email, district, examDate) 
        values('$name', '$surname', '$dob', '$address', $idNo, '$gender', $mobileno, '$email', '$district', '$examDate')";
        $r = $db->query($q);
        echo "2";
        // $res1 = $db->query("update dl set status=0 where aadhar=$aadhar");
        $_SESSION['idNo'] = $idNo;
        $_SESSION['district'] = $district;
        header("Location: dlstatus.php");
        // die();
        if (!$r)
            $db->error;
        
        $db->close();
        echo "1";
        
        echo "1";
    }
    
?>
</ul>
</div>
</div>
    <form method="post">
    <br><center><input class ="btn btn-success" type="submit" value="Confirm Details" name="confirm"></center><br>
    </form>
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