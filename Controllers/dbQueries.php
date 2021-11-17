<?php
// include('db.php');
require('..\Model\db.php');

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

//Function that returns array with query results for show_products page
function showProductsQuery() {

    global $mysqli;
    $results = $mysqli->query(
        "SELECT products_final.product_id AS productId,
                products_final.product_name AS productName, 
                product_units.product_unit_name AS productUnit,
                product_subtypes.product_subtype_name AS productSubtype,
                product_types.product_type_name AS productType,
                product_categories.category_name AS productCategory,
                product_tags.product_tag_name AS productTag
        FROM products_final
        LEFT JOIN product_units ON products_final.product_unit_id=product_units.product_unit_id
        LEFT JOIN product_subtypes ON products_final.product_subtype_id=product_subtypes.product_subtype_id
        LEFT JOIN product_types ON product_subtypes.product_type_id=product_types.product_type_id
        LEFT JOIN product_categories ON product_types.category_id=product_categories.category_id
        LEFT JOIN product_tags ON products_final.product_tag_id=product_tags.product_tag_id"
    );

    return $results;
}

//Function that returns array with query results for show_purchases page
function showPurchasesQuery($startDateDb, $endDateDb) {

    global $mysqli;
    $results = $mysqli->query(
        "SELECT purchases.purchace_id AS purchaseId,
                products_final.product_name AS productName,
                products_final.product_id AS productId,
                purchases.product_price AS productPrice,
                purchases.number_of_items AS munOfItems,
                purchases.price_per_item AS pricePerItem,
                purchases.date_of_purchase AS purchaseDate,
                venues.venue_name AS venueName,
                purchases.qnt_of_product AS productQuantity,
                purchases.price_per_qnt AS pricePerQuantity,
                product_tags.product_tag_name AS productTag,
                product_units.product_unit_name AS unitName,
                offers.offer_name AS offerName
        FROM purchases
        LEFT JOIN products_final ON purchases.product_id=products_final.product_id
        LEFT JOIN venues ON purchases.venue_id=venues.venue_id
        LEFT JOIN product_tags ON products_final.product_tag_id=product_tags.product_tag_id
        LEFT JOIN product_units ON products_final.product_unit_id=product_units.product_unit_id
        LEFT JOIN offers ON purchases.offer_id=offers.offer_id
        WHERE  purchases.date_of_purchase BETWEEN '$startDateDb' AND '$endDateDb'
        ORDER BY purchaseId DESC"
    );

    return $results;
}
