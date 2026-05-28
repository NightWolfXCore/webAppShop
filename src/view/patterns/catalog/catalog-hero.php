<?php
global $app;
$category = $_GET['cat'] ?? null;
switch ($category) {
  case 1: {
    $textCat = "Каталог новой продукции";
    $img = "cakes/cake1.jpg";
  }; break;
  case 2: {
    $textCat = "Каталог популярной продукции";
    $img = "cakes/cake2.jpg";
  }; break;
  case 3: {
    $textCat = "Каталог акционной продукции";
    $img = "cakes/cake_2_0.jpg";
  }; break;
  case 4: {
    $textCat = "Каталог молочных новинок";
    $img = "cakes/cake_2_1.jpg";
  }; break;
  default: {
    $textCat = "Весь каталог продукции";
    $img = "cakes/cake0.jpg";
  }; break;
}
?>
<section class="section">
  <div class="wrap">
    <div class="catalog-hero">
      <img class="catalog-hero-image" src="/assets/img/<?= $img ?>" alt="Каталог десертов">
      <div class="catalog-hero-overlay"></div>
      <div class="catalog-hero-content">
        <div class="catalog-hero-kicker"> <?= $textCat ?> </div>
        <h1 class="catalog-hero-title"> Десерты собственного производства </h1>
        <div class="catalog-hero-text">
          Торты, пирожные, капкейки и наборы для любого события.
        </div>
      </div>
    </div>
  </div>
</section>