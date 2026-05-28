<?php
global $app;
$cat = $_GET['cat'] ?? null;
$categories = $app->tablesRepository->getAllDataByNameTable("category_product");
?>
<section class="section">
  <div class="wrap">

    <div class="section-top">
      <h2 class="section-title">Категории</h2>
      <div class="section-sub">Быстрый переход</div>
    </div>

    <div class="cat-grid">
      <?php foreach ($categories as $variable): ?>
        <?php if ($variable['category_ID'] === $cat) continue; ?>
        <a class="cat-card" href="/catalog?cat=<?= $variable['category_ID'] ?>">

          <img
            class="cat-image"
            src="/assets/img/<?= $variable['category_Photo'] ?>"
            alt="<?= $variable['category_Name'] ?>"
            loading="lazy"
            decoding="async">

          <div class="cat-overlay">
            <div class="cat-title"><?= $variable['category_Name'] ?></div>
          </div>

        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>