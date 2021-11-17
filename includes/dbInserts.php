<?php
// include('db.php');
require('Model\db.php');

//Function that checks if the requested entry allready exists in the database
function checkDbForEntry2($tableName, $collumnName, $condition, $action,) {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM $tableName 
                                WHERE $collumnName = '$condition'");
    if ($result->num_rows > 0) {

        unset($_SERVER['REQUEST_METHOD']);
        unset($_POST['category']);
        header("location: $action");
    }
}

//Function that checks if the requested entry already exists in the database
function checkDbForEntry($tableName, $columnName, $condition) {
    global $mysqli;

    $result = $mysqli->query("SELECT * FROM $tableName WHERE $columnName = '$condition'");
    if ($result->num_rows > 0) {

        return true;
    }
}

// Function that inserts entry into Venues table
function insertEntryToVenues($venue_name) {
    global $mysqli;

    $sql2 = "INSERT INTO venues (venue_name) VALUES ('$venue_name')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_venues.php?message=New venue added successfully!");
    } else {
        header("location: show_venues.php?message=ERROR: New venue was not added!");
    }
}

// Function that inserts entry into Offers table
function insertEntryToOffers($offer_name) {
    global $mysqli;

    $sql2 = "INSERT INTO offers (offer_name) VALUES ('$offer_name')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_offers.php?message=New offer added successfully!");
    } else {
        header("location: show_offers.php?message=ERROR: New offer was not added!");
    }
}

// Function that inserts entry into Categories table
function insertEntryToCategories($category_name) {
    global $mysqli;

    $sql2 = "INSERT INTO product_categories (category_name) VALUES ('$category_name')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_product_categories.php?message=New category added successfully!");
    } else {
        header("location: show_product_categories.php?message=ERROR: New category was not added!");
    }
}

// Function that inserts entry into Types table
function insertEntryToTypes($product_type_name, $category_id) {
    global $mysqli;

    $sql2 = "INSERT INTO product_types (product_type_name, category_id) VALUES ('$product_type_name', '$category_id')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_product_types.php?message=New product type added successfully!");
    } else {
        header("location: show_product_types.php?message=ERROR: New product type was not added!");
    }
}

// Function that inserts entry into Subtypes table
function insertEntryToSubtypes($product_subtype_name, $product_type_id) {
    global $mysqli;

    $sql2 = "INSERT INTO product_subtypes (product_subtype_name, product_type_id) VALUES ('$product_subtype_name', '$product_type_id')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_product_subtypes.php?message=New product subtype added successfully!");
    } else {
        header("location: show_product_subtypes.php?message=ERROR: New product subtype was not added!");
    }
}

// Function that inserts entry into Products table
function insertEntryToProducts($product_name, $product_subtype_id, $product_unit_id, $product_tag_id) {
    global $mysqli;

    $sql2 = "INSERT INTO products_final (product_name, product_subtype_id, product_unit_id, product_tag_id)
                VALUES ('$product_name', '$product_subtype_id', '$product_unit_id', '$product_tag_id')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_products.php?message=New product  added successfully!");
    } else {
        header("location: show_products.php?message=ERROR: New product  was not added!");
    }
}

// Function that inserts entry into Purchases table
function insertEntryToPurchases($productId2, $productPrice, $productQuantity, $pricePerQuantity, $dateOfPurchase, $venueId, $offerId, $qntItems, $pricePerQuantityOfItems) {
    global $mysqli;

    $sql2 = "INSERT INTO purchases (product_id, product_price, qnt_of_product, price_per_qnt, date_of_purchase, venue_id, offer_id, number_of_items, price_per_item) 
                        VALUES ('$productId2', '$productPrice', '$productQuantity', '$pricePerQuantity', '$dateOfPurchase', '$venueId', '$offerId', '$qntItems', '$pricePerQuantityOfItems')";

    if ($mysqli->query($sql2) === true) {
        header("location: show_purchases.php?message=New purchase  added successfully!");
    } else {
        header("location: show_purchases.php?message=ERROR: New purchase  was not added!");
    }
}
