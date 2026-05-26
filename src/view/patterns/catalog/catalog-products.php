<?php
global $app;
$products = $app->productRepository->getDataProducts();
?>
<section class="section">
    <div class="wrap">
        <div class="section-top">
            <h2 class="section-title">Товары</h2>
            <div class="section-sub">Свежая продукция</div>
        </div>
        <div class="product-grid">
            <?php foreach ($products as $variable): ?>
                <article class="product-card">
                    <div class="product-media">
                        <img class="product-image" src="/assets/img/<?= $variable['product_DemoPhoto'] ?>" alt="<?= $variable['product_Name'] ?>" loading="lazy" decoding="async">
                        <?php if (!empty($variable['product_Status'])): ?>
                            <div class="product-tag"> <?= $app->tablesRepository->getOneDataByID("status_product", (int)$variable['product_Status'], "status_ID", "status_Type")->status_Type; ?> </div>
                        <?php endif; ?>
                    </div>
                    <div class="product-body">
                        <div class="product-top">
                            <div class="product-title"> <?= $variable['product_Name'] ?> </div>
                            <div class="product-info-wrap">
                                <button class="product-info-btn" type="button" aria-label="Информация о товаре"> i </button>
                                <div class="product-popup">
                                    <div class="product-popup-line">
                                        <span class="product-popup-label"> Описание: </span>
                                        <?= $variable['product_Description'] ?>
                                    </div>
                                    <div class="product-popup-line">
                                        <span class="product-popup-label"> Состав: </span>
                                        <?= $variable['product_Compound'] ?>
                                    </div>
                                    <div class="product-popup-line">
                                        <span class="product-popup-label"> Вес: </span>
                                        <?= $variable['product_Weight'] ?> кг.
                                    </div>
                                    <div class="product-popup-line">
                                        <span class="product-popup-label"> КБЖУ (в 100 гр.): </span>
                                        <?= $variable['product_Calories'] ?> / <?= $variable['product_Protein'] ?> / <?= $variable['product_Fat'] ?> / <?= $variable['product_Carbohydrates'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-meta">
                            <div class="product-manufacturer">
                                <?= $app->tablesRepository->getOneDataByID("manufacturer", (int)$variable['product_Manufacturer'], "manufacturer_ID", "manufacturer_Name")->manufacturer_Name; ?>
                            </div>

                            <div class="product-price">
                                <?= number_format($variable['product_Cost'], 0, '.', ' ') ?> ₽
                            </div>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary w-100">
                                В корзину
                            </button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>