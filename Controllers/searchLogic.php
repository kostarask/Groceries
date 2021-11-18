<?php

function searchLogic($keywords) {
    $keywords = trim($_POST['product_name']);

    $query = "SELECT products_final.product_id AS productId,
                products_final.product_name AS productName,
                product_subtypes.product_subtype_name AS productSubtype
                FROM products_final
                LEFT JOIN product_subtypes ON products_final.product_subtype_id = product_subtypes.product_subtype_id
                WHERE ";

    $searchParameter = explode(" ", $keywords);
    foreach ($searchParameter as $word) {
        $query .= " products_final.product_name LIKE '%$word%' OR";
    }
    $query = substr($query, 0, strlen($query) - 3);

    return $query;
}
