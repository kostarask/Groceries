<?php
include('db.php');

// Function that returns all from given tableName
function queryAll($tableName) {

    global $mysqli;
    $results = $mysqli->query("SELECT * FROM $tableName");

    return $results;
}

//Function that returns array with query results for show_expenses page
function showExpensesQuery($startDateDb, $endDateDb, $groupByVariable) {

    global $mysqli;
    $results = $mysqli->query(
        "SELECT product_subtypes.product_subtype_name AS productSubtypeName,
                products_final.product_name AS productName,
                product_types.product_type_name AS productTypeName,
                product_categories.category_name AS productCategoryName,
                venues.venue_name AS venueName,
                SUM(purchases.product_price) AS totalSpent
        FROM purchases
        LEFT JOIN products_final ON purchases.product_id=products_final.product_id
        LEFT JOIN  product_subtypes ON products_final.product_subtype_id=product_subtypes.product_subtype_id
        LEFT JOIN  product_types ON product_subtypes.product_type_id=product_types.product_type_id
        Left JOIN product_categories ON product_types.category_id=product_categories.category_id
        LEFT JOIN venues ON purchases.venue_id=venues.venue_id
        WHERE purchases.date_of_purchase BETWEEN '$startDateDb' AND '$endDateDb'
        GROUP BY $groupByVariable"
    );

    return $results;
}

//Function that returns array with query results for show_subtypes page
function showSubtypesQuery() {

    global $mysqli;
    $results = $mysqli->query(
        "SELECT product_subtypes.product_subtype_id AS productSubtypeID,
                product_subtypes.product_subtype_name AS productSubTypeName, 
                product_types.product_type_name AS productTypeName
        FROM product_subtypes 
        LEFT JOIN product_types ON product_subtypes.product_type_id = product_types.product_type_id"
    );

    return $results;
}

//Function that returns array with query results for show_types page
function showTypesQuery() {

    global $mysqli;
    $results = $mysqli->query(
        "SELECT product_types.product_type_id AS productID,
                product_types.product_type_name AS productTypeName, 
                product_categories.category_name AS categoryName
        FROM product_types 
        LEFT JOIN product_categories ON product_types.category_id = product_categories.category_id"
    );

    return $results;
}
