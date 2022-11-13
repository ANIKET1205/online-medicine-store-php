<?php
session_start();
$_SESSION['total']=0;

$con=mysqli_connect("localhost","root","");
$dbname="id18559975_medicine_store";
if (!$con)
{
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}
mysqli_select_db($con,$dbname);

if(isset($_POST["add_to_cart"]))
{
     echo "Hello";
     $sql_insert="CREATE TABLE IF NOT EXISTS Cart_details (id int(5) NOT NULL AUTO_INCREMENT,EmailID text NOT NULL,ITEM_NAME text NOT NULL,PRICE integer NOT NULL,QUANTITY int NOT NULL,PRIMARY KEY (`id`))";
     if(!mysqli_query($con,$sql_insert))
{
echo "Error creating table: " . mysqli_error($con)."<br>";
}


//  if(isset($_SESSION["shopping_cart"]))
//  {
//  $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
//  if(!in_array($_GET["id"], $item_array_id))
//  {
//  $count = count($_SESSION["shopping_cart"]);
//  $item_array = array(
//  'item_id' => $_GET["id"],
//  'item_name' => $_POST["hidden_name"],
//  'item_price' => $_POST["hidden_price"],
//  'item_quantity' => $_POST["quantity"]
//  );
//  $_SESSION["shopping_cart"][$count] = $item_array;
$eid=$_SESSION["use"];
$item=$_POST["hidden_name"];
$price=$_POST["hidden_price"];
$quantity=$_POST["quantity"];
$sql = "INSERT INTO Cart_details (EmailID,ITEM_NAME,PRICE,QUANTITY) VALUES ('$eid','$item',$price,$quantity)";
if (!mysqli_query($con,$sql))
{
  echo "Error inserting data: " . mysqli_error($con);
}
// $_SESSION['total']=$_SESSION['total']+$price;


header("location:index.php");
//  }
//  else
//  {
//  echo '<script>alert("Item Already Added")</script>';
//  }
//  }
//  else
//  {
//  $item_array = array(
//  'item_id' => $_GET["id"],
//  'item_name' => $_POST["hidden_name"],
//  'item_price' => $_POST["hidden_price"],
//  'item_quantity' => $_POST["quantity"]
//  );
//  $_SESSION["shopping_cart"][0] = $item_array;

//  }
} 
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
          
          //  foreach($_SESSION["shopping_cart"] as $keys => $values)  
          //  {  
          //      //  $k=$values['item_id'];
          //      //  $j=$_GET['id'];
          //      //  echo "$keys";
          //      //  echo "Hello";
          //       if($values['item_id'] == $_GET["id"])  
          //       {  
          //            unset($_SESSION["shopping_cart"][$keys]);  
          //            echo '<script>alert("Item Removed")</script>';  
          //            echo '<script>window.location="index.php"</script>';  
          //       }  
          //  }  
          $id1=$_GET['id'];
          $result = mysqli_query($con,"DELETE FROM items_details where _id='$id'");
          
header("location:index.php");
      }  
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
        <?php if(!isset($_SESSION['use']))
        {
            echo "<li><a href='Login.html'>Login / Singup</a></li>";
        }?>
            <?php if(isset($_SESSION['use']))
        echo "<li><a href='Profile.php'>Welcome ".$_SESSION['use']."</a></li>";?>
            <li><a class="active" href="index.php">Home</a></li>
            <!-- <li><a href="#news">News</a></li> -->
            <!-- <li><a href="#contact">Contact Us</a></li> -->
            <!-- <li><a href="#about">About Us</a></li> -->
            <?php if(isset($_SESSION['use'])){
                 echo "<li><a href='OrderHistory.php'>Order History</a></li>";
                 echo "<li><a href='LogoutID.php'>Logout</a></li>";

            }
            ?>
            
        </ul>
        <!-- </div> -->
        
    </header>
    
    <div class="content">

        <?php
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

$sql = "SELECT * FROM Items_details";
$result = $con->query($sql);


if ($result->num_rows > 0) {
    $i=1; 
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        ?>
      <!-- echo "<div class='items'>
      <div><img src='1.png' alt='item1' width='200' height='200'></div><hr>
      <h2>".$row['IName']."</h2>
      <h3>MRP : ".$row['price']."</h3>
      Quantity : <input type='text' id='quantity' name='quantity'>
      <input type='hidden' name='hidden_name' value=".$row['IName'] ." />  
      <input type='hidden' name='hidden_price' value=".$row['price']." />
      <button name='add_to_cart' class='atc'>Add to Cart</button>
  </div>"; -->

  <div class="items">  
                     <form method="post" action="index.php?action=add&id=<?php echo $row["_id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src=<?php echo "$i".".png";?> class="img-responsive"  width='200' height='200'/><br />  <hr>
                               <h4 class="text-info"><?php echo $row["IName"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
                               <h4 class="text-danger">Available Stock : <?php echo $row["stock"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["IName"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" /> 
                               <input type="hidden" name="hidden_stock" value="<?php echo $row["stock"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="atc" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>
    
    <?php
    $i+=1;
    }
  }?>
  
  
  
          
          
      </div>

      <?php

      if(isset($_SESSION['use'])){
           $total=0;
          $con=mysqli_connect("localhost","root","");
          $dbname="id18559975_medicine_store";
          $eid=$_SESSION['use'];
          if (!$con)
          {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
              echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
              exit;
          }
          mysqli_select_db($con,$dbname);
          $r = mysqli_query($con,"SELECT * FROM Cart_details WHERE EmailID='$eid'");
          echo "<h3>Order Details</h3>";
          echo "<table border='1'>

                <tr>
                
                <th>ItemName</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Update</th>
                
                </tr>";
                
                while($row = mysqli_fetch_array($r,MYSQLI_ASSOC))
                {
                  echo "<tr>";
                
                  echo "<td>" . $row['ITEM_NAME'] . "</td>";
                
                  echo "<td>" . $row['PRICE'] . "</td>";
                
                  echo "<td>" . $row['QUANTITY'] . "</td>";

                  $total=$total+($row['PRICE'] * $row['QUANTITY']);
                  $_SESSION['total']=$total;
                
                  ?>
                
                  <td><a href="deletecartItems.php?id=<?php echo $row['id']; ?>">Delete</a></td>

                  </td>
                  </tr>
                  <?php
               //    echo "";
                }
                echo "<tr><td>Total</td><td> </td> <td></td><td>".$_SESSION['total']."</td></tr>";
                echo "</table>";?>
                 <br>
                
                       <?php 
                       echo "<a href='Buy.php' style='background-color:#779fc5; border:3px solid;'>Buy</a>";
                       
                    } 
                    
        
      
      ?>
      
  </body>
  
  </html>