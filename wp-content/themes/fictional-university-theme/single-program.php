<?php get_header() ?>

<?php
while (have_posts()) {
  the_post();
  ?>

<?php pageBanner() ?>




  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i>Todos os programas</a> <span class="metabox__main"><?php the_title() ?></span></p>
    </div>
    <div class="generic-content">
      <?php the_field('main_body_content') ?>




    </div>



    <?php
    $relatedProfessors = new WP_Query([
      'posts_per_page' =>-1,
      'post_type' => 'professor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => [
        [
          'key' => 'related_programs',
          'compare' => 'like',
          'value' => '"'.get_the_ID().'"' 

        ]
      ]
    ]);

         
    ?>

    <?php if($relatedProfessors->have_posts()) { ?>

    <hr class="section-break">
    <h2 class="headline headline--medium">Professores de <?php echo get_the_title() ?></h2>


    <ul class="professor-cards">
    <?php

    while ($relatedProfessors->have_posts()) {
      $relatedProfessors->the_post();
      ?>

      <li class="professor-card__list-item">

        <a class="professor-card" href="<?php the_permalink() ?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>" alt="">
          <span class="professor-card__name"><?php the_title() ?></span>
        </a>
      
      </li>

    <?php } ?>

    </ul>

    <?php } ?>


    <?php wp_reset_postdata() ?>



    <?php
    $today = date('Ymd');
    $homePageEvents = new WP_Query([
      'posts_per_page' => -1,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => [
        [
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        ],
        [
          'key' => 'related_programs',
          'compare' => 'like',
          'value' => '"'.get_the_ID().'"' 

        ]
      ]
    ]);

    ?>

    <?php if($homePageEvents->have_posts()) { ?>

    <hr class="section-break">
    <h2 class="headline headline--medium">Proximos eventos de <?php echo get_the_title() ?></h2>

    <?php

    while ($homePageEvents->have_posts()) {
      $homePageEvents->the_post();
      ?>

<?php get_template_part('template-parts/content', get_post_type()); ?>

      
    <?php } ?>

    <?php } ?>

    <?php wp_reset_postdata() ?>

      <?php
      
        $relatedCampuses = get_field('related_campi'); 
        if($relatedCampuses){
        ?>
          <h3><?php echo get_the_title() ?> is available aat this campi '</h3>
          <ul>

          </ul>
          <?php
              foreach($relatedCampuses as $campus){
          ?>
              <li><a href="<?php echo get_the_permalink($campus) ?>">
              <?php echo get_the_title($campus) ?>
              </a>
                
              </li>

<?php

              }

          
          ?>

          </ul>



        <?php } ?>


  </div>


<?php
}
?>

<?php get_footer() ?>