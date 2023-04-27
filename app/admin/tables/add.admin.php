<?php

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['chief-admin'])) {
    header("Location: /");
}
if (!$_SESSION['chief-admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$admins = Admin::allAdmin();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/add.admin.php";