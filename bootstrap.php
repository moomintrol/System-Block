<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/app/config/db.php";

include $_SERVER['DOCUMENT_ROOT'] . "/app/helpers/Connection.php";

include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Category.php";

include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Product.php";

include $_SERVER['DOCUMENT_ROOT'] . "/app/models/User.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Basket.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Order.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Component.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Characteristic.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Admin.php";
