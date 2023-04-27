<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <section class="component-section">
        <img class="component-img" src="/upload/acessories/<?= $component->image ?>" alt="<?= $component->image ?>">
        <p><?= $component->	description ?></p>
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>