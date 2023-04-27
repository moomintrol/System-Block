<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php";
?>

<main>
    <section class="order">
        <div class="order-content">
            <form class="delivery" action="/app/tables/basket/order.check.php" method="POST">
                <h3>Укажите адрес доставки</h3>
                <input class="input-delivery" type="text" name="street" placeholder="Улица">

                <p class="error"><?= $_SESSION['error']['street'] ?? "" ?></p>

                <input class="input-delivery" type="text" name="home" placeholder="Дом">

                <p class="error"><?= $_SESSION['error']['home'] ?? "" ?></p>

                <input class="input-delivery" type="text" name="apartment" placeholder="Номер квартиры">
                <h3>Выберите дату и время доставки</h3>
                <input class="input-delivery" type="text" id="from" name="date" autocomplete="off" placeholder="Дата">

                <p class="error"><?= $_SESSION['error']['date'] ?? "" ?></p>

                <input class="input-delivery" type="time" name="time">

                <p class="error"><?= $_SESSION['error']['time'] ?? "" ?></p>

                <h3>Выберите способ оплаты при получении</h3>
                <div class="payment">
                    <div>
                        <input class="input-payment" checked type="radio" name="radio" id="receiving" value="при получении">
                        <label class="label-payment" id="label-receiving" for="receiving">Наличными</label>
                    </div>
                    <div>
                        <input class="input-payment" type="radio" name="radio" id="card_payment" value="по карте">
                        <label class="label-payment" id="label-card_payment" for="card_payment">По карте</label>
                    </div>
                </div>
                <button class="btn-confirm-order" name="btn-confirm-order">
                    <p>Подтвердить заказ</p>
                </button>
            </form>
        </div>
        <hr class="hr-order">
        <div class="info-order">
            <h2 class="h2-order">Сумма заказа</h2>
            <div class="info-order-content">
                <p>Сумма:</p>
                <p class="totalPrice"><?= (int)$totalPrice ?? "" ?> ₽</p>
                <p>Количество:</p>
                <p class="totalCount"><?= (int)$totalCount ?? "" ?></p>
            </div>
        </div>
    </section>
</main>

<script src="/assets/js/date.js"></script>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>