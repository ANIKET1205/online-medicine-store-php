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


$result = mysqli_query($con,"SELECT * FROM items_details where _id='$id'");

$data = mysqli_fetch_array($result); 

if(isset($_POST['update']))

{

    $IName=$_POST['i_name'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];
    
    $edit = mysqli_query($con,"UPDATE items_details set IName='$IName', price=$price, stock=$stock where _id='$id'");
    // $_SESSION['use']=$eid;

    if($edit)

    {
        mysqli_close($con);
        header("location:Show_items.php");
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
            <li><a href='LogoutID.php'>Logout</a></li>
            
        </ul>
        <!-- </div> -->
        
    </header>
    <br><br><br>
    <div class="content">
        <h1>Welcome To Admin Department</h1>
        <div>
        <form name="update_items" id="Form" method="post">
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
        </table>

        <input type="submit" value="Update" name="update" class="registration_btn">
    </form>
        </div>
        
    </div>
</body>

</html>