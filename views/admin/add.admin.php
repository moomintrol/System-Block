<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="add-admin">
        <form class="form-add-admin" action="/app/admin/tables/add.admin.checked.php" method="POST">
            <div class="form-header-admin">
                <p>Добавление администратора</p>
            </div>
            <input type="text" placeholder="Фамилия" name="surname" value="<?= $_SESSION['new-admin']['surname'] ?? "" ?>">
            <input type="text" placeholder="Имя" name="name" value="<?= $_SESSION['new-admin']['name'] ?? "" ?>">
            <input type="email" placeholder="Email" name="email" value="<?= $_SESSION['new-admin']['email'] ?? "" ?>">
            <input type="phone" placeholder="Телефон" name="phone" value="<?= $_SESSION['new-admin']['phone'] ?? "" ?>">
            <input type="password" placeholder="Пароль" name="password">
            <p class="error"><?= $_SESSION['error'] ?? "" ?></p>
            <button name="btn-add-admin" class="btn-add-admin">
                <p>Добавить</p>
            </button>
        </form>
        <table class="tables-add-admin">
            <tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
            </tr>
            <?php foreach ($admins as $admin) : ?>
                <tr class="tr-admin">
                    <td><?= $admin->surname ?></td>
                    <td><?= $admin->name ?></td>
                    <td><?= $admin->email ?></td>
                    <td><?= $admin->phone ?></td>
                    <td><img class="btn-delete delete-admin" src="/upload/icons/trash.svg" alt="trash" data-product-id="<?= $admin->id ?>"></td>
                </tr>
            <?php endforeach ?>
        </table>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>

<?php
unset($_SESSION['error']);
unset($_SESSION['new-admin']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>