<?php

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if(isset($_POST['btn-profile-save'])){
    if(empty($_POST['email']) || empty($_POST['phone'])){
        $_SESSION['error'] = 'Заполните все поля';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Неправильный email';
    }

    if(!isset($_SESSION['error'])){
        User::updateInfo($_SESSION['id'],$_POST['email'],$_POST['phone']);
    }
}

header("Location: /app/tables/users/profile.php");