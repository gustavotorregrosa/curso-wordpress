<?php get_header() ?>

<?php
while (have_posts()) {
    the_post();
    ?>

    <?php pageBanner() ?>


    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i>Todos os campi</a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>
        <div class="generic-content">
            <?php the_content() ?>

            <div class="acf-map">

                <?php $mapLocation = get_field('map_location'); ?>

                <div data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>" class="marker"></div>

            </div>

        </div>
 
        <?php
        $relatedPrograms = new WP_Query([
            'posts_per_page' => -1,
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'related_campi',
                    'compare' => 'like',
                    'value' => '"' . get_the_ID() . '"'

                ]
            ]
        ]);

        ?>

        <?php if ($relatedPrograms->have_posts()) { ?>

            <hr class="section-break">
            <h2 class="headline headline--medium">Programas disponíveis</h2>

            <ul class="professor-cards">
                <?php

                while ($relatedPrograms->have_posts()) {
                    $relatedPrograms->the_post();
                    ?>

                    <li clas="min-list link-list">

                        <a href="<?php the_permalink() ?>">
                          
                            <?php the_title() ?>
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
                    'value' => '"' . get_the_ID() . '"'

                ]
            ]
        ]);

        ?>

        <?php if ($homePageEvents->have_posts()) { ?>

            <hr class="section-break">
            <h2 class="headline headline--medium">Proximos eventos de <?php echo get_the_title() ?></h2>

            <?php

            while ($homePageEvents->have_posts()) {
                $homePageEvents->the_post();
                ?>

                <?php get_template_part('template-parts/content', get_post_type()); ?>


            <?php } ?>

        <?php } ?>




    </div>


<?php
}
?>

<?php get_footer() ?>