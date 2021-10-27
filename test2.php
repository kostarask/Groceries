<?php
include("includes/functions.php");
require("includes/db.php");


if(isset($_GET['message'])){
  popMessage($_GET['message']);
}

$product = $_GET['message'];
$products = $mysqli->query("SELECT product_id FROM products_final WHERE product_name LIKE '$product'");
 while ($row = $products->fetch_assoc()) {
   $productID = $row['product_id'];
   echo $productID;
 }
 


?>

