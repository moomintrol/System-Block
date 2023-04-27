<?php

use App\models\Order;
use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['product_id'])) {
    $product_id = $_POST['id'];
} else {
    $product_id = $_SESSION['product_id'];
}

if (empty($_POST['radio'])) {
    $radio = null;
} else {
    $radio = $_POST['radio'];
}

if (empty($_POST['review'])) {
    $review = null;
} else {
    $review = $_POST['review'];
}

$review = Order::review($product_id, $_SESSION['id'], $radio, $review);

if ($review == "status") {
    echo json_encode([
        "error" => "Ваш заказ ещё не пришёл"
    ], JSON_UNESCAPED_UNICODE);
    die();
}

if ($review == "review") {
    echo json_encode([
        "error" => "Вы уже оставляли отзыв"
    ], JSON_UNESCAPED_UNICODE);
    die();
}

if ($review == null) {
    $updateRating = Product::updateRating($product_id);
    echo json_encode([
        "review" => $product_id,
    ], JSON_UNESCAPED_UNICODE);
    die();
}
