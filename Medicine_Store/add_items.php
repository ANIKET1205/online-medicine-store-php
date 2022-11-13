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


if(isset($_POST['submit']))
{
  $i_name=$_POST['i_name'];
  $price=$_POST['price'];
  $stock=$_POST['stock'];
//   $img_name=$_FILES['i1']['name'];
//   echo "<script>alert($img_name)</script>";

$sql_insert="CREATE TABLE IF NOT EXISTS Items_details (_id integer NOT NULL AUTO_INCREMENT,IName text NOT NULL,price integer NOT NULL,stock integer NOT NULL ,PRIMARY KEY (`_id`))";
if(!mysqli_query($con,$sql_insert))
{
echo "Error creating table: " . mysqli_error($con)."<br>";
}
else
{
// echo("table created<br>");
}


$sql = "INSERT INTO Items_details (IName,price,stock) VALUES ('$i_name',$price,$stock)";
if (!mysqli_query($con,$sql))
{
  echo "Error inserting data: " . mysqli_error($con);
}
else{
    // move_uploaded_file($_FILES['i1']['temp_name'],"Images/$img_name");
// echo "1 record added <br>";
// header("location:index.php");
}

mysqli_close($con);

}

?>








<!DOCTYPE html>
<html>

<head>
    <link rel="Stylesheet" type="text/CSS" href="h_page.css">
    <title>Home Page</title>
</head>

<body>
<header class="h_c">
        <div>
            <p class="c_name">MARUTI Online Medicine Store</p>
            
        </div>
        <!-- <div class="sidebar"> -->
        <ul class="ull">
            
            <li><a href="Admin.php">Home</a></li>
            <li><a class="active" href="add_items.php">Add Items</a></li>
            <li><a href="Show_Items.php">Show Items</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href='LogoutID.php'>Logout</a></li>
            
        </ul>
        <!-- </div> -->
        
    </header>
    <br><br><br>
    <div class="content">
        <h1>Welcome To Admin Department</h1>
        <div>
        <form name="Add_items" id="Form" method="post" action="add_items.php">
        <table width=100%>
            <tr><td><label for="i_name">Item Name :</label></td>
                <td><input type="text" name="i_name" id="i_name" placeholder="Enter Item Name"></td>
            </tr>

            <tr>
                <td><label for="price">Price :</label></td>
                <td><input type="text" name="price" id="price" placeholder="Enter price"></td>
            </tr>
            <tr>
                <td><label for="stock">Stock :</label></td>
                <td><input type="text" name="stock" id="stock" placeholder="Enter Stock"></td>
            </tr>

            <tr>
                <td><label for="image">Upload Image :</label></td>
                <td><input type="file" name="i1" id="i1"></td>
            </tr>
        </table>

        <input type="submit" value="Add" name="submit" class="registration_btn">
    </form>
        </div>
        
    </div>
</body>

</html>