<?php

use App\models\Basket;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//получаем поток для работы с входными данными
$stream = file_get_contents("php://input");

if (isset($stream)) {
    //декодируем полученные данные
    $product_id = json_decode($stream)->data ?? false;
    $action = json_decode($stream)->action;
    $user_id = $_SESSION['id'];

    $productInBasket = match ($action) {
        "add" => Basket::add($product_id, $user_id),
        "minus" => Basket::minus($product_id, $user_id),
        "delete" => Basket::delete($product_id, $user_id),
        "clear" => Basket::clear($user_id)
    };
    $_SESSION['totalCount'] = Basket::totalCount($user_id);
    echo json_encode([
        "productInBasket" => $productInBasket,
        "totalPrice" => Basket::totalPrice($user_id),
        "totalCount" => Basket::totalCount($user_id)
    ], JSON_UNESCAPED_UNICODE);
}
