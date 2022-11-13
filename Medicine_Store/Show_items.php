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


$r = mysqli_query($con,"SELECT * FROM items_details");

echo "<link rel='Stylesheet' type='text/CSS' href='h_page.css'>";
echo "<header class='h_c'>
<div>
    <p class='c_name'>MARUTI Online Medicine Store</p>
    
</div>
<ul class='ull'>
    
    <li><a  href='Admin.php'>Home</a></li>
    <li><a href='Add_items.php'>Add Items</a></li>
    <li><a href='Show_items.php'>Show Items</a></li>
    <li><a href='LogoutID.php'>Logout</a></li>";
    if(isset($_SESSION['use'])){
        echo "<li><a href='LogoutID.php'>Logout</a></li>";
    }
    
    
echo"</ul>
<!-- </div> -->

</header>";


echo "<table border='1'>

<tr>

<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Update</th>
<th>Delete</th>

</tr>";

while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
{
  echo "<tr>";

  echo "<td>" . $row['_id'] . "</td>";

  echo "<td>" . $row['IName'] . "</td>";

  echo "<td>" . $row['price'] . "</td>";

  echo "<td>" . $row['stock'] . "</td>";?>

  <td><a href="UpdateItems.php?id=<?php echo $row['_id']; ?>">Edit</a></td>
  <td><a href="Delete_items.php?id=<?php echo $row['_id']; ?>">Delete</a></td>

  <?php
  echo "</tr>";
}
echo "</table>";


?>