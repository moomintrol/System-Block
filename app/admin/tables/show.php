<?php

use App\models\Admin;
use App\models\Category;
use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

if (isset($_POST['id'])) {
    $_SESSION['product']['id'] = $_POST['id'];
}

$product = Product::find($_SESSION['product']['id']);
$components = Product::allComponentsInSB($_SESSION['product']['id']);
$accessories = Admin::allAccessories();
$categories = Category::all();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/show.view.php";
