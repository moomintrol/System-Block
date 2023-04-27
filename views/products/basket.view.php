<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php";
?>

<main>
    <section class="basket">
        <div class="basket-content">
            <h2 class="h2-basket">Ваш заказ</h2>
            <button class="clear btn-basket-user">Очистить корзину</button>

            <div class="basket-products">
                <div class="basket-products-header">
                    <p>Товар</p>
                    <p>Количество</p>
                    <p>Цена</p>
                </div>
                <?php foreach ($productInBasket as $product) : ?>
                    <div class="basket-position" data-product-id="<?= $product->product_id ?>">
                        <div class="basket-position-product-info">
                            <img class="img-in-basket" src="/upload/System-Block/<?= $product->image ?>" alt="<?= $product->name ?>">
                            <p><?= $product->name ?></p>
                        </div>

                        <div class="basket-position-count">
                            <img class="minus" data-product-id="<?= $product->product_id ?>" src="/upload/icons/dash-circle.svg" alt="minus">

                            <p class="count" id="count-<?= $product->product_id ?>"><?= $product->count ?></p>

                            <img class="plus" data-product-id="<?= $product->product_id  ?>" src="/upload/icons/plus-circle.svg" alt="plus">
                        </div>

                        <div class="basket-position-price">
                            <p class="sumProduct" data-price-position="<?= $product->product_id ?>"><?= (int)$product->price_position ?>₽</p>
                            <p class="price" id="price-<?= $product->product_id ?>"><?= (int)$product->price ?>₽ за шт.</p>
                        </div>

                        <img class="btn-delete delete" src="/upload/icons/trash.svg" alt="trash" data-product-id="<?= $product->product_id ?>">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <hr class="hr-basket">
        <div class="itog">
            <h2 class="h2-basket">Сумма заказа</h2>
            <div class="itog-content">
                <p class="itog-content-price">Сумма:</p>
                <p class="totalPrice"><?= (int)$totalPrice ?? "" ?>₽</p>
                <p class="itog-content-count">Количество:</p>
                <p class="totalCount"><?= (int)$totalCount ?? "" ?></p>
            </div>
            <form class="btn-checkout" action="/app/tables/basket/order.php" method="POST">
                <button class="checkout btn-basket-user">
                    <p>Перейти к оформлению</p>
                </button>
            </form>
        </div>
    </section>

    <section class="basket-empty">
        <p class="message"><?= $_SESSION['basket'] ?? '' ?></p>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProductsInBasket.js"></script>
<?php
unset($_SESSION['basket']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>