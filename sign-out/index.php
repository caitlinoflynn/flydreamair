<?php
include("../path.php");
session_start();
include(ROOT_PATH . "/app/database/connect.php");

unset($_SESSION['id']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);
unset($_SESSION['username']);
unset($_SESSION['dob']);
unset($_SESSION['email']);
unset($_SESSION['phone_number']);
unset($_SESSION['points']);

session_destroy();

header('location: ' . FDA_BASE_URL . '/');