<?php

use App\models\Category;

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (isset($_POST['btnAddCategory'])) {
    $category = Category::getCategory($_POST['name']);

    if (isset($_FILES['image'])) {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
    }

    if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/icons/$name")) {
        $_SESSION['error'] = "Не получилось переместить файл";
    }

    if (empty($_POST['name'])) {
        $_SESSION['error'] = 'Заполните поле';
    }

    if ($category != null) {
        $_SESSION['error'] = 'Такая категория уже есть';
    }
    
    if (!isset($_SESSION['error'])) {
        Category::addCategory($_POST['name'], $name);
    }
}

header("Location: /app/admin/tables/category.php");
