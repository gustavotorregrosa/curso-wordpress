<?php get_header(); ?>


<?php pageBanner([
    'title' => 'Eventos passados',
    'subtitle' => 'Veja o q rolou!'
]) ?>





<div class="container container--narrow page-section">

    <?php


    $today = date('Ymd');
    $pastEvents = new WP_Query([
        'paged' => get_query_var('paged', 1),
        'posts_per_page' => 1,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
            ]
        ]
    ]);


    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();

        ?>

    <?php get_template_part('template-parts/content', get_post_type()); ?>

    <?php } ?>

    <?php echo paginate_links([
        'total' => $pastEvents->max_num_pages
    ]) ?>


</div>


<?php get_footer(); ?>