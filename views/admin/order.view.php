<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="order-admin">
        <form class="form-check" action="/app/admin/tables/order.php">
            <button class="btn-form-check" name="status" value="all">Все</button>

            <?php foreach ($statuses as $status) : ?>
                <button class="btn-form-check" name="status" value="<?= $status->id ?>"><?= $status->name ?></button>
            <?php endforeach ?>
        </form>
        <p class="error error-reason_cancel"><?= $_SESSION['error'] ?? "" ?></p>

        <table class="orders-table">
            <tr>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Причина отмены</th>
                <th>Дата</th>
                <th>Оплата</th>
                <th>Сумма</th>
                <th>Количество</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr class="tr-order">
                    <td><?= $order->user ?></td>
                    <td id="status" data-order-status="<?= $order->id ?>"><?= $order->status ?></td>
                    <td><?= $order->reason_cancel ?></td>
                    <td><?= $order->date_order ?></td>
                    <td><?= $order->payment_method ?></td>
                    <td><?= Order::totalPrice($order->id) ?></td>
                    <td><?= Order::totalCount($order->id) ?></td>
                    <td>
                        <form action="/app/admin/tables/show.order.products.php">
                            <input hidden type="text" name="id" value="<?= $order->id ?>">
                            <button name="btn" class="btn-show-order">Посмотреть</button>
                        </form>
                    </td>
                    <td>
                        <form class="updateStatus" action="/app/admin/tables/update.status.php" method="POST">
                            <input hidden type="text" name="id" value="<?= $order->id ?>">
                            <button class="btn-update-order" id="btnUpdateStatus" name="btnUpdateStatus" data-order-update="<?= $order->id ?>">Изменить статус</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach ?>
        </table>
    </section>
</main>


<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>
<script src="/assets/js/updateStatus.js"></script>
<!-- <script src="/assets/js/loadOrderAdmin.js"></script> -->
<?php
unset($_SESSION['error']);
unset($_SESSION['status']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>