<?php
// include('db.php');
require('Model\db.php');
//Function to return minimum price per item
function min_price($prod_id) {

    global $mysqli;

    $result = $mysqli->query("SELECT purchases.price_per_item AS pricePerItem FROM purchases WHERE product_id='$prod_id' ORDER BY purchases.price_per_item DESC ");

    while ($row2 = $result->fetch_assoc()) {

        $min = $row2["pricePerItem"];
    }

    if (!isset($min)) {
        return "n/a";
    }
    return $min;
}

//Function to return highest price per item
function max_price($prod_id) {

    global $mysqli;

    $result = $mysqli->query("SELECT purchases.price_per_item AS pricePerItem FROM purchases WHERE product_id='$prod_id' ORDER BY purchases.price_per_item");

    while ($row2 = $result->fetch_assoc()) {

        $max = $row2["pricePerItem"];
    }

    if (!isset($max)) {
        return "n/a";
    }
    return $max;
}

//Function to return average price per item
function avg_price($prod_id) {

    global $mysqli;

    $result = $mysqli->query("SELECT AVG(purchases.price_per_item) AS avg FROM purchases WHERE product_id='$prod_id'");

    $row = $result->fetch_assoc();

    $avg = number_format(round(floatval($row['avg']), 2), 2, '.', '');


    if (!isset($avg)) {
        return "n/a";
    }
    return $avg;
}

//Function to return highest price per quantity
function max_price_per($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT price_per_qnt FROM purchases WHERE product_id='$prod_id' ORDER BY price_per_qnt ");

    while ($row2 = $result2->fetch_assoc()) {

        $max = $row2["price_per_qnt"];
    }

    if (!isset($max)) {
        return "n/a";
    }

    return $max;
}

//Function to return lowest price per quantity
function min_price_per($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT price_per_qnt FROM purchases WHERE product_id='$prod_id' ORDER BY price_per_qnt DESC");

    while ($row2 = $result2->fetch_assoc()) {

        $min2 = $row2["price_per_qnt"];
    }

    if (!isset($min2)) {
        return "n/a";
    }

    return $min2;
}

//Function to return average price per quantity of product
function avg_price_per($prod_id) {

    global $mysqli;

    $result = $mysqli->query("SELECT AVG(price_per_qnt) AS avg FROM purchases WHERE product_id='$prod_id'");

    $row = $result->fetch_assoc();

    $avg = $english_format_number = number_format(round(floatval($row['avg']), 4), 4, '.', '');;

    if (!isset($avg)) {
        return "n/a";
    }

    return $avg;
}

//Function to return venue where highest price per quantity was recorded
function venue_per_max($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT venues.venue_name AS venueName
                                FROM purchases, venues
                                WHERE product_id='$prod_id' 
                                AND purchases.venue_id=venues.venue_id
                                ORDER BY price_per_qnt");

    while ($row2 = $result2->fetch_assoc()) {

        $venue_max = $row2["venueName"];
    }

    if (!isset($venue_max)) {
        return "n/a";
    }

    return $venue_max;
}

//Function to return venue where lowest price per quantity was recorded
function venue_per_min($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT venues.venue_name AS venueName
                                FROM purchases, venues
                                WHERE product_id='$prod_id' 
                                AND purchases.venue_id=venues.venue_id
                                ORDER BY price_per_qnt DESC");

    while ($row2 = $result2->fetch_assoc()) {

        $venue_min = $row2["venueName"];
    }

    if (!isset($venue_min)) {
        return "n/a";
    }

    return $venue_min;
}

//Function to return venue where highest price was recorded
function venue_max($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT venues.venue_name AS venueName
                                FROM purchases, venues
                                WHERE product_id='$prod_id' 
                                AND purchases.venue_id=venues.venue_id
                                ORDER BY purchases.price_per_item");

    while ($row2 = $result2->fetch_assoc()) {

        $venue_max = $row2["venueName"];
    }

    if (!isset($venue_max)) {
        return "n/a";
    }

    return $venue_max;
}

//Function to return venue where lowest price was recorded
function venue_min($prod_id) {

    global $mysqli;

    $result2 = $mysqli->query("SELECT venues.venue_name AS venueName
                                FROM purchases, venues
                                WHERE product_id='$prod_id' 
                                AND purchases.venue_id=venues.venue_id
                                ORDER BY purchases.price_per_item DESC");

    while ($row2 = $result2->fetch_assoc()) {

        $venue_min = $row2["venueName"];
    }


    if (!isset($venue_min)) {
        return "n/a";
    }

    return $venue_min;
}

//Function that creates pop-up message
function popMessage($message) {

    // $message = "lala";
    echo '<script type ="text/JavaScript">';
    echo 'alert("' . $message . '")';
    echo '</script>';
}
