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

$products = Product::all();
$categories = Category::all();
$accessories = Admin::allAccessories();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/products.view.php";
