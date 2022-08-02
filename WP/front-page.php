<?php
  get_header();
  $intro = get_field('intro');
  $catalog = get_field('catalog');
  $price = get_field('price');
  $cta = get_field('cta');
  $scheme = get_field('scheme');
  $about = get_field('about');
  $reviews = get_field('reviews');
  $fields_intro = CFS()->get('intro');
  $fields_catalog = CFS()->get('catalog');
  $fields_scheme = CFS()->get('scheme');
  $fields_about_images = CFS()->get('about_images');
  $fields_about_items = CFS()->get('about_items');
  $fields_reviews = CFS()->get('reviews');
?>
<main class="content">
  <div class="intro" id="intro">
    <div class="container">
      <h1 class="intro__header"><?php echo $intro['header'] ?></h1>
      <p class="intro__subheader"><?php echo $intro['subheader'] ?></p>
      <div class="intro-items flex">
        <?php foreach($fields_intro as $field): ?>
          <div class="intro__item">
            <div class="intro__item-image-part">
              <svg class="intro__item-image">
                <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#<?php echo $field['icon'] ?>"></use>
              </svg>
            </div>
            <div class="intro__item-text-part">
              <p class="intro__item-header"><?php echo $field['header'] ?></p>
              <p class="intro__item-text"><?php echo $field['text'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="intro__bottom flex aic">
        <a class="intro__button btn btn_call" href="<?php echo $intro['button']['href'] ?>">
          <span><?php echo $intro['button']['text'] ?></span>
        </a>
        <p class="intro__bottom-text"><?php echo $intro['text'] ?></p>
      </div>
    </div>
  </div>
  <div class="catalog" id="catalog">
    <div class="container">
      <h2 class="catalog__header"><?php echo $catalog['header'] ?></h2>
      <p class="catalog__subheader subheader"><?php echo $catalog['subheader'] ?></p>
      <div class="catalog-items flex">
        <?php foreach($fields_catalog as $field): ?>
          <a class="catalog__item" href="<?php echo $field['link'] ?>">
            <span class="catalog__item-image-part">
              <img class="catalog__item-image" src="<?php echo $field['image'] ?>" alt="">
            </span>
            <span class="catalog__item-text"><?php echo $field['name'] ?></span>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="services">
        <div class="services-items flex">
          <div class="services__item">
            <div class="services__item-image-part">
              <svg class="services__item-image">
                <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#<?php echo $catalog['1']['icon'] ?>"></use>
              </svg>
            </div>
            <div class="services__item-text-part">
              <p class="services__item-header"><?php echo $catalog['1']['header'] ?></p>
              <p class="services__item-text"><?php echo $catalog['1']['text'] ?></p>
            </div>
          </div>
          <div class="services__item">
            <div class="services__item-image-part">
              <svg class="services__item-image">
                <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#<?php echo $catalog['2']['icon'] ?>"></use>
              </svg>
            </div>
            <div class="services__item-text-part">
              <p class="services__item-header"><?php echo $catalog['2']['header'] ?></p>
              <p class="services__item-text"><?php echo $catalog['2']['text'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="price" id="price">
    <div class="container">
      <h2 class="price__header"><?php echo $price['header'] ?></h2>
      <p class="price__subheader subheader"><?php echo $price['subheader'] ?></p>
      <div class="price-table-wrap">
        <table class="price-table" id="price-table">
          <tr>
            <td>Наименование</td>
            <td>Типоразмер</td>
            <td colspan="3">Цена, руб.</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>1 сорт</td>
            <td>2 сорт</td>
            <td></td>
          </tr>
          <?php
            $categories = get_categories( [
              'taxonomy'     => 'category',
              'type'         => 'post',
              'child_of'     => 0,
              'orderby'      => 'slug',
              'order'        => 'ASC',
              'hide_empty'   => 1,
              'hierarchical' => 1,
              'number'       => 0,
              'pad_counts'   => false,
            ] );
            foreach($categories as $category):
            $my_posts = get_posts( array(
              'numberposts' => -1,
              'category'    => $category->term_id,
              'orderby'     => 'date',
              'order'       => 'ASC',
              'post_type'   => 'post',
              'suppress_filters' => true,
            )); 
            foreach($my_posts as $index => $post):
            if($index == 0):
          ?>
          <tr>
            <td rowspan="<?php echo $category->count; ?>"><?php echo $category->name; ?></td>
            <td><?php echo $post->post_title; ?></td>
            <td><?php echo get_field('1'); ?></td>
            <td><?php echo get_field('2'); ?></td>
            <td><?php echo get_field('3'); ?></td>
          </tr>
          <?php else: ?>
          <tr>
            <td><?php echo $post->post_title; ?></td>
            <td><?php echo get_field('1'); ?></td>
            <td><?php echo get_field('2'); ?></td>
            <td><?php echo get_field('3'); ?></td>
          </tr>
          <?php
            endif; 
            endforeach;
            endforeach;
          ?>
        </table>
        <div class="price-items" id="price-table2">
        <?php
          foreach($categories as $category): 
          foreach($my_posts as $post):
        ?>
          <div class="price__item">
            <p><strong>Наименование:</strong> <?php echo $category->name;?></p>
            <p><strong>Типоразмер, мм:</strong> <?php echo $post->post_title; ?></p>
            <p><strong>Цена, ₽</strong></p>
            <?php if(get_field('1')): ?>
              <p><strong>1 сорт:</strong> <?php echo get_field('1'); ?></p>
            <?php endif; ?>
            <?php if(get_field('2')): ?>
              <p><strong>2 сорт:</strong> <?php echo get_field('2'); ?></p>
            <?php endif; ?>
            <?php if(get_field('3')): ?>
              <p><strong>б/с:</strong> <?php echo get_field('3'); ?></p>
            <?php endif; ?>
          </div>
        <?php
          endforeach;
          endforeach;
        ?>
        </div>
      </div>
      <a class="price__button btn btn_stroke desktop" href="#"><?php echo $price['button'] ?></a>
      <a class="price__button2 btn btn_stroke mobile" href="#"><?php echo $price['button'] ?></a>
    </div>
  </div>
  <div class="cta" id="cta">
    <div class="container">
      <div class="cta__inner flex">
        <div class="cta__text-part">
          <p class="cta__header"><?php echo $cta['header'] ?></p>
          <p class="cta__text"><?php echo $cta['text'] ?></p>
        </div>
        <div class="cta__button-part">
          <a class="cta__button btn btn_cta" href="<?php echo $cta['button']['link'] ?>">
            <span><?php echo $cta['button']['text'] ?></span>
          </a>
          <p class="cta__bottom-text"><?php echo $cta['text_under_button'] ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="scheme" id="scheme">
    <div class="container">
      <h2 class="scheme__header"><?php echo $scheme['header'] ?></h2>
      <p class="scheme__subheader subheader"><?php echo $scheme['subheader'] ?></p>
      <div class="scheme-items owl-carousel">
        <?php foreach($fields_scheme as $field): ?>
          <div class="scheme__item">
            <div class="scheme__item-image-part">
              <svg class="scheme__item-image">
                <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#<?php echo $field['icon'] ?>"></use>
              </svg>
            </div>
            <div class="scheme__item-text-part"><?php echo $field['text'] ?></div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="info">
        <div class="info-items flex jcsb">
          <div class="info__item">
            <div class="info__item-image-part">
              <p class="info__item-header flex jcc aic"><?php echo $scheme['1']['header'] ?></p>
              <p class="info__item-text"><?php echo $scheme['1']['text'] ?></p>
            </div>
          </div>
          <div class="info__item">
            <div class="info__item-image-part">
              <p class="info__item-header flex jcc aic"><?php echo $scheme['2']['header'] ?></p>
              <p class="info__item-text"><?php echo $scheme['2']['text'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="about" id="about">
    <div class="container">
      <h2 class="about__header"><?php echo $about['header'] ?></h2>
      <p class="about__subheader subheader"><?php echo $about['subheader'] ?></p>
    </div>
    <div class="about-items owl-carousel">
      <?php foreach($fields_about_images as $field): ?>
        <a class="about__item" href="<?php echo $field['image'] ?>">
          <img class="about__item-image" src="<?php echo $field['image'] ?>" alt="">
        </a>
      <?php endforeach; ?>
    </div>
    <div class="container">
      <div class="about__inner flex">
        <div class="about__left"><?php echo $about['text'] ?></div>
        <div class="about__right">
          <div class="benefits-items flex">
            <?php foreach($fields_about_items as $field): ?>
              <div class="benefits__item">
                <div class="benefits__item-image-part">
                  <svg class="benefits__item-image">
                    <use xlink:href="/wp-content/themes/1PS/assets/img/sprite.svg#<?php echo $field['icon'] ?>"></use>
                  </svg>
                </div>
                <div class="benefits__item-text-part">
                  <p class="benefits__item-header"><?php echo $field['header'] ?></p>
                  <p class="benefits__item-text"><?php echo $field['text'] ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div><a class="about__button btn btn_stroke" href="#">развернуть текст</a>
      </div>
    </div>
  </div>
  <div class="reviews" id="reviews">
    <div class="container">
      <h2 class="reviews__header"><?php echo $reviews['header'] ?></h2>
      <p class="reviews__subheader subheader"><?php echo $reviews['subheader'] ?></p>
      <div class="reviews-items flex jcsb owl-carousel">
        <?php foreach($fields_reviews as $field): ?>
          <div class="reviews__item">
            <div class="reviews__item-image-part">
              <img class="reviews__item-image" src="<?php echo $field['image'] ?>" alt="">
            </div>
            <div class="reviews__item-text-part">
              <p class="reviews__item-name"><?php echo $field['header'] ?></p>
              <p class="reviews__item-text"><?php echo $field['text'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
