<?php
    $llno = '';
    $idNo ='';
    $llnoerr = '';
    $idNoerr ='';
    if (isset($_POST['submit']))
    {
        require_once('Connection.php');
        session_start();
        $llno = $_POST['llno'];
        $idNo = $_POST['idNo'];
        $obj = new Connection();
        $db = $obj->getNewConnection();
        $sql = "select * from ll where llno=$llno AND idNo=$idNo";
        $res = $db->query($sql);
        $row = $res->fetch_assoc();
        $district = $row['district'];
        $db->close();
        if ($row['status'] == 0)
        {
            $idNoerr = "Status Pending";
        }
        if ($row['llno'] !== $llno)
        {
            $llnoerr = "Invalid ll no";
        }
        if ($row['idNo'] !== $idNo)
        {
            $idNoerr = "Invalid idNo no";
        }
        if ($row['status'] AND $row['llno'] === $llno AND $row['idNo'] === $idNo)
        {
            $_SESSION['llno'] = $llno;
            $_SESSION['idNo'] = $idNo;
            $_SESSION['district'] = $district;
            header("Location: confirmll.php");
            die();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apply For New DL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php require_once('header.php'); ?>
    <br>
    <h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> Apply For New DL </h1>
    <div class="container"><br>
        <div class="col-lg-6 m-auto d-block">
            <form method="POST" onsubmit="return validation()" class="bg-light">
                <div class="form-group">
					<label for="llno" class="font-weight-bold"> Enter LL No: </label>
					<input type="number" name="llno" class="form-control" id="llno" value="<?php echo $llno; ?>">
					<span id="llnoerr" class="text-danger font-weight-bold"> <?php echo $llnoerr; ?> </span>
				</div>
                <div class="form-group">
					<label for="idNo" class="font-weight-bold"> Enter ID No: </label>
					<input type="number" name="idNo" class="form-control" id="idNo" value="<?php echo $idNo; ?>">
					<span id="idNoerr" class="text-danger font-weight-bold"> <?php echo $idNoerr; ?> </span>
				</div>
                <center><input type="submit" name="submit" value="SUBMIT" class="btn btn-success"><center>
            </form>
            <br>
        </div>
    </div>
    <script type="text/javascript">
        function validation() {
            var llno = document.getElementById('llno').value;
            var idNo = document.getElementById('idNo').value;
            if (llno == "") {
                document.getElementById('llnoerr').innerHTML =" ** Please fill the llno field";
                return false;
            }
            if (idNo == "") {
                document.getElementById('idNoerr').innerHTML =" ** Please fill the idNo field";
                return false;
            }
        }
    </script>
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