<?php

use App\models\Characteristic;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$characteristics = Characteristic::allCharacteristics();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/characteristic.view.php";
