<?php
$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
$sqldb="CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($con,$sqldb))
{
echo "Error creating database: " . mysqli_error($con);
}
else
{
// echo "1 db created\n";
}

mysqli_select_db($con,$dbname);

if(isset($_GET['REGISTRATION']))
{
  $fname=$_GET['fname'];
  $lname=$_GET['lname'];
  $age=$_GET['age'];
  $eid=$_GET['eid'];
  $dob=$_GET['dob'];
  $gender=$_GET['gen'];
  $mnum=$_GET['mnum'];
  $pass=$_GET['pass'];
  $add=$_GET['add'];

$sql_insert="CREATE TABLE IF NOT EXISTS user_details (FName text NOT NULL,LName text NOT NULL,Age integer NOT NULL,EmailID varchar(30) NOT NULL,DateOfBirth DATE NOT NULL,Gender text NOT NULL,MoNumber BIGINT NOT NULL,Password_ text NOT NULL ,Address_ text NOT NULL,PRIMARY KEY (`EmailID`))";
if(!mysqli_query($con,$sql_insert))
{
echo "Error creating table: " . mysqli_error($con)."<br>";
}
else
{
// echo("table created<br>");
}


$sql = "INSERT INTO user_details (FName,LName,Age,EmailID,DateOfBirth,Gender,MoNumber,Password_ ,Address_) VALUES ('$fname','$lname',$age,'$eid','$dob','$gender',$mnum,'$pass','$add')";
if (!mysqli_query($con,$sql))
{
  echo "Error inserting data: " . mysqli_error($con);
}
else{
// echo "1 record added <br>";
        $to=$eid;

		$msg= "Thanks for new Registration.";   

		$subject="Email verification ";

		$headers = "MIME-Version: 1.0"."\r\n";

		$headers = 'Content-type: text/html; charset=iso-8859-1'."\r\n";

		$headers = 'From: Maruti'."\r\n";

        

		$ms="Code is : 688523";


		mail($to,$subject,$ms,$headers);

		echo "<script>alert('Email Sent');</script>";

		// echo "<script>window.location = 'login1.php';</script>";
        // header("location:index.php");
    }
}

mysqli_close($con);

?>


<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <link rel="Stylesheet" type="text/CSS" href="h_page.css">
    <meta charset="utf-8">
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

		<script src="js/bootstrap.min.js"></script>

    <script>
        function validate1() {
            var fname = document.Register.fname.value;
            var lname = document.Register.lname.value;
            var age = document.Register.age.value;
            var eid = document.Register.eid.value;
            var dob = document.Register.dob.value;
            var gender = document.Register.gen.value;
            var mnum = document.Register.mnum.value;
            var add = document.Register.add.value;
            var pass = document.Register.pass.value;
          

            //Conditions for FIRST NAME : 
            if (fname == "") {
                alert("Please Enter FIRST NAME ... ");
                document.Register.fname.focus();
                return false;
            }
            if (!fname.match(/^[a-zA-Z]+$/)) {
                alert("Please Enter valid in FIRST NAME.(Use only Alphabates)");
                document.Register.fname.focus();
                return false;
            }

            //Conditions for LAST NAME : 
            if (lname == "") {
                alert("Please Enter LAST NAME ... ");
                document.Register.lname.focus();
                return false;
            }
            if (!lname.match(/^[a-zA-Z]+$/)) {
                alert("Don't Enter Numbers in LAST NAME.");
                document.Register.lname.focus();
                return false;
            }

            //Conditions for AGE : 
            if (age == "") {
                alert("Please Enter Age . ");
                document.Register.age.focus();
                return false;
            }
            if (isNaN(age)) {
                alert("Please Enter only numbers in AGE ...");
                document.Register.age.focus();
                return false;
            }

            //Conditions for EMAIL ID : 
            if (eid == "") {
                alert("Please Enter Email ID ...");
                document.Register.eid.focus();
                return false;
            }
            var i = eid.indexOf("@")
            var j = eid.lastIndexOf(".");
            if (i < 1 || (j - i < 2)) {
                alert("Please enter correct email ID (Use . and @ symbol)");
                return false;
            }
            if (eid.charAt([i + 1]) != 'g' || eid.charAt([i + 2]) != 'm' || eid.charAt([i + 3]) != 'a' || eid.charAt([i + 4]) != 'i' || eid.charAt([i + 5]) != 'l' || eid.charAt([i + 6]) != '.') {
                alert("Please enter gmail id ...(Use gmail between @ and .(dot)) ");
                document.Register.eid.focus();
                return false;
            }

            //Conditions for GENDER : 
            if (gender == "") {
                alert("Please Enter GENDER ");
                return false;
            }

            //Conditions for MOBILE NUMBER : 
            if (mnum == "") {
                alert("Please Enter MOBILE NUMBER ");
                document.Register.mnum.focus();
                return false;
            }
            if (isNaN(mnum)) {
                alert("Please Enter only numbers in Mobile Number ...");
                document.Register.mnum.focus();
                return false;
            }
            if (mnum.length != 10) {
                alert("Please Enter MOBILE NUMBER OF LENGTH OF 10");
                document.Register.mnum.focus();
                return false;
            }
            if (mnum.charAt(0) != '9' && mnum.charAt(0) != '8' && mnum.charAt(0) != '7' && mnum.charAt(0) != '6') {
                alert("Your MOBILE NUMBER should be start with either 9 , 8 , 7 or 6 .");
                document.Register.mnum.focus();
                return false;
            }

            if(pass.length < 6) {  
                alert("Password length should be > 6");
                document.Login.password.focus();
                return false; 
            } 
            
            //Conditions for ADDRESS : 
            if (add == "") {
                alert("Please Enter Address ");
                document.Register.add.focus();
                return false;
            }


        }


    </script>
</head>

<body>

<header class="h_c">
        <div>
            <p class="c_name">MARUTI Online Medicine Store</p>
        </div>
        <!-- <div class="sidebar"> -->
        <ul class="ull">
            <li><a href="index.php">Home</a></li>
            <li><a  href="Login.html">Login</a></li>
            <li><a class="active" href="RecordDB.php">Registration</a></li>
            
        <!-- </div> -->
        
    </header>
<div class="registration">
    <form name="Register" id="Form" method="get" action="RecordDB.php" onsubmit="return validate1();">
        <h1 style="font-size: 50px; color: rgb(22, 4, 73);"><b>REGISTRATION PAGE</b></h1>
        <table width=100%>
            <tr>
                <td><label for="fname">FIRST NAME :</label></td>
                <td><input type="text" name="fname" id="fname" placeholder="Enter Your First Name"></td>
            </tr>

            <tr>
                <td><label for="lname">LAST NAME :</label></td>
                <td><input type="text" name="lname" id="lname" placeholder="Enter Your Last Name"></td>
            </tr>


            <tr>
                <td><label for="age">YOUR AGE :</label></td>
                <td><input type="text" name="age" id="age" placeholder="Enter Your AGE"></td>
            </tr>

            <tr>
                <td><label for="eid">EMAIL ID :</label></td>
                <td><input type="text" name="eid" id="eid" placeholder="abc@gmail.com">
                <div id="message2"></div></td>
            </tr>

            <tr>
                <td><label for="dob">DATE OF BIRTH : </label></td>
                <td><input type="date" name="dob" id="dob"></td>
            </tr>

            <tr>
                <td>
                    <label for="gender">GENDER : </label>
                </td>
                <td>
                    <input type="radio" value="male" name="gen" id="male">
                    <label for="male" >MALE</label><br>
                    <input type="radio" value="female" name="gen" id="female">
                    <label for="female">FEMALE</label><br>
                    <input type="radio" value="other" name="gen" id="other">
                    <label for="other">other</label>
                </td>
            </tr>

            <tr>
                <td><label for="mnum">MOBILE NUMBER :</label></td>
                <td><input type="BIGINT" name="mnum" id="mnum"></td>
            </tr>
            <tr>
                <td><label for="pass">PASSWORD :</label></td>
                <td><input type="password" name="pass" id="pass"></td>
            </tr>
            <tr>
                <td><label for="add">ENTER YOUR ADDRESS :</label></td>
                <td><textarea name="add" id="address" cols="20" rows="5"></textarea></td>
            </tr>
        </table>

        <input type="submit" value="REGISTRATION" name="REGISTRATION" class="registration_btn">
    </form>

    
    
    </div>

</body>

</html>
