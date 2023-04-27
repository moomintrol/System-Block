<?php

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (isset($_POST['btn-add-admin'])) {

    if (empty($_POST['surname']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Не все поля заполнены";
    }

    $_SESSION['new-admin']['surname'] = $_POST['surname'];
    $_SESSION['new-admin']['name'] = $_POST['name'];
    $_SESSION['new-admin']['email'] = $_POST['email'];
    $_SESSION['new-admin']['phone'] = $_POST['phone'];

    if (!isset($_SESSION['error'])) {
        unset($_SESSION['new-admin']);
        if (Admin::addAdmin($_POST) == null) {
            $_SESSION['error'] = "Такой пользователь уже есть в базе";
        }
    }
}

header("Location: /app/admin/tables/add.admin.php");
