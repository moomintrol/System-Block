<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPC</title>
    <link type="image/x-icon" href="/upload/icons/logo.svg" rel="shortcut icon">
    <link type="Image/x-icon" href="/upload/icons/logo.svg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.admin.css">
</head>

<body>
    <header class="header-admin">
        <nav class="nav-header-admin">
            <a href="/app/admin/tables/category.php"><img class="logo" class="logo" src="/upload/icons/logo.svg" alt="logo"></a>
            <ul>
                <?php if (empty($_SESSION['admin'])) : ?>
                    <li></li>
                <?php else : ?>
                    <li><a href="/app/admin/tables/category.php">Категории</a></li>
                    <li><a href="/app/admin/tables/product.php">Продукты</a></li>
                    <li><a href="/app/admin/tables/order.php">Заказы</a></li>
                    <?php if (isset($_SESSION['chief-admin'])) : ?>
                        <li><a href="/app/admin/tables/add.admin.php">Администраторы</a></li>
                    <?php endif ?>
                    <li><a href="/app/admin/tables/characteristic.php">Характеристики</a></li>
                    <li><a href="/app/admin/tables/component.php">Компоненты</a></li>
                    <li><a href="/app/tables/users/logout.php">Выйти</a></li>
                <?php endif ?>
            </ul>
        </nav>
    </header>