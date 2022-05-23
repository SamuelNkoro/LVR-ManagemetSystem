<?php
    $name = '';
    $surname = '';
    $dob = '';
    $address = '';
    $idNo = '';
    $gender = '';
    $mobileNumber = '';
    $email = '';
    $district = '';
    $idNoerr = '';
    if (isset($_POST['submit']))
    {
        session_start();
        require_once('Connection.php');
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $idNo = $_POST['idNo'];
        $gender = $_POST['gender'];
        $mobileNumber = $_POST['mobileNumber'];
        $email = $_POST['email'];
        $district = $_POST['district'];
        $obj = new Connection();
        $db = $obj->getNewConnection();
        $q = "select * from ll where idNo=$idNo";
        $r = $db->query($q);
        if ($r->num_rows > 0)
        {
            $idNoerr = "idNo Number already registered";
        }
        else 
        {
            $Date = date("Y-m-d");
            $examDate = date('Y-m-d', strtotime($Date . ' + 15 days'));
            $sql = "insert into ll(name, surname, dob, address, idNo, gender, mobileNumber, email, district, status, examDate) 
                    values('$name', '$surname', '$dob', '$address', '$idNo', '$gender', '$mobileNumber', '$email', '$district', 0, '$examDate') ";
            $res = $db->query($sql);
            $sql1 = "select id, status from ll where idNo='$idNo'";
            $result = $db->query($sql1);
            $row = $result->fetch_array();
            $id = $row[0];
            $status = $row[1];
            if ($res)
            {
                $_SESSION['district'] = $district;
                $_SESSION['idNo'] = $idNo;
                $db->close();
                header("Location: llstatus.php");
                die();
            }
            $db->close();
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Apply for New Learner License</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php require_once('header.php'); ?>
    <br>
    <h1 class="text-white text-center font-weight-bold bg-success" style="font-size: 55px;"> New LL Registration </h1>
    <div class="container"><br>
        <div class="col-lg-6 m-auto d-block">
            <form method="POST" onsubmit="return validation()" class="bg-light">
                <div class="form-group">
					<label for="name" class="font-weight-bold"> Enter Name: </label>
					<input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>">
					<span id="nameerr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="surname" class="font-weight-bold"> Enter Surname: </label>
					<input type="text" name="surname" class="form-control" id="surname" value="<?php echo $surname; ?>">
					<span id="surnameerr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="dob" class="font-weight-bold"> Enter DOB: </label>
					<input type="date" name="dob" class="form-control" id="dob" value="<?php echo $dob; ?>">
					<span id="doberr" class="text-danger font-weight-bold"> </span>
				</div>
               
                <div class="form-group">
					<label for="address" class="font-weight-bold"> Enter Address: </label>
					<input type="text" name="address" class="form-control" id="address" value="<?php echo $email; ?>">
					<span id="addresserr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="idNo" class="font-weight-bold"> Enter ID Number: </label>
					<input type="text" name="idNo" class="form-control" id="idNo" value="<?php echo $idNo; ?>">
					<span id="idNoerr" class="text-danger font-weight-bold"> <?php echo $idNoerr; ?> </span>
				</div>
                <div class="form-group">
					<label for="gender" class="font-weight-bold"> Enter Gender: </label>
					<input type="text" name="gender" class="form-control" id="gender" value="<?php echo $gender; ?>">
					<span id="gendererr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="mobileNumber" class="font-weight-bold"> Enter Mobile Number: </label>
					<input type="number" name="mobileNumber" class="form-control" id="mobileNumber" value="<?php echo $mobileNumber; ?>">
					<span id="mobileNumbererr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="email" class="font-weight-bold"> Enter Email ID: </label>
					<input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
					<span id="emailerr" class="text-danger font-weight-bold"> </span>
				</div>
                <div class="form-group">
					<label for="district" class="font-weight-bold"> Enter District Office: </label>
					<input type="text" name="district" class="form-control" id="district" value="<?php echo $district; ?>">
					<span id="districterr" class="text-danger font-weight-bold"> </span>
				</div>
                <center><input type="submit" name="submit" value="SUBMIT" class="btn btn-success"><center>
            </form>
            <br>
        </div>
    </div>
    <script type="text/javascript">
        function validation() {
            var name = document.getElementById('name').value;
            var surname = document.getElementById('surname').value;
            var dob = document.getElementById('dob').value;
            var address = document.getElementById('address').value;
            var idNo = document.getElementById('idNo').value;
            var gender = document.getElementById('gender').value;
            var mobileNumber = document.getElementById('mobileNumber').value;
            var email = document.getElementById('email').value;
            var district = document.getElementById('district').value;
            if (name == "") {
                document.getElementById('nameerr').innerHTML =" ** Please fill the name field";
                return false;
            }
            if (surname == "") {
                document.getElementById('surnameerr').innerHTML =" ** Please fill the surname field";
                return false;
            }
            if (dob == "") {
                document.getElementById('doberr').innerHTML =" ** Please fill the dob field";
                return false;
            }
           
            if (address == "") {
                document.getElementById('addresserr').innerHTML =" ** Please fill the address field";
                return false;
            }
            if (idNo == "") {
                document.getElementById('idNoerr').innerHTML =" ** Please fill the idNo field";
                return false;
            }
            else if(idNo.toString().length != 10) {
				document.getElementById('idNoerr').innerHTML =" ** idNo No should be of 10 digits";
				return false;	
			}
            if (gender == "") {
                document.getElementById('gendererr').innerHTML =" ** Please fill the gender field";
                return false;
            }
            if (mobileNumber == "") {
                document.getElementById('mobileNumbererr').innerHTML =" ** Please fill the mobileNumber field";
                return false;
            }
            if (email == "") {
                document.getElementById('emailerr').innerHTML =" ** Please fill the email field";
                return false;
            }
            if (district == "") {
                document.getElementById('districterr').innerHTML =" ** Please fill the district field";
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