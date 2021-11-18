<?php
require('..\Model\db.php');

/**
 * Function that returns the total expenses for a single product for the current year
 *
 * @param [number] $prodId
 * @return array
 */
function chartExpencesForThisYear($prodId) {
    global $mysqli;
    $result = $mysqli->query(
        "SELECT purchases.price_per_item AS price, DATE_FORMAT(purchases.date_of_purchase,'%M') AS dateOfPurchase
        FROM purchases
        WHERE purchases.product_id=$prodId
        AND YEAR(purchases.date_of_purchase)= YEAR(CURDATE())
        ORDER BY MONTH(purchases.date_of_purchase)"
    );

    return $result;
}


/**
 * Function that returns the average expenses for a single product per annum
 *
 * @param [type] $prodId
 * @return void
 */
function chartAvgPerYear($prodId) {
    global $mysqli;

    $result = $mysqli->query(
        "SELECT AVG(purchases.price_per_item) AS price, YEAR(purchases.date_of_purchase) AS dateOfPurchase
        FROM purchases
        WHERE purchases.product_id=$prodId
        GROUP BY YEAR(purchases.date_of_purchase)"
    );

    return $result;
}

/**
 * Function that returns the total expenses for a single product per annum
 *
 * @param [number] $prodId
 * @return array
 */
function chartTotalPerYear($prodId) {
    global $mysqli;
    $result = $mysqli->query(
        "SELECT SUM(purchases.price_per_item) AS price, YEAR(purchases.date_of_purchase) AS dateOfPurchase
        FROM purchases
        WHERE purchases.product_id=$prodId
        GROUP BY YEAR(purchases.date_of_purchase)"
    );

    return $result;
}
