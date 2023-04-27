<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header-two.php"; ?>

<main>
    <section class="start-accessories">
        <div class="start-accessories-text">
            <h1 class="start-h1">GeForce RTX 4090</h1>
            <h2 class="start-h2">БОЛЬШЕ ЧЕМ СКОРОСТЬ</h2>
            <p class="start-p">NVIDIA® GeForce RTX® 4090 — лучшая видеокарта GeForce. Она обеспечивает огромный скачок в производительности, эффективности и графике на базе искусственного интеллекта. Испытайте сверхвысокопроизводительные игры, невероятно детализированные виртуальные миры, беспрецедентную производительность и новые творческие возможности. Эти видеокарты созданы на базе архитектуры NVIDIA Ada Lovelace, с 24 ГБ памяти G6X, и обеспечивают непревзойденные возможности для геймеров и авторов контента.</p>
            <form action="/app/tables/component.php">
                <button class="btn-start-accessories" name="btn-component-info" value="9">
                    <p>Подробнее</p>
                </button>
            </form>
        </div>
        <img class="start-accessories-image" src="/upload/icons/geforce-rtx-4090.png" alt="geforce-rtx-4090">
    </section>

    <section class="accessories">
        <div class="container">
            <div class="itc-slider" data-slider="itc-slider" data-loop="true" data-autoplay="false">
                <div class="itc-slider__wrapper">
                    <div class="itc-slider__items">
                        <?php foreach ($acessories as $component) : ?>
                            <form action="/app/tables/component.php" class="itc-slider__item">
                                <button class="btn-component-info" name="btn-component-info" value="<?= $component->id ?>">
                                    <p><?= $component->meaning ?></p>
                                    <img class="img-slider" src="/upload/acessories/<?= $component->image ?>" alt="<?= $component->image ?>">
                                </button>
                            </form>
                        <?php endforeach ?>
                    </div>
                </div>
                <button class="itc-slider__btn itc-slider__btn_prev"></button>
                <button class="itc-slider__btn itc-slider__btn_next"></button>
            </div>
        </div>
    </section>
</main>

<!-- <script src="/assets/js/component.js"></script> -->

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>