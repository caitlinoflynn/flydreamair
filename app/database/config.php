<?php

include(ROOT_PATH . "/app/helpers/validate.php");


session_start();
require('connect.php');



// -------------------------------------- MAIN FUNCTIONS  ----------------------------------------------- //

function dd($data) {
    echo "<pre>", print_r($data, true), "</pre>";
    die();
}

function executeQuery($sql, $data) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function selectALL($table, $conditions = []) {
    global $conn;

    $sql = "SELECT * FROM $table";

    if (empty($conditions)) {

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        
        //if the conditions are not empty, return records that match conditions
        //e.g. $sql = SELECT * FROM $table WHERE username="lampbox593" and AND admin="0";
        
        //extend $sql from $table variable
        $i = 0;


        foreach ($conditions as $key => $value) {

            //if index value ($i) is equal to 0
            if ($i === 0) {
                //$sql = "SELECT * FROM $table";
                //WHERE clause will be used
                //'?' the is placeholder for $value
                $sql = $sql . " WHERE $key = ?";
            } else {
                //AND clause will be used
                $sql = $sql . " AND $key= ?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions) {

    global $conn;

    $sql = "SELECT * FROM $table";

    $i = 0;


    foreach ($conditions as $key => $value) {

        if ($i === 0) {
            $sql = $sql . " WHERE $key = ?";
        } else {
            $sql = $sql . " AND $key = ?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function create($table, $data) {
    //global connection
    global $conn;

    //sql query
    //e.g. $sql = "INSERT INTO users SET username=?, admin=?, password=?"
    $sql = "INSERT INTO $table SET";

    //index value
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key = ?";
        } else {
            $sql = $sql . ", $key = ?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data) {
    global $conn;
    $sql = "UPDATE $table SET";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key = ?";
        } else {
            $sql = $sql . ", $key = ?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id = ? ";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function delete($table, $id) {
    global $conn;
    $sql = "DELETE FROM $table WHERE id = ? ";

    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}


function getProducts() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_products
             JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id";

    $stmt = executeQuery($sql, []);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getFiveProducts() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_products
             JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
             WHERE results_page = ?";

    $stmt = executeQuery($sql, ['results_page' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getBrandName() {
    global $conn;
    global $brand_id;
    
     $sql = "SELECT name AS brand FROM flydreamair_brands WHERE id = ?";

    $stmt = executeQuery($sql, ['results_page' => $brand_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


function getHomeCategories() {
    global $conn;
    
     $sql = "SELECT * FROM flydreamair_categories WHERE home_page = ?";

    $stmt = executeQuery($sql, ['home_page' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getAllCategories() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT * FROM flydreamair_categories";

    $stmt = executeQuery($sql, []);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getCategories() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT * FROM flydreamair_categories WHERE id = ?";

    $stmt = executeQuery($sql, ['id' => $category_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getProductsByCategory() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_products
     JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
     WHERE flydreamair_products.category_id = ?";

    $stmt = executeQuery($sql, ['flydreamair_products.category_id' => $category_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getProductsBySubcategory() {
    global $conn;
    
     $sql = "SELECT flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_products
     JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
     WHERE flydreamair_products.subcategory_id = ?";

    $stmt = executeQuery($sql, ['flydreamair_products.subcategory_id' => $_GET['s_id']]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getSubcategoriesByCategory() {
    global $conn;
    global $category_id;
    global $subcategory_id;
    
     $sql = "SELECT * FROM flydreamair_subcategories WHERE category_id = ?";

    $stmt = executeQuery($sql, ['category_id' => $category_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getWishlist() {
    global $conn;
    
     $sql = "SELECT flydreamair_wishlist.id AS wishlist_id, flydreamair_wishlist.*, flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_wishlist
     JOIN flydreamair_products ON flydreamair_wishlist.product_id = flydreamair_products.id
     JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
     WHERE flydreamair_wishlist.user_id = ?";

    $stmt = executeQuery($sql, ['flydreamair_wishlist.user_id' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getCart() {
    global $conn;
    
     $sql = "SELECT flydreamair_cart.id AS cart_id, flydreamair_cart.*, flydreamair_products.*, flydreamair_brands.name AS brand FROM flydreamair_cart
     JOIN flydreamair_products ON flydreamair_cart.product_id = flydreamair_products.id
     JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
     WHERE flydreamair_cart.user_id = ?";

    $stmt = executeQuery($sql, ['flydreamair_cart.user_id' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

$carts = getCart();

function countWishlistItems() {
    global $conn;
    $sql = "SELECT COUNT(id) FROM flydreamair_wishlist WHERE user_id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countCartItems() {
    global $conn;
    $sql = "SELECT COUNT(id) FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countTotalPrice() {
    global $conn;
    $sql = "SELECT SUM(price) FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countTotalPoints() {
    global $conn;
    $sql = "SELECT SUM(points) FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countProductsInCategory() {
    global $conn;
    global $category_id;
    $sql = "SELECT COUNT(id) FROM flydreamair_products WHERE category_id = " . $category_id;
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}

function countOrders() {
    global $conn;
    global $category_id;
    $sql = "SELECT COUNT(DISTINCT order_placed) FROM flydreamair_orders WHERE user_id = " . $_SESSION['id'] . " GROUP BY DATE(order_placed)";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
}
function searchProducts($term) {
    
    global $conn;
    
     $sql = "SELECT flydreamair_products.*, flydreamair_brands.name AS brand 
             FROM flydreamair_products 
             JOIN flydreamair_brands ON flydreamair_products.brand_id = flydreamair_brands.id
             WHERE flydreamair_products.description LIKE '%$term%' OR flydreamair_brands.name LIKE '%$term%'";

    $stmt = executeQuery($sql, []);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getTierLevel() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT flydreamair_user_levels.*, flydreamair_levels.* FROM flydreamair_user_levels 
             JOIN flydreamair_levels ON flydreamair_user_levels.level_id = flydreamair_levels.id
             WHERE flydreamair_user_levels.user_id = ?";
   $stmt = executeQuery($sql, ['flydreamair_user_levels.user_id' => $_SESSION['id']]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getOrders() {
    global $conn;
    global $category_id;
    
     $sql = "SELECT *, COUNT(quantity) as total_items FROM flydreamair_orders WHERE user_id = " . $_SESSION['id'] . " GROUP BY order_placed";
     
   $stmt = executeQuery($sql, []);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}









