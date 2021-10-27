<?php
include("src/functions.php");
require("db.php");

    $id = $_GET['q'];

    $sql = "SELECT DISTINCT product_name FROM purchases WHERE product_name like '%".$id."%' ";

    $result = $mysqli->query($sql);




    if ($result->num_rows>0){
        while($row = $result -> fetch_assoc()){
            echo $row["product_name"]. "\n";
        }
    }


?>