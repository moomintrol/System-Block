<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <section class="start">
        <div class="start-text">
            <h1 class="h1-text">Один из лучших интернет-магазин <br> по продажи системных блоков</h1>
        </div>
        <img class="start-image" src="/upload/icons/home.png" alt="home" />
    </section>

    <section class="categories" id="category">
        <h2 class="h2 h2-categories">Подобрать компьютер</h2>
        <div class="categories-kinds">
            <?php foreach ($categories as $category) : ?>
                <input type="hidden" name="category-id" value="<?= $category->id ?>">
                <button name="btn-category" class="kind" data-category-id="<?= $category->id ?>">
                    <img class="img-kind" src="/upload/icons/<?= $category->image ?>" alt="<?= $category->image ?>" />
                    <h3 class="categories-h3"><?= $category->name ?></h3>
                </button>
            <?php endforeach ?>
        </div>
    </section>

    <section class="catalog" id="catalog">
        <div class="my-filter">
            <button class="btn-clear-filter btn-my-filter">
                <p class="my-filter-text">Очистить фильтры</p>
            </button>
        </div>
        <div class="all-products">
            <div class="filter-burger">
                <img class="img-filter" src="/upload/icons/filter.svg" alt="filter.svg">
                <p>Фильтр</p>
            </div>
            <form action="" class="filter" method="POST">
                <div class="filter-close">&times;</div>
                <input class="category-id" type="hidden" name="category-id" value="">
                <p><b>Цена:</b></p>
                <div class="filter-price">
                    <input name="from-cost" class="from-cost" type="text" placeholder="от" value="0" />
                    <input name="before-cost" class="before-cost" type="text" placeholder="до" value="1000000" />
                </div>
                <p class="p-cpu"><b>Процессор:</b></p>
                <select name="cpu" class="cpu">
                    <option value="">Все</option>
                    <?php foreach ($processors as $processor) : ?>
                        <option value="<?= $processor->id ?>"><?= $processor->meaning ?></option>
                    <?php endforeach ?>
                </select>
                <p><b>Видеокарта:</b></p>
                <select name="video-card" class="video-card">
                    <option value="">Все</option>
                    <?php foreach ($videoCards as $videoCard) : ?>
                        <option value="<?= $videoCard->id ?>"><?= $videoCard->meaning ?></option>
                    <?php endforeach ?>
                </select>
                <button name="btn-search-product" class="btn-search-product">Поиск</button>
            </form>
            <div class="products" id="products"></div>
            <div class="pages"></div>
        </div>
    </section>

    <section class="rating" id="rating">
        <p>95%</p>
        <div class="yandex">
            <p>yandex.ru</p>
            <p>Офицальный партнёр Яндекс.Маркет</p>
        </div>
        <div class="percentage-of-users">
            <div class="stars">
                <img class="star" src="/upload/icons/star.svg" alt="star" />
                <img class="star" src="/upload/icons/star.svg" alt="star" />
                <img class="star" src="/upload/icons/star.svg" alt="star" />
                <img class="star" src="/upload/icons/star.svg" alt="star" />
                <img class="star" src="/upload/icons/star.svg" alt="star" />
            </div>
            <p>
                90% пользователей <br />
                выбрали нас
            </p>
        </div>
        <div class="estimates">
            <p>1798</p>
            <p>Именно столько положительных оценок за все время работы</p>
        </div>
        <div class="overall-rating">
            <p>4.6</p>
            <p>Общий рейтинг магазина</p>
        </div>
    </section>

    <section class="company" id="company">
        <h2 class="h2 h2-company">О компании</h2>
        <div class="div-company">
            <p>
                Компания «LPC» занимается изучением комплектующих и созданием сборок
                системных блоков. Наш интернет-ресурс предоставляет клиентам готовые
                системные блоки под их нужды. Деятельность нашей компании
                ориентирована на жителей Российской Федерации. Мы офицальный партнер
                таких известных технологических гигантов как NVIDIA, Intel,
                Microsoft.
            </p>
            <img class="img-company" src="/upload/icons/testing-preview_webp.jpg" alt="testing-preview-webp" />
        </div>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/fetchUser.js"></script>
<script src="/assets/js/loadProducts.check.js"></script>
<script src="/assets/js/load.stars.js"></script>
<script src="/assets/js/filter-burger.js"></script>
<script>
    window.temp = "<?= $_SESSION['auth'] ?? false ?>";
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>