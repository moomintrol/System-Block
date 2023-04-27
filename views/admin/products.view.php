<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php";
?>

<main>
    <section class="product-admin">
        <form class="form-products" action="/app/admin/tables/product.check.php" method="POST" enctype="multipart/form-data">
            <div class="form-products-content">
                <div class="form-header-admin">
                    <p>Добавить новый продукт</p>
                </div>
                <input class="input-admin" type="text" name="name" placeholder="Имя" value="<?= $_SESSION['product']['name'] ?? "" ?>">

                <input class="input-admin" type="text" name="price" placeholder="Цена" value="<?= $_SESSION['product']['price'] ?? "" ?>">

                <input class="input-admin" type="file" name="image">

                <select class="input-admin" name="category_id" id="">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-products-content">
                <div class="form-header-admin">
                    <p>Добавить к нему компоненты</p>
                </div>
                <?php foreach ($accessories as $accessory) : ?>
                    <select class="input-admin" name="<?= $accessory->image ?>" id="">
                        <option value=""><?= $accessory->name ?></option>
                        <?php foreach (Component::componentByAccessory($accessory->id) as $component) : ?>
                            <option value="<?= $component->id ?>"><?= $component->meaning ?></option>
                        <?php endforeach ?>
                    </select>
                <?php endforeach ?>
            </div>

            <p class="error"><?= $_SESSION['error'] ?? "" ?></p>

            <button name="btnAddProduct" id="btnAddProduct">Добавить</button>
        </form>

        <div class="buttons-admin-category">
            <input type="hidden" name="category-id" value="all">
            <button name="btn-category" class="btn-admin-category" data-category-id="all">
                <p class="categories-p">Все</p>
            </button>
            <?php foreach ($categories as $category) : ?>
                <input type="hidden" name="category-id" value="<?= $category->id ?>">
                <button name="btn-category" class="btn-admin-category" data-category-id="<?= $category->id ?>">
                    <p class="categories-p"><?= $category->name ?></p>
                </button>
            <?php endforeach ?>
        </div>

        <table class="products-table">
            <tr>
                <th></th>
                <th>Название</th>
                <th>Цена</th>
                <th>Картинка</th>
                <th>Общая оценка</th>
                <th>Количество отзывов</th>
                <th></th>
                <th></th>
            </tr>
            <tbody class="products-table-tbody"></tbody>
        </table>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProductsInAdmin.js"></script>
<script src="/assets/js/loadAdmin.js"></script>

<?php
unset($_SESSION['error']);
unset($_SESSION['product']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>