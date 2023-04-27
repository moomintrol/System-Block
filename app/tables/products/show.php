<?php

use App\models\Order;
use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
unset($_SESSION['product_id']);

if (isset($_POST['btn-more'])) {
    $_SESSION['product_id'] = $_POST['id'];
}

$product = Product::find($_SESSION['product_id']);
$allComponents = Product::allComponentsInSB($_SESSION['product_id']);
$allReviews = Order::allReviewOrderByProduct($_SESSION['product_id']);
$sumRating = Order::sumRatingForProductInOrder($_SESSION['product_id']);
$countRating = Order::countRatingForProductInOrder($_SESSION['product_id']);

if ($countRating > 0) {
    $overallRating = $sumRating / $countRating;
} else {
    $overallRating = 0;
}

$countStars = [];
for ($i = 1; $i < 6; $i++) {
    $countStars[] = Order::feedbackPercentage($_SESSION['product_id'], $i);
}

$percentages = [];

foreach ($countStars as $item) {

    $percent =  $countRating > 0 ? $item / $countRating * 100 : 0;
    $percentages[] = $percent;
}


include $_SERVER['DOCUMENT_ROOT'] . "/views/products/show.view.php";
