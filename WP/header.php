<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Пиломатериалы в СПб и Ленинградской области от производителя Онега</title>
  <meta name="description" content="Производство пиломатериалов в СПб и ЛО. Предлагаем купить пиломатериалы в СПб и ЛО для строительных, ремонтных и прочих работ. Продажа сухих пиломатериалов и изделий естественной влажности. Доставка пиломатериалов от производителя Онега по ЛО и СПб.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>

<?php
  $contacts = get_field('contacts', 2);
  $symbols = [' ', '(', ')', '-'];
?>

<body>
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="header__top-inner flex aic">
          <div class="logo">
            <a class="logo__link" href="">
              <img class="logo__image" src="<?php echo the_field('logo', 2) ?>" alt="">
            </a>
          </div>
          <div class="header__email">
            <a class="header__email-link" href="mailto:<?php echo $contacts['email'] ?>"><?php echo $contacts['email'] ?></a>
          </div>
          <div class="header__whours">Время работы: <br><?php echo $contacts['whours'] ?></div>
          <div class="menu">
            <?php wp_nav_menu( [
                'theme_location'  => 'top',
                'container'       => false,
                'menu_class'      => 'menu',
                'menu_id'         => 'menu',
                'echo'            => true,
                'items_wrap'      => '<ul class="menu-items flex">%3$s</ul>',
                'depth'           => 0,
              ] ); ?>
          </div>
          <div class="header__phones">
            <a class="header__phone" href="tel:<?php echo str_replace($symbols, '', $contacts['phones']['1']); ?>"><?php echo $contacts['phones']['1'] ?></a>
            <a class="header__phone" href="tel:<?php echo str_replace($symbols, '', $contacts['phones']['2']); ?>"><?php echo $contacts['phones']['2'] ?></a>
          </div>
          <a class="header__button btn" href="<?php echo $contacts['button']['link'] ?>"><?php echo $contacts['button']['text'] ?></a>
        </div>
      </div>
    </div>
    <div class="header__bottom">
      <div class="menu-toggle"><i class="icon-toggle"><span></span><span></span><span></span></i></div>
      <div class="menu">
        <div class="container">
          <?php wp_nav_menu( [
                'theme_location'  => 'top',
                'container'       => false,
                'menu_class'      => 'menu',
                'menu_id'         => 'menu',
                'echo'            => true,
                'items_wrap'      => '<ul class="menu-items flex">%3$s</ul>',
                'depth'           => 0,
              ] ); ?>
          <div class="mobile">
            <div class="tagline"><?php echo $contacts['tagline'] ?></div>
            <div class="header__whours"><b>График работы:</b> <?php echo $contacts['whours_mobile'] ?></div>
            <div class="header__email"><a class="header__email-link" href="mailto:<?php echo $contacts['email'] ?>"><?php echo $contacts['email'] ?></a></div>
          </div>
        </div>
      </div><a class="header__button btn mobile" href="<?php echo $contacts['button']['link'] ?>"><?php echo $contacts['button']['text'] ?></a>
    </div>
  </header>
