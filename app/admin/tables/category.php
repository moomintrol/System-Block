<?php

use App\models\Category;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/auth.php");
}

$categories = Category::all();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/category.view.php";
