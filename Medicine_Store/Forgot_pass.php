<?php  
session_start();
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"id18559975_medicine_store");
$flag=0;
$count=0;
if(isset($_POST['login']))
{
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass2'];

    if($pass == $pass1 and strlen($pass) > 6)
    {
        $edit = mysqli_query($con,"UPDATE user_details set Password_='$pass' WHERE EmailID='$user'");
        if($edit)
        {
            mysqli_close($con);
            // $flag=1;
            header("location:index.php");
            exit;
        }
        else
        {
            echo mysqli_error();
        } 
    }
    elseif(strlen($pass) < 6){
        echo "Invalid length of password !";
    } 
    else
    {
        echo "Invalid Username !";
    }
    mysqli_close($con);
}
?>
<html>
<head>
<title> Reset Password </title>
<link rel="Stylesheet" type="text/CSS" href="h_page.css">
<script>
        function validate() {
            var pass=documnt.fpass.pass.value;
            if(pass.length < 6) {  
                alert("Password length should be > 6");
                document.Login.password.focus();
                return false; 
            }
        }
        </script>
</head>
<body>
<form name="fpass" action="" method="post" onsubmit="return validate();">

<header class="h_c">
        <div>
            <p class="c_name">MARUTI Online Medicine Store</p>
        </div>
        <!-- <div class="sidebar"> -->
        <ul class="ull">
            <li><a href="index.php">Home</a></li>
            <li><a  href="Login.html">Login</a></li>
            <li><a href="RecordDB.php">Registration</a></li>
        </ul>
        <!-- </div> -->
        
    </header>
    <div class="login">
    <h1>Reset Password</h1>
    <table>
    <tr>
        <td>  Email ID : </td>
        <td> <input type="text" name="user" > </td>
    </tr>
    <tr>
        <td> New PassWord : </td>
        <td><input type="password" name="pass"></td>
    </tr>
    <tr>
        <td> Confirm PassWord : </td>
        <td><input type="password" name="pass2"></td>
    </tr>
    <tr>
        <td> <input type="submit" name="login" value="RESET"></td>
        <td></td>
    </tr>
    </table>
</form>
    </div>
</body>
</html>

