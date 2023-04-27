<?php

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['error']);
unset($_SESSION['admin']);

if (isset($_POST['btnAdmin'])) {
    $user = User::getUser($_POST['email'], $_POST['password']);
    if ($user == null) {
        $_SESSION['error'] = "Пользователь не найден";
        header("Location: /app/admin/tables/auth.php");
        die();
    } else {
        if ($user->status == 'Администратор') {
            $_SESSION["id"] = $user->id;
            $_SESSION['admin'] = true;
            header("Location: /app/admin/tables/category.php");
        } elseif ($user->status == 'Главный администратор') {
            $_SESSION["id"] = $user->id;
            $_SESSION['admin'] = true;
            $_SESSION['chief-admin'] = true;
            header("Location: /app/admin/tables/category.php");
        } else {
            $_SESSION['error'] = "Вы не являетесь администратором";
            header("Location: /app/admin/tables/auth.php");
        }
    }
}
