<?php

use App\models\Order;
use App\models\Product;
use App\models\User;

if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /app/users/create.php");
    die();
}

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php";
?>

<main>
    <section class="profile">
        <div class="links-profile">
            <form action="/app/tables/users/profile.php">
                <button name="btn-user-profile" class="btn-user-profile">
                    <p>Профиль</p>
                </button>
            </form>
            <form action="/app/tables/users/profile.php">
                <button name="btn-user-orders" class="btn-user-orders">
                    <p>Заказы</p>
                </button>
            </form>
        </div>

        <?php if ($_SESSION['profile'] == 'profile') : ?>
            <h2>Профиль</h2>
            <form class="profile-content" action="/app/tables/users/update.user.info.php" method="POST">
                <div class="info">
                    <p>Фамилия:</p>
                    <input disabled class="profile-input" name="surname" type="text" value="<?= $user->surname ?>">
                    <p>Имя:</p>
                    <input disabled class="profile-input" name="name" type="text" value="<?= $user->name ?>">
                    <p>Почта:</p>
                    <input class="profile-input" name="email" type="text" value="<?= $user->email ?>">
                    <p>Телефон:</p>
                    <input class="profile-input" name="phone" type="text" value="<?= $user->phone ?>">
                </div>
                <div class="mailing-list">
                    <label for="mailing-list">Согласие на рассылку</label>
                    <input type="checkbox" name="mailing-list" id="mailing-list">
                </div>
                <p class="error"><?= $_SESSION['error'] ?? "" ?></p>
                <button name="btn-profile-save" class="btn-profile-save">
                    <p>Сохранить</p>
                </button>
            </form>
        <?php else : ?>
            <h2>Заказы</h2>
            <div class="profile-order-content">
                <div class="profile-order-content-header">
                    <p><b>Дата</b></p>
                    <p><b>Статус</b></p>
                    <p><b>Способ оплаты</b></p>
                    <p><b>Общая стоимость</b></p>
                </div>
                <?php foreach ($orders as $order) : ?>
                    <div class="user-order">
                        <div class="user-order-info">
                            <p><?= $order->date_order ?></p>
                            <p><?= $order->status ?></p>
                            <p><?= $order->payment_method ?></p>
                            <p><?= (int)Order::totalPrice($order->id) ?>₽</p>
                        </div>
                        <div class="productsInOrder">
                            <div class="productsInOrder-header">
                                <p><b>Товар</b></p>
                                <p><b>Цена</b></p>
                                <p><b>Количество</b></p>
                            </div>
                            <?php foreach (User::findProductsInOrder($_SESSION['id'], $order->id) as $product) : ?>
                                <div class="user-order-product">
                                    <div class="user-order-product-info">
                                        <img class="user-order-img" src="/upload/System-Block/<?= $product->image ?>" alt="<?= $product->image ?>">
                                        <p><?= $product->name ?></p>
                                    </div>
                                    <div class="user-order-product-price">
                                        <p><?= $product->price * $product->count ?>₽</p>
                                        <p class="productsInOrder-price"><?= (int)$product->price ?>₽ за шт.</p>
                                    </div>
                                    <p class="productsInOrder-count"><?= $product->count ?> шт.</p>
                                    <form action="/app/tables/products/show.php" method="POST" target="_blank">
                                        <input type="hidden" name="id" value="<?= $product->sb_id ?>">
                                        <button name="btn-more" class="btn-more btn-more-profile">
                                            <p>Подробнее</p>
                                        </button>
                                    </form>
                                    <?php if (Order::searchReview($_SESSION['id'], $product->sb_id) == null) : ?>
                                        <button name="btn-review-profile" class="btn-review btn-review-profile" value="<?= $product->sb_id ?>">
                                            <p>Оставить отзыв</p>
                                        </button>
                                    <?php endif ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </section>

    <div class="modal-wrapper-review" id="modal-wrapper-review">
        <div class="modal-review">
            <div class="modal__div">
                <div class="modal__close__review modal__close">&times;</div>
                <div class="modal__content">
                    <form class="form-review" action="" method="POST">
                        <div class="madal-review-header">
                            <p class="madal-review-header-p">Ваш отзыв</p>
                        </div>
                        <div class="review-stars">

                            <input hidden class="radio-star" type="radio" name="radio" value="1" id="radio-1">
                            <label class="review-label" for="radio-1"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="2" id="radio-2">
                            <label class="review-label" for="radio-2"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="3" id="radio-3">
                            <label class="review-label" for="radio-3"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="4" id="radio-4">
                            <label class="review-label" for="radio-4"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="5" id="radio-5">
                            <label class="review-label" for="radio-5"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>
                        </div>
                        <textarea name="review" id="" cols="30" rows="10"></textarea>
                        <p class="error"></p>
                        <button class="btn-form-review" name="btn-form-review">
                            <p>Отправить</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/modal-review.js"></script>

<?php
unset($_SESSION['product_id']);
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>