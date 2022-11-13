
<?php

$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
mysqli_select_db($con,$dbname);

$id=$_GET['id'];


$result = mysqli_query($con,"DELETE FROM items_details where _id='$id'");

header("location:Show_items.php");

mysqli_close($con);
exit;
?>



