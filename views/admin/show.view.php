<?php

use App\models\Component;

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php";
?>

<main>
    <section>
        <form class="product-update" action="/app/admin/tables/update.product.php" method="POST" enctype="multipart/form-data">
            <div class="product-update-content">
                <div class="form-header-admin">
                    <p>Редактирование продукта</p>
                </div>
                <input name="id" type="hidden" value="<?= $product->id ?>">

                <label for="name">Название</label>
                <input name="name" type="text" value="<?= $product->name ?>">

                <label for="price">Цена</label>
                <input name="price" type="text" value="<?= $product->price ?>">

                <label for="image">Фото</label>
                <input type="text" name="imageOld" value="<?= $product->image ?>">
                <input name="image" type="file">

                <p class="error"><?= $_SESSION['update']['image'] ?? "" ?></p>

                <div class="show-category">
                    <label for="category_id">Старая категория:</label>
                    <p><?= $product->category ?></p>
                    <input name="old_category" type="hidden" value="<?= $product->category_id ?>">
                </div>

                <select name="category_id" id="">
                    <option value="old">Новая категория</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach ?>
                </select>

                <p class="error"><?= $_SESSION['error']['update-product'] ?? "" ?></p>
            </div>

            <div class="product-update-content">
                <div class="form-header-admin">
                    <p>Редактирование в нём компоненты</p>
                </div>
                <?php foreach ($components as $component) : ?>
                    <p><?= $component->name ?>: <?= $component->meaning ?></p>
                    <input name="old-<?=$component->image ?>" type="hidden" value="<?= $component->component_id ?>">
                    <select name="<?= $component->image ?>">
                        <option value="old"><?= $component->name ?></option>
                        <?php foreach (Component::componentInSb($component->name) as $newComponent) : ?>
                            <option value="<?= $newComponent->id ?>"><?= $newComponent->meaning ?></option>
                        <?php endforeach ?>
                    </select>
                <?php endforeach ?>
            </div>

            <button name="btn-update" class="btn-update">Изменить</button>
        </form>
    </section>
</main>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>