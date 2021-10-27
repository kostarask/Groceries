<?php
include('includes/db.php');

//Function to return minimum price
function min_price($prod_name){
    
    global $mysqli;
    
    $result = $mysqli->query("SELECT product_price FROM purchases WHERE product_name='$prod_name' ORDER BY product_price DESC ");
    
    while ($row2 = $result->fetch_assoc()){
        
        $min = $row2["product_price"];
    }
        
    return $min;
}

//Function to return highest price
function max_price($prod_name){
    
    global $mysqli;
    
        $result = $mysqli->query("SELECT product_price FROM purchases WHERE product_name='$prod_name' ORDER BY product_price");
    
    while ($row2 = $result->fetch_assoc()){
        
        $max = $row2["product_price"];
    }
        
    return $max;
}

//Function to return average price
function avg_price($prod_name){
    
    global $mysqli;
    
        $result= $mysqli->query("SELECT AVG(product_price) AS avg FROM purchases WHERE product_name='$prod_name'");

        $row = $result->fetch_assoc(); 
    
        $avg = number_format(round(floatval($row['avg']),2), 2, '.', '');

    return $avg;
}

//Function to return highest price per quantity
function max_price_per($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT price_per_qnt FROM purchases WHERE product_name='$prod_name' ORDER BY price_per_qnt ");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $max = $row2["price_per_qnt"];
    }
        
    return $max;
}

//Function to return lowest price per quantity
function min_price_per($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT price_per_qnt FROM purchases WHERE product_name='$prod_name' ORDER BY price_per_qnt DESC");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $min2 = $row2["price_per_qnt"];
    }
        
    return $min2;
}

//Function to return average price per quantity of product
function avg_price_per($prod_name){
    
    global $mysqli;
    
        $result= $mysqli->query("SELECT AVG(price_per_qnt) AS avg FROM purchases WHERE product_name='$prod_name'");

        $row = $result->fetch_assoc(); 

        $avg = $english_format_number = number_format(round(floatval($row['avg']),2), 2, '.', '');;

    return $avg;
}

//Function to return venue where highest price per quantity was recorded
function venue_per_max($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT venue FROM purchases WHERE product_name='$prod_name' ORDER BY price_per_qnt ");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $venue_max = $row2["venue"];
    }
        
    return $venue_max;
}

//Function to return venue where lowest price per quantity was recorded
function venue_per_min($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT venue FROM purchases WHERE product_name='$prod_name' ORDER BY price_per_qnt DESC");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $venue_min = $row2["venue"];
    }
        
    return $venue_min;
}

//Function to return venue where highest price was recorded
function venue_max($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT venue FROM purchases WHERE product_name='$prod_name' ORDER BY product_price ");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $venue_max = $row2["venue"];
    }
        
    return $venue_max;
}

//Function to return venue where lowest price was recorded
function venue_min($prod_name){
    
    global $mysqli;
    
    $result2 = $mysqli->query("SELECT venue FROM purchases WHERE product_name='$prod_name' ORDER BY product_price DESC");
    
    while ($row2 = $result2->fetch_assoc()){
        
        $venue_min = $row2["venue"];
    }
        
    return $venue_min;
}

//Function that checks if the requested entry allready exists in the database
function checkDbForEntry2($tableName, $collumnName, $condition, $action,){
    global $mysqli;
    $result = $mysqli -> query("SELECT * FROM $tableName 
                                WHERE $collumnName = '$condition'");
    if($result->num_rows>0){

        unset($_SERVER['REQUEST_METHOD']);
        unset($_POST['category']);
        header("location: $action");
    }
  }

//Function that checks if the requested entry allready exists in the database
function checkDbForEntrySimple($tableName, $collumnName, $condition){
    global $mysqli;
    $result = $mysqli -> query("SELECT * FROM $tableName 
                                WHERE $collumnName = '$condition'");
    if($result->num_rows>0){
        return true;
    }
    if(!($result->num_rows>0)){
        return false;
    }
  }

//Function that creates pop-up message
function popMessage($message){

    // $message = "lala";
    echo '<script type ="text/JavaScript">';  
echo 'alert("'.$message.'")';  
echo '</script>'; 
}


?>
