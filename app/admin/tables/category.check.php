<?php

use App\models\Category;

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$extensions = ["jpeg", "jpg", "png", "webp"];
$types = ["image/jpg", "image/jpeg", "image/png", "image/webp"];

if (isset($_POST['btnAddCategory'])) {
    $category = Category::getCategory($_POST['name']);

    if (isset($_FILES['image'])) {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];

        $path_parts = pathinfo($name);

        $ext = $path_parts["extension"];
        $mimeType = mime_content_type($tmpName);

        if (in_array($ext, $extensions) && in_array($mimeType, $types)) {

            if ($error == 0) {
                if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/icons/$name")) {
                    $_SESSION['error'] = "Не получилось переместить файл";
                }
            } else {
                $_SESSION['error'] = 'Ошибка';
            }
        } else {
            $_SESSION['error'] = 'Расширение файла должно быть: ' . implode(", ", $extensions);
        }
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
