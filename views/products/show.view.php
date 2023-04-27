<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <section class="find-product">
        <a class="back" href="/#catalog"><img class="arrow-back" src="/upload/icons/arrow.svg" alt="arrow">
            <p>Назад</p>
        </a>
        <div class="find-product-start-info">
            <img src="/upload/System-Block/<?= $product->image ?>" class="card-img-top find-product-image" alt="<?= $product->image ?>">
            <div class="start-info">
                <h3 class="find-title"><?= $product->name ?></h3>
                <div class="div-overall-rating">
                    <?php for ($i = 0; $i < floor($overallRating); $i++) : ?>
                        <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">
                    <?php endfor ?>
                    <?php for ($i = floor($overallRating); $i < round($overallRating); $i++) : ?>
                        <?php if ($overallRating - floor($overallRating) > 0.8) : ?>
                            <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">
                        <?php else : ?>
                            <img class="review-overall-star" src="/upload/icons/star-half.svg" alt="star">
                        <?php endif ?>
                    <?php endfor ?>
                    <?php for ($i = 5; $i > round($overallRating); $i--) : ?>
                        <img class="review-overall-star" src="/upload/icons/star-empty.svg" alt="star">
                    <?php endfor ?>
                </div>
                <p class="find-text">Цена <?= (int)$product->price ?>₽</p>
                <?php if (!isset($_SESSION['auth'])) : ?>
                    <button class="btn-find-no-in">В корзину</button>
                <?php else : ?>
                    <button class="btn-find" id="btn-<?= $product->id ?>" data-btn-id="<?= $product->id ?>">В корзину</button>
                <?php endif ?>
            </div>
        </div>
        <div class="show-product">
            <h3>Комплектующие</h3>
            <hr class="hr-main">
            <?php foreach ($allComponents as $component) : ?>
                <div class="component">
                    <img class="product-component-img" src="/upload/components/<?= $component->image ?>" alt="<?= $component->image ?>">
                    <p><?= $component->name ?></p>
                    <p class="component-name"><?= $component->meaning . " " . $component->characteristic ?></p>
                </div>
                <hr class="show-product-hr">
            <?php endforeach ?>
            <h3>Отзывы</h3>
            <hr class="hr-main">
            <div class="feedback-statistics">
                <div class="rating-info">
                    <p>Общий рейтинг</p>
                    <p class="p-overall-rating"><b><?= bcdiv($overallRating, 1, 1) ?? 0 ?></b></p>
                    <div class="div-rating-info">
                        <div class="div-overall-rating">
                            <?php for ($i = 0; $i < floor($overallRating); $i++) : ?>
                                <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">
                            <?php endfor ?>
                            <?php for ($i = floor($overallRating); $i < round($overallRating); $i++) : ?>
                                <?php if ($overallRating - floor($overallRating) > 0.8) : ?>
                                    <img class="review-overall-star" src="/upload/icons/star.svg" alt="star">
                                <?php else : ?>
                                    <img class="review-overall-star" src="/upload/icons/star-half.svg" alt="star">
                                <?php endif ?>
                            <?php endfor ?>
                            <?php for ($i = 5; $i > round($overallRating); $i--) : ?>
                                <img class="review-overall-star" src="/upload/icons/star-empty.svg" alt="star">
                            <?php endfor ?>
                        </div>
                        <p>(<?= $countRating ?? 0 ?>)</p>
                    </div>
                </div>

                <div class="rating-percent">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <p><?= $i + 1 ?></p>
                        <div class="div-percent">
                            <div class="line-div-percent"></div>
                        </div>
                        <p class="p-percent"><?= bcdiv($percentages[$i], 1, 2) ?>%</p>
                    <?php endfor ?>
                </div>
                <?php if (!isset($_SESSION['auth'])) : ?>
                    <button class="btn-review-no-in btn-rewiew-show">
                        <p>Оставить отзыв</p>
                    </button>
                <?php else : ?>
                    <button class="btn-review-in btn-rewiew-show">
                        <p>Оставить отзыв</p>
                    </button>
                <?php endif ?>
            </div>
            <div>

            </div>
        </div>

        <?php foreach ($allReviews as $review) : ?>
            <div class="review-user">
                <div class="review-header">
                    <img src="/upload/icons/user-black.svg" alt="user">
                    <div>
                        <div class="div-stars-user">
                            <p><?= $review->name ?></p>
                            <?php for ($i = 0; $i < $review->rating; $i++) : ?>
                                <img class="review-user-star" src="/upload/icons/star.svg" alt="star">
                            <?php endfor ?>
                            <?php for ($i = 5; $i > $review->rating; $i--) : ?>
                                <img class="review-user-star" src="/upload/icons/star-empty.svg" alt="star">
                            <?php endfor ?>
                        </div>
                    </div>
                </div>
                <p><?= $review->date_delivery ?></p>
                <p><b>Коментарий:</b></p>
                <p><?= $review->review ?></p>
            </div>
        <?php endforeach ?>
        </div>
    </section>

    <div class="modal-wrapper-review" id="modal-wrapper-review">
        <div class="modal-review">
            <div class="modal__div">
                <div class="modal__close__review modal__close">&times;</div>
                <div class="modal__content">
                    <form class="form-review" action="" method="POST">
                        <div class="madal-review-header">
                            <p class="madal-review-header-p">Ваш отзыв</p>
                        </div>

                        <div class="review-stars">
                            <input hidden class="radio-star" type="radio" name="radio" value="1" id="radio-1">
                            <label class="review-label" for="radio-1"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="2" id="radio-2">
                            <label class="review-label" for="radio-2"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="3" id="radio-3">
                            <label class="review-label" for="radio-3"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="4" id="radio-4">
                            <label class="review-label" for="radio-4"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>

                            <input hidden class="radio-star" type="radio" name="radio" value="5" id="radio-5">
                            <label class="review-label" for="radio-5"><img class="review-star" src="/upload/icons/star-empty.svg" alt="star"></label>
                        </div>
                        <textarea name="review" id="" cols="30" rows="10"></textarea>
                        <p class="error"></p>
                        <button class="btn-form-review" name="btn-form-review">
                            <p>Отправить</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/addInBasket.js"></script>
<script src="/assets/js/modal-review.js"></script>
<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
?>