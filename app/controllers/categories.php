<?php

$table = 'flydreamair_categories';

$categories = selectALL($table);

$errors = array();
$id = '';
$name = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = selectOne($table, ['id' => $id]);
    $id = $category['id'];
    $name = $category['name'];
}

if(isset($_POST['add'])) {
    $errors = validateCategory($_POST);

    if (count($errors) === 0) {
        unset($_POST['add']);

        $categoryId = create($table, $_POST);
        $_SESSION['message'] = 'Season created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . FDA_BASE_URL . '/admin/categories/create.php');
        exit();
    } else {
        $name = $_POST['name'];
    }

}
