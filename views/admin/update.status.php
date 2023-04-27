<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="update-status">
        <form class="form-update-status" action="/app/admin/tables/update.status.check.php" method="POST">
            <div class="form-header-admin">
                <p>Изменение статуса</p>
            </div>
            <div class="form-update-status-content">
                <div>
                    <label for="">Текущий статус:</label>
                    <input name="old-status" disabled type="text" value="<?= $order->status ?>">
                </div>
                <input type="hidden" name="id" value="<?= $order->id ?>">
                <?php if ($order->status == "Обрабатывается") : ?>
                    <input type="hidden" name="status-id" value="2">
                    <button class="btn-update-status" name="assembly">
                        <p>Сборка системного блока</p>
                    </button>
                    <input type="hidden" name="canceled-id" value="5">
                    <button class="btn-update-status" name="canceled">
                        <p>Отменен</p>
                    </button>
                    <textarea name="reason_cancel" id="" cols="30" rows="10"></textarea>
                    <p class="error"><?= $_SESSION['error'] ?? "" ?></p>
                <?php elseif ($order->status == "Сборка системного блока") : ?>
                    <input type="hidden" name="status-id" value="3">
                    <button class="btn-update-status" name="on-the-way">
                        <p>В пути</p>
                    </button>
                <?php elseif ($order->status == "В пути") : ?>
                    <input type="hidden" name="status-id" value="4">
                    <button class="btn-update-status" name="delivered">
                        <p>Доставлен</p>
                    </button>
                <?php endif ?>
            </div>

        </form>
    </section>
</main>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>