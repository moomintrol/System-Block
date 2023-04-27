<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php" ?>

<main>
    <section class="show-component">
        <img class="show-component-img" src="/upload/acessories/<?= $productsInOrder->image ?>" alt="<?= $productsInOrder->image ?>">
        <p><?= $productsInOrder->description ?></p>
    </section>
</main>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>