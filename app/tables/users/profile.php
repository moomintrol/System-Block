<?php
session_start();

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /");
    die();
}

unset($_SESSION['profile']);

if (isset($_GET['btn-user-orders'])) {
    $orders = User::findOrder($_SESSION['id']);
    $_SESSION['profile'] = 'order';
} else {
    $user = User::find($_SESSION['id']);
    $_SESSION['profile'] = 'profile';
}

include $_SERVER['DOCUMENT_ROOT'] . "/views/users/profile.view.php";
