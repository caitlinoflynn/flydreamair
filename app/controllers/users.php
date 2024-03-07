<?php

$table = 'flydreamair_users';

$users = selectAll($table);

$errors = array();
$id = '';
$firstname = '';
$lastname = '';
$username = '';
$email = '';
$dob = '';
$phoneNumber = '';
$password = '';
$passwordConf = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = selectOne($table, ['id' => $_GET['id']]);

    $id = $user['id'];
    $firstname = $user['first_name'];
    $lastname = $user['last_name'];
    $username = $user['username'];
    $email = $user['email'];
    $dob = $user['dob'];
    $phoneNumber = $user['phone_number'];
}

function loginUser($user) {
    
    global $conn;
    
    $_SESSION['id'] = $user['id'];
    $firstname = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['dob'] = $user['dob'];
    $_SESSION['phone_number'] = $user['phone_number'];

    $_SESSION['type'] = 'success';
    
    header('location: ' . BASE_URL . '/projects/flydreamair/profile/');
    
}

if (isset($_POST['register-btn'])) {

        unset($_POST['register-btn'], $_POST['confirm-password']);
        
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $_POST['first_name'] = mysqli_real_escape_string($conn, $_POST['first_name']);
        $_POST['last_name'] = mysqli_real_escape_string($conn, $_POST['last_name']);
        $_POST['username'] = mysqli_real_escape_string($conn, $_POST['username']);
        $_POST['email'] = mysqli_real_escape_string($conn, $_POST['email']);
        $_POST['password'] = mysqli_real_escape_string($conn, $_POST['password']);
    
        $user_id = create($table, $_POST);
            
        $user = selectOne($table, ['id' => $user_id]);
        
        loginUser($user);
        
        header('location: ' . BASE_URL . '/projects/flydreamair/profile/');
        
}

//update user
if (isset($_POST['update-user'])) {
  //  adminOnly();
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-user'], $_POST['id']);
        
        

        $user_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'user updated successfully';
        $_SESSION['type'] = 'Updated';
        
        header('location: ../../profile/');
        exit();
    } else {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $darkMode = isset($_POST['dark_mode']) ? 1 : 0;

    }
}


if (isset($_POST['login-btn'])) {
    global $conn;
    $errors = validateFDALogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['email' => $_POST['email']]);
    
        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        } else {
            array_push($errors, 'Email or password is incorrect');
          
        }
    }
    $username = mysqli_real_escape_string($conn, ($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}


if (isset($_GET['del_id'])) {
    $count = delete($table, $_GET['del_id']);
    $_SESSION['message'] = 'User deleted';
    $_SESSION['type'] = 'success';
 //   header('location: ' . BASE_URL . '/admin/users/');
    exit();
}



