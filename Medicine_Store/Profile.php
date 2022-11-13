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




$eid=$_SESSION['use'];
// echo $eid;

$r = mysqli_query($con,"SELECT * FROM user_details WHERE EmailID='$eid'");

echo "<link rel='Stylesheet' type='text/CSS' href='h_page.css'>";
echo "<header class='h_c'>
<div>
    <p class='c_name'>MARUTI Online Medicine Store</p>
    
</div>
<ul class='ull'>
    
    <li><a class='active' href='Profile.php'>Welcome ".$_SESSION['use']."</a></li>
    <li><a  href='index.php'>Home</a></li>
    <li><a href='OrderHistory.php'>Order History</a></li>";
    if(isset($_SESSION['use'])){
        echo "<li><a href='LogoutID.php'>Logout</a></li>";
    }
    
    
echo"</ul>
<!-- </div> -->

</header>";


echo "<table border='1'>

<tr>

<th>FName</th>
<th>LName</th>
<th>Age</th>
<th>EmailID</th>
<th>Date Of Birth</th>
<th>Gender</th>
<th>Mobile No</th>
<th>Password</th>
<th>Address</th>
<th>Update</th>

</tr>";

while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
{
  echo "<tr>";

  echo "<td>" . $row['FName'] . "</td>";

  echo "<td>" . $row['LName'] . "</td>";

  echo "<td>" . $row['Age'] . "</td>";

  echo "<td>" . $row['EmailID'] . "</td>";

  echo "<td>" . $row['DateOfBirth'] . "</td>";

  echo "<td>" . $row['Gender'] . "</td>";
  
  echo "<td>" . $row['MoNumber'] . "</td>";

  echo "<td>" . $row['Password_'] . "</td>";

  echo "<td>" . $row['Address_'] . "</td>";?>

  <td><a href="UpdateProfile.php?id=<?php echo $row['EmailID']; ?>">Edit</a>

  </td>
  <?php
  echo "</tr>";
}
echo "</table>";


?>