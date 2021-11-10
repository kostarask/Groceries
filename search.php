<?php
require("includes/db.php");
include("includes/functions.php");

if(isset($_POST['product_name'])){

    $product_name = $_POST['product_name'];

    if(checkDbForEntrySimple('products_final', 'product_name', $product_name)){
      header("location: product_history.php?productName=$product_name");
    }else{
      header("location: show_products.php?message=Error: Product does not exist. Please choose one from the list,");
    }
}


?>