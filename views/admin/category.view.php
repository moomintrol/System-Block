<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="category-admin">
        <form class="form-category" action="/app/admin/tables/category.check.php" enctype="multipart/form-data" method="POST">
            <div class="form-header-admin">
                <p>Добавить новую категорию</p>
            </div>
            <input class="input-admin" name="name" type="text" placeholder="Имя">
            <input class="input-admin" type="file" name="image">

            <p class="error"><?= $_SESSION['error'] ?? "" ?></p>
            <button name="btnAddCategory" id="btnAddCategory">Добавить</button>
        </form>

        <table class="category-table-admin">
            <?php foreach ($categories as $category) : ?>
                <tr class="category">
                    <td><?= $category->name ?></td>
                    <td><img class="delete-category" src="/upload/icons/trash.svg" alt="trash.svg" data-product-id="<?= $category->id ?>"></td>
                    <td><button name="btn-category" class="btn-admin-category btn-category" data-category-id="<?= $category->id ?>">Подробнее</button></td>
                </tr>
            <?php endforeach ?>
        </table>

        <table class="products-table"></table>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadCategoryAdmin.js"></script>
<script src="/assets/js/loadAdmin.js"></script>
<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>