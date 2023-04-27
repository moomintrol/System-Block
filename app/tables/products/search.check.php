<?php

use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_GET['category']) || empty($_GET['category']) || $_GET['category'] == 'all') {
    $products = Product::all();
} else {
    //иначе получаем товары по категории
    $products = Product::productsByManyCategories($_GET['category']);
}

echo json_encode($products, JSON_UNESCAPED_UNICODE);
