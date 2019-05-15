<?php get_header(); ?>

  
<?php pageBanner([
  'title' => 'Todos os eventos',
  'subtitle' => 'Veja tudo q esta rolando'
]) ?>


  <div class="container container--narrow page-section">

    <?php 
      while(have_posts()){
        the_post();
    ?>

<?php get_template_part('template-parts/content', get_post_type()); ?>
    
    

    <?php } ?>

    <?php echo paginate_links() ?>

    <hr class="section-break">

    <p><a href="<?php echo site_url('/past-events') ?>">Eventos passados</a></p>


  </div>


<?php get_footer(); ?>