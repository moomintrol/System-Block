<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if(isset($_POST['btnUpdateStatus'])){
    $_SESSION['order-id'] = $_POST['id'];
}

$order = Order::findStatusInOrder($_SESSION['order-id']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/update.status.php";