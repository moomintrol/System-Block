<?php

use App\models\Admin;
use App\models\Characteristic;
use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$components = Component::all();
$characteristics = Characteristic::allCharacteristics();
$accessories = Admin::allAccessories();

if (isset($_GET['accessory'])) {
    if ($_GET['accessory'] == 'all') {
        $components = Component::all();
    } else {
        $components = Component::componentsByAccessory($_GET['accessory']);
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/component.view.php";
