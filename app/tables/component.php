<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$component = Component::componentById($_GET['btn-component-info']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/component.view.php";