<?php

use App\models\Admin;
use App\models\Category;
use App\models\Product;
use App\models\Characteristic;
use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//получаем поток для работы с входными данными
$stream = file_get_contents("php://input");

if (isset($stream)) {
    $action = json_decode($stream)->action;
    $id = json_decode($stream)->data;

    $productInBasket = match ($action) {
        "deleteCategory" => Category::deleteCategory($id),
        "deleteProduct" => Product::deleteProduct($id),
        "deleteAdmin" => Admin::deleteAdmin($id),
        "deleteCharacteristic" => Characteristic::deleteCharacteristic($id),
        "deleteComponent" => Component::deleteComponent($id)
    };

    echo json_encode([
        "productInBasket" => $productInBasket,
    ], JSON_UNESCAPED_UNICODE);
}
