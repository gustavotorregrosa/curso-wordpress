<?php get_header(); ?>



<?php pageBanner([
    'title' => 'Bem vindo ao blog',
    'subtitle' => 'Keep up!'
]) ?>

  

  <div class="container container--narrow page-section">

    <?php 
      while(have_posts()){
        the_post();
    ?>
      <div class="post-item">
        <h3 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="metabox">
          <p>Posted by <?php the_author_posts_link() ?> on <?php the_time('F') ?> in <?php echo get_the_category_list(', ') ?></p>
        </div>
      </div>

      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading</a></p>

      </div>
    <?php } ?>

    <?php echo paginate_links() ?>


  </div>


<?php get_footer(); ?>