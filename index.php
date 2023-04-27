<?php

use App\models\Category;
use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$categories = Category::all();
$processors = Component::CPU();
$videoCards = Component::videoCard();

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/index.view.php";
