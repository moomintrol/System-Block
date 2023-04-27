<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//дикодируем json данные(категории)
if (isset($_GET['status'])) {
    $statuses = json_decode($_GET['status']);

    //если выбрано всё, то запускаем метод получить всё
    if (!isset($statuses) || empty($statuses) || $statuses == 'all') {
        $products = Order::all();
    } else {
        //иначе получаем товары по категории
        $products = Order::ordersByManyStatuses($statuses);
    }
    echo json_encode($products, JSON_UNESCAPED_UNICODE);
}
