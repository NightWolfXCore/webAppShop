<?php global $app; ?>
<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <a href="/" class="footer-logo">
        <img src="/assets/img/logo/logo.svg" alt="Sweet World">
      </a>
      <div class="f-text">Собственное производство. Доставка и самовывоз.</div>
      <div class="f-text f-gap">
        Телефон: <a class="link" href="tel:<?php echo $app->shopInfo->shop_phone ?>">+<?php echo $app->shopInfo->shop_phone ?></a><br>
        Адрес: <span class="f-strong"><?php echo $app->shopInfo->shop_address;?></span>
      </div>
      <div class="f-text">
        ИНН: <span class="f-strong"><?php echo $app->shopInfo->shop_INN;?></span><br>
        ОГРН: <span class="f-strong"><?php echo $app->shopInfo->shop_OGRN;?></span>
      </div>
    </div>

    <div>
      <div class="f-title">Навигация</div>
      <div class="f-text">
        <a class="link" href="/catalog">Каталог</a><br>
        <a class="link" href="/about">Об организации</a><br>
        <a class="link" href="/partners">О партнёрах</a><br>
        <a class="link" href="/vacancies">Вакансии</a><br>
        <a class="link" href="/contacts">Контакты</a>
      </div>
    </div>

    <div>
      <div class="f-title">Помощь</div>
      <div class="f-text">
        <a class="link" href="/delivery">Доставка и оплата</a><br>
        <a class="link" href="/faq">FAQ</a><br>
        <a class="link" href="/privacy">Политика конфиденциальности</a><br>
        <a class="link" href="/agreement">Пользовательское соглашение</a>
      </div>
    </div>
  </div>

  <div class="wrap footer-bottom">
    <div class="f-text">© <?php echo date('Y'); ?> Кондитерская</div>
  </div>
</footer>