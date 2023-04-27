<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";


if (isset($_POST["canceled"])) {
    if(!empty($_POST["reason_cancel"])){
        Order::statusCansel($_POST['id'], $_POST["canceled-id"], $_POST["reason_cancel"]);
    }else{
        $_SESSION["error"] = "Заполните поле причина отмены";
        header("Location: /app/admin/tables/update.status.php");
        die();
    }
    
} else {
    Order::updateStatus($_POST['id'], $_POST['status-id']);
}



header("Location: /app/admin/tables/order.php");
