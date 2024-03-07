<?php

$table = 'flydreamair_products';

$errors = array();
$id = '';
$name = '';
$description = '';
$price = '';
$points = '';
$category = '';
$subcategory = '';
$image = '';

$products = selectAll($table);
$categories = selectAll('flydreamair_categories');
$subcategories = selectAll('flydreamair_subcategories');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = selectOne($table, ['id' => $id]);
    $name = $product["name"];
    $description = $product['description'];
    $price = $product['price'];
    $points = $product['points'];
    $category = $product['category'];
    $subcategory = $product['subcategory'];
    $image = $product['image'];
}

    $name = $_POST["name"];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $points = $_POST['points'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];


$count = count($_POST['name']);

if(isset($_POST['add'])) {
    $errors = validateProduct($_POST);
    
        if (!empty($_FILES['image']['name'])) {
        $img_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/projects/flydreamair/images/products/" . $img_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $img_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    }
     else {
        array_push($errors, "Celebrity required");
    }

    if (count($errors) === 0) {
        unset($_POST['add']);
        
        $_POST['name'] = str_replace(' ', '-', strtolower($_POST['name']));

        $seasonId = create($table, $_POST);
        $_SESSION['message'] = 'Season created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/seasons/');
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}



if (isset($_POST['update'])) {
    
    $errors = validateSource($_POST);
    
    if (count($errors) === 0) {
        
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);

        $sourceId = update($table, $id, $_POST);
        $_SESSION['message'] = 'Source updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/season-colors/');
        exit();
        
    } else {
        
        $id = $_POST['id'];
    $name = $_POST["celeb_name"];
    $season = $_POST['season'];
    $sourceName = $_POST["source_name"];
    $link = $_POST["source_link"];
    
    }
    

}


if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Source deleted successfully';
    $_SESSION['type'] = 'sucess';
    header('location: ' . BASE_URL . '/admin/celebrities/sources/');
    exit();
}
