<?php
session_start();

$total=$_SESSION['total'];
if($total <= 0){
    echo "<script>alert('Please Add Items First')</script>";
    header("location:index.php");
}
// echo $total;


$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {
      // <!-- change secret key -->

        $secret="6LfwySwfAAAAAHAaof3KTdbISr-KpOxeq7AiqAqC";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response']);
        $data=json_decode($response);
        if($data->success)
        {
            echo "data sent";
        }  
        else
        {
            echo "data not sent";
        }
    }
    
mysqli_select_db($con,$dbname);

if(isset($_GET['pay']))
{
  $UName=$_GET['name'];
  $Email=$_SESSION['use'];
  $CNo=$_GET['card_num'];
  $cvc=$_GET['cvc'];
  $exp=$_GET['exp_year'];
  $tpayment=$total;
  

$sql_insert="CREATE TABLE IF NOT EXISTS Order_details (id integer NOT NULL AUTO_INCREMENT, FName text NOT NULL,EmailID text NOT NULL,card_number bigint NOT NULL,CVC integer NOT NULL,Exp_Date text NOT NULL,T_Payment integer NOT NULL,PRIMARY KEY (`id`))";
if(!mysqli_query($con,$sql_insert))
{
echo "Error creating table: " . mysqli_error($con)."<br>";
}
else
{
// echo("table created<br>");
}


$sql = "INSERT INTO Order_details (FName,EmailID,card_number,CVC,Exp_Date,T_Payment) VALUES ('$UName','$Email','$CNo',$cvc,'$exp',$tpayment)";
if (!mysqli_query($con,$sql))
{
  echo "Error inserting data: " . mysqli_error($con);
}
else{
// echo "1 record added <br>";
        $to=$Email;

		$msg= "Thanks for Order";   

		$subject="Order Details ";

		$headers = "MIME-Version: 1.0"."\r\n";

		$headers = 'Content-type: text/html; charset=iso-8859-1'."\r\n";

		$headers = 'From: Maruti'."\r\n";

        

		$ms=" Name : $UName      Email ID : $Email       Total Payment : $tpayment";


		mail($to,$subject,$ms,$headers);

		echo "<script>alert('Email Sent');</script>";

		// echo "<script>window.location = 'login1.php';</script>";
        // header("location:index.php");

        $sql1 = "DELETE FROM cart_details where EmailID='$Email'";
        mysqli_query($con,$sql1);
        header("location:index.php");
    }
}

mysqli_close($con);

?>

<html>
    <head>
    <link rel="Stylesheet" type="text/CSS" href="h_page.css">

    <meta charset="utf-8">
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

		<script src="js/bootstrap.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>


    </hrad>
    <body>
    <header class="h_c">
        <div>
            <p class="c_name">MARUTI Online Medicine Store</p>
            
        </div>
        <!-- <div class="sidebar"> -->
        <ul class="ull">
        <?php if(!isset($_SESSION['use']))
        {
            echo "<li><a href='Login.html'>Login / Singup</a></li>";
        }?>
            <?php if(isset($_SESSION['use']))
        echo "<li><a href='Profile.php'>Welcome ".$_SESSION['use']."</a></li>";?>
            <li><a href="index.php">Home</a></li>
            <li><a href='OrderHistory.php'>Order History</a></li>
            <li><a href='LogoutID.php'>Logout</a></li>
            <!-- <li><a href="#about">About Us</a></li> -->
            <?php if(isset($_SESSION['use']))
            echo "<li><a href='LogoutID.php'>Logout</a></li>";?>
            
        </ul>
        <!-- </div> -->
        
    </header>
    <div class="payment" style="background-color: #aed8fa;
    color: #12325c;
    border: 5p solid rgb(168, 168, 248);">

    <form action="" method="get" id="paymentFrm">
    <p>
        <label>Name : </label>
        <input type="text" name="name" size="50" />
    </p>
    <p>
        <label>Email : </label>
        <?php echo $_SESSION['use']; ?>
    </p>
    <p>
        <label>Card Number : </label>
        <input type="text" name="card_num" size="20" autocomplete="off" class="card-number" />
    </p>
    <p>
        <label>CVC : </label>
        <input type="text" name="cvc" size="4" autocomplete="off" class="card-cvc" />
    </p>
    <p>
        <label>Expiration (MM/YYYY) : </label>
        <input type="text" name="exp_month" size="2" class="card-expiry-month"/>
        <span> / </span>
        <input type="text" name="exp_year" size="4" class="card-expiry-year"/>
    </p>
    <p>
        <label>Total Payable Amount : </label>
        <?php echo "$total";?>
    </p>
    <div class="g-recaptcha" data-sitekey="6LfwySwfAAAAAIjgSTs4r8UYZ1OFyXyqrKPqUM1i"></div>
    <button type="submit" id="payBtn" name="pay" style="background-color:#1173f3; color:white; border:5px solid blue;">Submit Payment</button>
</form>
        </div>
</body>
</html>