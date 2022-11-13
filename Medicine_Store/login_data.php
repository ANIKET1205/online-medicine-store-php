<?php  
session_start();

$con = mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
mysqli_select_db($con,$dbname);
$flag=0;
$count=0;
// if(isset($_POST['login']))
// {
    $user = $_POST['uid'];
    $pass = $_POST['pass'];
    $utype=$_POST['utype'];
    if($utype == 'Admin'){
        if($user=='Admin' && $pass=='Admin123')
        {
            $_SESSION['use']=$user;
            $flag=1;
            header("Location:Admin.php");
        }
        else{
            echo '<script>alert("INVALID USER ID OR PASSWORD !")</script>';
        }
    }
    else{
    $sql="SELECT * FROM user_details WHERE EmailID='$user' and Password_='$pass'";
    $result=mysqli_query($con,$sql);
    while($data = mysqli_fetch_array($result))
    {
        if($user==$data['EmailID'] && $pass==$data['Password_'])
        {
            
            $flag=1;
            $_SESSION['use']=$user;
            header("Location:index.php");
        }
    }
    if($flag==0)
    {
        // echo "Invalid Username Or Password";
        // mysqli_close($con);
        
        header("Location:Invalid.html");
    }
    // else{
    //     $_SESSION['use']=$user;
    //     header("Location:index.php");
    // }
    mysqli_close($con);
}
// }

?>
