<?php

use App\models\Basket;

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LPC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="/assets/css/itc-slider.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style-slider.css">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <script type="module" src="/assets/js/modals.js"></script>
    <script src="/assets/js/fetchUser.js"></script>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="/assets/js/burger.js"></script>
    <script src="/assets/js/itc-slider.js" defer></script>
</head>

<body>
    <header class="header-two">
        <a class="a-logo" href="/"><img class="img-logo" src="/upload/icons/logo.svg" alt="logo" /></a>
        <hr class="header-hr" />
        <div class="menu-burger__header">
            <span></span>
        </div>
        <div class="header-main-menu">
            <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                <div class="div-user">
                    <a class="nav-a user" href=""><img class="img-user" src="/upload/icons/user.svg" alt="user" /></a>
                </div>
            <?php else : ?>
                <div class="user-profile">
                    <a class="nav-a a-profile" href="/app/tables/users/profile.php"><img class="img-user" src="/upload/icons/user.svg" alt="user" /></a>
                    <a href="/app/tables/users/logout.php"><img class="exit" src="/upload/icons/exit.svg" alt="exit"></a>
                </div>
            <?php endif ?>
            <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                <div class="div-basket">
                    <a class="nav-a btn-basket-no-in" href="/#modal-wrapper"><img class="img-basket" src="/upload/icons/basket.svg" alt="basket" /></a>
                </div>
            <?php else : ?>
                <div class="div-basket">
                    <a class="nav-a div-user-basket" href="/app/tables/basket/basket.php">
                        <img class="img-basket" src="/upload/icons/basket.svg" alt="basket" />
                        <p class="count_all"><?= Basket::totalCount($_SESSION['id']) ?? 0 ?></p>
                    </a>
                </div>
            <?php endif ?>
        </div>
        <nav class="header__nav">
            <ul class="menu header__menu">
                <a class="nav-a nav-category" href="/#category">Каталог</a>
                <a class="nav-a" href="/#rating">Отзывы</a>
                <a class="nav-a" href="/#company">Компания</a>
                <a class="nav-a" href="/app/tables/accessories.php">Комплектующии</a>
            </ul>
        </nav>
    </header>

    <div class="modal-wrapper" id="modal-wrapper">
        <div class="modal">
            <div class="modal__div">
                <div class="modal-header">
                    <div class="modal-header-content">
                        <button class="btn-modal-header sign btn-modal-sign">
                            <h3>Вход</h3>
                        </button>
                        <h3>/</h3>
                        <button class="btn-modal-header reg">
                            <h3>Регистрация</h3>
                        </button>
                    </div>
                </div>
                <div class="modal__close">&times;</div>
                <div class="modal__content">
                    <form class="entrance" action="" method="POST" id="form-auth">
                        <input type="hidden" name="action" value="auth">
                        <input class="entrance-input" type="email" placeholder="email" name="email">
                        <input class="entrance-input" type="password" placeholder="пароль" name="password">
                        <p class="error-modal"></p>
                        <button class="btn-auth btn-modal" name="btnAuth">
                            <h3>Войти</h3>
                        </button>
                        <p class="help">Забыли логин / пароль?</p>
                    </form>
                </div>
            </div>
        </div>
    </div>