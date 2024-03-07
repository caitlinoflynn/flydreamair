<?php

$table = 'flydreamair_wishlist';

$wishlists = selectALL($table);

$errors = array();
$id = '';
$name = '';
$description = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $season = selectOne($table, ['id' => $id]);
    $id = $season['id'];
    $name = $season['name'];
    $description = $season['description'];
}

if(isset($_POST['add'])) {
    $errors = validateSeason($_POST);

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