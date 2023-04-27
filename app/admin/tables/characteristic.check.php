<?php

use App\models\Characteristic;

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (isset($_POST['btnAddCharacteristic'])) {
    $characteristic = Characteristic::getCharacteristics($_POST['name']);

    if (empty($_POST['name'])) {
        $_SESSION['error'] = 'Заполните поле';
    } else {
        if ($characteristic != null) {
            $_SESSION['error'] = 'Такая характеристика уже есть';
        } else {
            Characteristic::addCharacteristics($_POST['name']);
        }
    }
}

header("Location: /app/admin/tables/characteristic.php");
