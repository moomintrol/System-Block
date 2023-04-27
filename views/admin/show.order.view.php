<?php

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="show-order">
        <div class="div-info-show-order">
            <div class="form-header-admin">
                <p>Информация о заказе</p>
            </div>
            <div class="div-info-show-order-content">
                <p>Итого: <?= $totalPrice * $totalCount ?? "" ?> ₽</p>
                <p>Id заказа: <?= $info->id ?></p>
                <p>Пользователь: <?= $info->user ?></p>
                <p>Улица: <?= $info->street ?></p>
                <p>Дом: <?= $info->home ?></p>
                <p>Квартира: <?= $info->apartment ?></p>
                <p>Дата доставки: <?= $info->date_delivery ?></p>
                <p>Время доставки: <?= $info->time_delivery ?></p>
            </div>
        </div>

        <table class="table-product-order">
            <tr>
                <th>Имя</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Оценка</th>
            </tr>

            <?php foreach ($productsInOrder as $product) : ?>
                <tr class="tr-order">
                    <td><?= $product->name ?></td>
                    <td><?= $product->count ?></td>
                    <td><?= $product->price ?></td>
                    <td><?= $product->rating ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </section>
</main>

<?php
unset($_SESSION['update']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>