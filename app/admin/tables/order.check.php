<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['status']);
unset($_SESSION['error']);
// $_SESSION['status']['cansel'] = false;

if (isset($_POST['btnConfirm'])) {
    $_SESSION['status']['confirm'] = true;
    Order::updateStatus($_POST['id'], $_POST['status']);
}

if (isset($_POST['btnCancel'])) {
    if (empty($_POST['reason_cancel'])) {
        $_SESSION['error'] = 'заполните поле';
    }
    if (!isset($_SESSION['error'])) {
        $_SESSION['status']['cansel'] = true;
        Order::statusCansel($_POST['idCancel'], $_POST['statusCancel'], $_POST['reason_cancel']);
    }
}

header("Location: /app/admin/tables/order.php");
