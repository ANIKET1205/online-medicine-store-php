<?php
session_start();
$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

mysqli_select_db($con,$dbname);


$id = $_GET['id'];


$result = mysqli_query($con,"SELECT * FROM user_details where EmailID='$id'");

$data = mysqli_fetch_array($result); 

if(isset($_POST['update']))

{

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $eid=$_POST['eid'];
    $dob=$_POST['dob'];
    $gender=$_POST['gen'];
    $mnum=$_POST['mnum'];
    // $pass=$_POST['pass'];
    $add=$_POST['add'];

    $edit = mysqli_query($con,"UPDATE user_details set FName='$fname', LName='$lname', Age=$age, EmailID='$eid', DateOfBirth='$dob', Gender='$gender',  MoNumber=$mnum, Address_='$add' where EmailID='$id'");
    $_SESSION['use']=$eid;

    if($edit)

    {
        mysqli_close($con);
        header("location:Profile.php");
        exit;
    }
    // else
    // {
    //     echo mysqli_error();
    // }       
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
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
            // var pass = document.Register.pass.value;
          

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

            // if(pass.length < 6) {  
            //     alert("Password length should be > 6");
            //     document.Login.password.focus();
            //     return false; 
            // } 
            
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
        <li><a href='Profile.php'>Welcome ".$_SESSION['use']."</a></li>
            <li><a href="index.php">Home</a></li>
            <li><a class='active' href='OrderHistory.php'>Order History</a></li>
            <li><a href="LogoutID.php">Logout</a></li>
            
            
        <!-- </div> -->
        
    </header>
<div class="registration">
    <form name="Register" id="Form" method="post" onsubmit="return validate1();">
        <h1 style="font-size: 50px; color: rgb(22, 4, 73);"><b>Update Profile</b></h1>
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
            <!-- <tr>
                <td><label for="pass">PASSWORD :</label></td>
                <td><input type="password" name="pass" id="pass"></td>
            </tr> -->
            <tr>
                <td><label for="add">ENTER YOUR ADDRESS :</label></td>
                <td><textarea name="add" id="address" cols="20" rows="5"></textarea></td>
            </tr>
        </table>

        <input type="submit" value="update" name="update" class="registration_btn">
    </form>

    
    
    </div>

</body>

</html>