<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<form class="insert" action="/app/tables/users/auth_check.php" method="POST">
    <label for="">Логин</label>
    <input type="text" name="login"> <br>

    <label for="password">Пароль</label>
    <input type="password" name="password" id="password"> <br>

    <?php if (!empty($_SESSION['error'])) : ?>
        <p class="error"><?= $_SESSION['error'] ?></p>
    <?php endif ?>
    <button name="btnAuth" id="btnAuth">Войти</button>
</form>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>