<?php
  $privacy = get_field('privacy', 2);
  $contacts = get_field('contacts', 2);
  $symbols = [' ', '(', ')', '-'];
?>

<footer class="footer">
  <div class="footer__top" id="footer_top">
    <div class="container">
      <div class="footer__top-inner flex jcsb">
        <div class="map"><?php echo the_field('map', 2) ?></div>
        <form class="form">
          <input type="hidden" name="act" value="callback">
          <p class="form__header">Заказать обратный звонок</p>
          <div class="form__inner">
            <label class="form__name form__label">
              <p class="form__name-text">Имя</p>
              <input class="form__name-input form__input" type="text" name="name">
            </label>
            <label class="form__phone form__label">
              <p class="form__phone-text">Телефон *</p>
              <input class="form__phone-input form__input" type="text" name="phone" required>
            </label>
            <label class="form__comment form__label">
              <p class="form__comment-text">Комментарий к заявке</p>
              <textarea class="form__comment-textarea form__textarea" type="text" name="comment"></textarea>
            </label>
          </div>
          <label class="form__privacy form__label">
            <input type="checkbox" required>Разрешаю обработку <a href="<?php echo $privacy['link'] ?>">персональных данных</a>
          </label>
          <button class="form__button btn btn_call" type="submit"><span>заказать звонок</span></button>
        </form>
      </div>
      <div class="top" id="top">
        <svg class="top__image">
          <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#top"></use>
        </svg>
        <div class="top__text mobile">Наверх</div>
      </div>
    </div>
  </div>
  <div class="footer__middle">
    <div class="container">
      <div class="footer__middle-inner flex">
        <div class="footer__middle-left"><a class="footer__link" href="<?php echo $privacy['link'] ?>"><?php echo $privacy['text'] ?><br></a></div>
        <div class="footer__middle-right">
          <div class="footer__address"><?php echo $contacts['address'] ?></div>
          <div class="footer__whours"><?php echo $contacts['whours'] ?></div>
          <div class="footer__phones">
            <a class="footer__phone" href="tel:<?php echo str_replace($symbols, '', $contacts['phones']['1']); ?>"><?php echo $contacts['phones']['1'] ?><br></a>
            <a class="footer__phone" href="tel:<?php echo str_replace($symbols, '', $contacts['phones']['2']); ?>"><?php echo $contacts['phones']['2'] ?><br></a>
          </div>
          <div class="footer__email">
            <a class="footer__email-link" href="mailto:<?php echo $contacts['email'] ?>"><?php echo $contacts['email'] ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container">
      <div class="footer__bottom-inner flex aic jcsb">
        <p>© 2021 ООО «ОНЕГА»</p>
        <p>Разработано: <a href="https://1ps.ru/">1PS.RU</a></p>
      </div>
    </div>
  </div>
</footer>
<div class="modal mfp-hide" id="callback">
  <form class="form">
    <input type="hidden" name="act" value="callback">
    <p class="form__header">Заказать обратный звонок</p>
    <div class="form__inner">
      <label class="form__name form__label">
        <p class="form__name-text">Имя</p>
        <input class="form__name-input form__input" type="text" name="name">
      </label>
      <label class="form__phone form__label">
        <p class="form__phone-text">Телефон *</p>
        <input class="form__phone-input form__input" type="text" name="phone" required>
      </label>
      <label class="form__comment form__label">
        <p class="form__comment-text">Комментарий к заявке</p>
        <textarea class="form__comment-textarea form__textarea" type="text" name="comment"></textarea>
      </label>
    </div>
    <label class="form__privacy form__label">
      <input type="checkbox" required>Разрешаю обработку <a href="<?php echo $privacy['link'] ?>">персональных данных</a>
    </label>
    <button class="form__button btn btn_call" type="submit">заказать звонок</button>
  </form>
</div>
<div class="modal privacy mfp-hide" id="privacy"><?php echo $privacy['text_full'] ?></div>
<?php wp_footer(); ?>
</body>

</html>
