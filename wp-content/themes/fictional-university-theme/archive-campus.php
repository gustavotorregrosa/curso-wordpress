<?php get_header(); ?>


<?php pageBanner([
    'title' => 'Campi',
    'subtitle' => 'Veja todos os campi'
]) ?>


<div class="container container--narrow page-section">

    <div class="acf-map">

        <?php
        while (have_posts()) {
            the_post();
            ?>


            <?php $mapLocation = get_field('map_location'); ?>

            <div data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>" class="marker"></div>


        <?php } ?>
        </div>
    



    
</div>


<?php get_footer(); ?>