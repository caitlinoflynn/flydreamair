<?php

$table = 'flydreamair_subcategories';

$subcategories = selectALL($table);

$errors = array();
$id = '';
$name = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $subcategory = selectOne($table, ['id' => $id]);
    $id = $subcategory['id'];
    $name = $subcategory['name'];
}

if(isset($_POST['add'])) {
    $errors = validateSubCategory($_POST);

    if (count($errors) === 0) {
        unset($_POST['add']);
        
        $_POST['name'] = str_replace(' ', '-', strtolower($_POST['name']));

        $subcategoryId = create($table, $_POST);
        $_SESSION['message'] = 'Season created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . FDA_BASE_URL . '/admin/subcategories/create.php');
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}

if (isset($_POST['update'])) {
    $errors = validateSeason($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update'], $_POST['id']);
        
        $_POST['name'] = str_replace(' ', '-', strtolower($_POST['name']));

        $seasonId = update($table, $id, $_POST);
        $_SESSION['message'] = 'Season updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/seasons/');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

    }

}

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Season deleted successfully';
    $_SESSION['type'] = 'sucess';
    header('location: ' . BASE_URL . '/admin/seasons/');
    exit();
}