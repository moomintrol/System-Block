<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<form class="insert" action="/app/tables/users/insert.php" method="POST">
    <label for="name">Введите имя</label>
    <input type="text" name="name" id="" value="<?= $_SESSION['contact']['name'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['name'] ?? "" ?></p> <br>

    <label for="name">Введите фамилию</label>
    <input type="text" name="surname" id="" value="<?= $_SESSION['contact']['surname'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['surname'] ?? "" ?></p> <br>

    <label for="name">Введите отчество</label>
    <input type="text" name="patronymic" id="" value="<?= $_SESSION['contact']['patronymic'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['patronymic'] ?? "" ?></p> <br>

    <label for="">Введите логни</label>
    <input type="text" name="login" value="<?= $_SESSION['contact']['login'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['login'] ?? "" ?></p>

    <label for="">Введите почту</label>
    <input type="email" name="email" value="<?= $_SESSION['contact']['email'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['email'] ?? "" ?></p>
    <p class="error"><?= $_SESSION['error']['email'] ?? "" ?></p>

    <label for="password">Пароль</label>
    <p class="error"><?= $_SESSION['error']['data']['password'] ?? "" ?></p>
    <input type="password" name="password" id="password"> <br>

    <label for="password_confirmation">Подтверждение пароля</label>
    <input type="password" name="password_confirmation" id="password_confirmation">

    <p class="error"><?= $_SESSION['error']['data']['password_confirmation'] ?? "" ?></p>
    <p class="error"><?= $_SESSION['error']['password'] ?? "" ?></p>

    <p class="error"><?= $_SESSION['error']['reg'] ?? "" ?></p>

    <div class="agreem">
        <label for="agreement">Согласен на обработку персональных данных</label>
        <input type="checkbox" checked name="agreement" id="agreement">
    </div>

    <button name="btnReg" id="btnReg">Регистрация</button>

</form>

<script>
    document.querySelector('#agreement').addEventListener('change', (e) => {
        document.querySelector('#btnReg').disabled = !e.target.checked
    })
</script>

<?php
unset($_SESSION['error']);
unset($_SESSION['contact']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>