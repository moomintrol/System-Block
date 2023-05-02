<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['product']);
unset($_SESSION['error']);

$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpg", "image/jpeg", "image/png", "image/webp", "image/jfif"];

$product = Component::getComponent($_POST['meaning'], $_POST['characteristic_id'], $_POST['accessory_id']);

if (isset($_POST['addComponent'])) {
    $_SESSION['product']['meaning'] = $_POST['meaning'];

    if (empty($_POST['meaning'])) {
        $_SESSION['error'] = 'Заполните имя';
    }

    if ($product != null) {
        $_SESSION['error'] = 'Такой компонент уже есть';
    }

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
                if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/acessories/$name")) {
                    $_SESSION['error'] = "Не получилось переместить файл";
                }
            } else {
                $_SESSION['error'] = 'Ошибка';
            }
        } else {
            $_SESSION['error'] = 'Расширение файла должно быть: ' . implode(", ", $extensions);
        }
    }

    if (isset($_SESSION['error'])) {
        header("Location: /app/admin/tables/component.php");
    } else {
        Component::addComponent($_POST['meaning'], $_POST['characteristic_id'], $_POST['accessory_id'], $name, $_POST['description']);
        unset($_SESSION['product']);
    }
}

header("Location: /app/admin/tables/component.php");
