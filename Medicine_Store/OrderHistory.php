<?php
session_start();
if(!isset($_SESSION['use'])){
    header("location:Login.html");
}
$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
mysqli_select_db($con,$dbname);
$eid=$_SESSION["use"];

$r = mysqli_query($con,"SELECT * FROM order_details WHERE EmailID='$eid'");

echo "<link rel='Stylesheet' type='text/CSS' href='h_page.css'>";
echo "<header class='h_c'>
<div>
    <p class='c_name'>MARUTI Online Medicine Store</p>
    
</div>
<ul class='ull'>";
if(isset($_SESSION['use']))
echo "<li><a href='Profile.php'>Welcome ".$_SESSION['use']."</a></li>";

    echo "<li><a href='index.php'>Home</a></li>";
    if(isset($_SESSION['use'])){
        echo "<li><a class='active' href='OrderHistory.php'>Order History</a></li>";
        echo "<li><a href='LogoutID.php'>Logout</a></li>";
    }
    
    
echo"</ul>
<!-- </div> -->

</header>";


echo "<table border='1'>

<tr>

<th>FNAME</th>
<th>EmailID</th>
<th>Card Number</th>
<th>CVC</th>
<th>EXPIRE DATE</th>
<th>TOTAL Payment</th>

</tr>";

while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
{
  echo "<tr>";

  echo "<td>" . $row['FName'] . "</td>";

  echo "<td>" . $row['EmailID'] . "</td>";

  echo "<td>" . $row['card_number'] . "</td>";

  echo "<td>" . $row['CVC'] . "</td>";
  echo "<td>" . $row['Exp_Date'] . "</td>";
  echo "<td>" . $row['T_Payment'] . "</td>";?>

 

  <?php
  echo "</tr>";
}
echo "</table>";


?>
