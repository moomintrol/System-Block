<?php

use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

if (isset($_POST['btn-update'])) {
    if (empty($_POST['name']) || empty($_POST['price'])) {
        $_SESSION['error']['update-product'] = "Заполните все поля";
        $_SESSION['product']['id'] = $_POST['id'];
        header("Location: /app/admin/tables/show.php");
        die();
    }

    if ($_FILES['image']['name'] == "") {
        $name = $_POST['imageOld'];
    } else {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
        move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/System-Block/$name");
        unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/System-Block" . $_POST['imageOld']);
    }

    if ($_POST['category_id'] == "old") {
        $category = $_POST['old_category'];
    } else {
        $category = $_POST['category_id'];
    }

    Product::update($_POST['id'], $_POST['name'], $_POST['price'], $name, $category);

    if ($_POST['cpu_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['cpu_svg'],$_POST['old-cpu_svg']);
    }
    if ($_POST['video_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['video_svg'],$_POST['old-video_svg']);
    }
    if ($_POST['ssd_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['ssd_svg'],$_POST['old-ssd_svg']);
    }
    if ($_POST['motherboard_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['motherboard_svg'],$_POST['old-motherboard_svg']);
    }
    if ($_POST['ram_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['ram_svg'],$_POST['old-ram_svg']);
    }
    if ($_POST['power-supply_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['power-supply_svg'],$_POST['old-power-supply_svg']);
    }
    if ($_POST['os_svg'] != "old") {
        Product::updateComponentInSb($_POST['id'], $_POST['os_svg'],$_POST['old-os_svg']);
    }
}

header("Location: /app/admin/tables/product.php");
