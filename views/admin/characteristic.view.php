<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="characteristic-admin">
        <form class="form-addCharacteristic" action="/app/admin/tables/characteristic.check.php" method="POST">
            <div class="form-header-admin">
                <p>Добавить новую характеристику</p>
            </div>
            <input class="input-admin" type="text" name="name" placeholder="Имя">

            <p class="error"><?= $_SESSION['error'] ?? "" ?></p>

            <button name="btnAddCharacteristic" class="btnAddCharacteristic">
                <p>Добавить</p>
            </button>
        </form>
        <table class="characteristic-tables">
            <?php foreach ($characteristics as $characteristic) : ?>
                <tr class="tr-characteristic">
                    <td><?= $characteristic->name ?></td>
                    <td><img class="btn-delete delete-characteristic" src="/upload/icons/trash.svg" alt="trash" data-product-id="<?= $characteristic->id ?>"></td>
                </tr>
            <?php endforeach ?>
        </table>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>