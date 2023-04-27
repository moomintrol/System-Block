<?php

use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$res = [];
$blocks = null;

if (!empty($_POST['cpu'])) {
    $res += Product::fillterByCpu($_POST);
    $blocks = array_map(function ($item) {
        return $item->id;
    }, $res);
}

if (!empty($_POST['video-card']) || empty($_POST['before-cost'])) {
    $res = Product::fillterByVideo($_POST, $blocks);
}

if (empty($_POST['cpu']) && empty($_POST['video-card'])) {
    $res =  Product::fillterByCost($_POST);
}

echo json_encode($res, JSON_UNESCAPED_UNICODE);
