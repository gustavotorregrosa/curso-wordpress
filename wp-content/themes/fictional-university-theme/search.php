<?php get_header(); ?>



<?php pageBanner([
  'title' => 'Search results',
  'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
]) ?>



<div class="container container--narrow page-section">

  <?php if (have_posts()) { ?>
    <?php
    while (have_posts()) {
      the_post();
      get_template_part('template-parts/content', get_post_type());

      ?>

      <?php echo get_post_type() ?>


    <?php } ?>

  <?php } else { ?>
      <h2>No results</h2>
  <?php } ?>


  <?php echo get_search_form() ?>




  <?php echo paginate_links() ?>


</div>


<?php get_footer(); ?>