<?php

use App\models\Component;
use App\models\Product;

session_start();
unset($_SESSION['product']);
unset($_SESSION['error']);

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpg", "image/jpeg", "image/png", "image/webp", "image/jfif"];
$product = Product::getProduct($_POST['name']);

if (isset($_POST['btnAddProduct'])) {
    $_SESSION['product']['name'] = $_POST['name'];
    $_SESSION['product']['price'] = $_POST['price'];

    if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['cpu_svg']) || empty($_POST['video_svg']) || empty($_POST['ssd_svg']) || empty($_POST['motherboard_svg']) || empty($_POST['ram_svg']) || empty($_POST['power-supply_svg']) || empty($_POST['os_svg'])) {
        $_SESSION['error'] = 'Не все поля заполнены';
    }

    if (isset($_FILES['image'])) {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
    }

    if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/System-Block/$name")) {
        $_SESSION['error'] = "Не получилось переместить файл";
    }

    if (isset($_SESSION['error'])) {
        header("Location: /app/admin/tables/product.php");
    } else {
        Product::addProduct($_POST['name'], $_POST['price'], $name, $_POST['category_id']);
        $product = Product::getProduct($_POST['name']);
        $components = [$_POST['cpu_svg'], $_POST['video_svg'], $_POST['ssd_svg'], $_POST['motherboard_svg'], $_POST['ram_svg'], $_POST['power-supply_svg'], $_POST['os_svg']];
        Component::addComponentsInSb($product->id, $components);
        unset($_SESSION['product']);
    }
}

header("Location: /app/admin/tables/product.php");
