<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['error']);

if (isset($_POST['btn-confirm-order'])) {
    if (empty($_POST['street'])) {
        $_SESSION['error']['street'] = 'Заполните поле улица';
    }
    if (empty($_POST['home'])) {
        $_SESSION['error']['home'] = 'Заполните поле дом';
    }

    if (empty($_POST['date'])) {
        $_SESSION['error']['date'] = 'Выберите дату доставки';
    }
    if (empty($_POST['time'])) {
        $_SESSION['error']['time'] = 'Выберите время доставки';
    }

    if (isset($_SESSION['error'])) {
        header("Location: /app/tables/basket/order.php");
        die();
    }

    if (!isset($_SESSION['error'])) {
        $user_id = $_SESSION['id'];
        Order::create($user_id, $_POST['street'], $_POST['home'], $_POST['apartment'], $_POST['radio'], date("Y:m:d", strtotime($_POST['date'])), $_POST['time']);
    }
}

header("Location: /app/tables/basket/basket.php");
