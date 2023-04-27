<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$orders = Order::all();
$statuses = Order::allStatus();

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'all') {
        $orders = Order::all();
    } else {
        $orders = Order::ordersByManyStatuses($_GET['status']);
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/order.view.php";
