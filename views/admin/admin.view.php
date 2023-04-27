<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="auth-admin">
        <form class="insert-admin" action="/app/admin/tables/auth.check.admin.php" method="POST">
            <div class="form-header-admin">
                <h3>Вход</h3>
            </div>
            <input class="input-admin" type="text" name="email" placeholder="email">

            <input class="input-admin" type="password" name="password" id="password" placeholder="password">

            <?php if (!empty($_SESSION['error'])) : ?>
                <p class="error"><?= $_SESSION['error'] ?></p>
            <?php endif ?>
            <button name="btnAdmin" id="btnAdmin">Войти</button>
        </form>
    </section>
</main>


<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>