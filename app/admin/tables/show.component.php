<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$productsInOrder = Component::getInfoByComponent($_POST['id']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/show.component.view.php";
