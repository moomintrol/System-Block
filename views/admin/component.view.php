<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="component-admin">
        <form class="form-addComponent" action="/app/admin/tables/component.check.php" enctype="multipart/form-data" method="POST">
            <div class="form-header-admin">
                <p>Добавить новую характеристику</p>
            </div>
            <input class="input-admin" type="text" name="meaning" placeholder="Имя">

            <select class="input-admin" name="characteristic_id">
                <?php foreach ($characteristics as $characteristic) : ?>
                    <option value="<?= $characteristic->id ?>"><?= $characteristic->name ?></option>
                <?php endforeach ?>
            </select>

            <select class="input-admin" name="accessory_id">
                <?php foreach ($accessories as $accessory) : ?>
                    <option value="<?= $accessory->id ?>"><?= $accessory->name ?></option>
                <?php endforeach ?>
            </select>

            <textarea class="textarea-admin" name="description" cols="30" rows="10"></textarea>

            <input class="input-admin" type="file" name="image">

            <p class="error"><?= $_SESSION['error'] ?? "" ?></p>

            <button name="addComponent" class="addComponent">
                <p>Добавить</p>
            </button>
        </form>

        <form class="form-btn-accessories" action="/app/admin/tables/component.php">
            <button class="btn-accessory" name="accessory" value="all">
                <p>Все</p>
            </button>
            <?php foreach ($accessories as $accessory) : ?>
                <button class="btn-accessory" name="accessory" value="<?= $accessory->id ?>">
                    <p><?= $accessory->name ?></p>
                </button>
            <?php endforeach ?>
        </form>

        <table class="components-tables">
            <?php foreach ($components as $component) : ?>
                <tr class="tr-component">
                    <td><?= $component->meaning ?></td>
                    <td><?= $component->accessory ?></td>
                    <td><?= $component->characteristic ?></td>
                    <td><?= $component->date_added ?></td>
                    <td><img class="btn-delete delete-component" src="/upload/icons/trash.svg" alt="trash" data-product-id="<?= $component->id ?>"></td>
                    <?php if($component->image || $component->description): ?>
                       <td>
                        <form action="/app/admin/tables/show.component.php" method="POST">
                            <input hidden type="text" name="id" value="<?= $component->id ?>">
                            <button class="btn-show-component" name="btn-show">Подробнее</button>
                        </form>
                    </td> 
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </table>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>