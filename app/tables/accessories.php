<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$acessories = Component::newComponents();

include $_SERVER['DOCUMENT_ROOT'] . "/views/accessories.view.php";