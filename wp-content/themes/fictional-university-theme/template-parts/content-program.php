<div>
    <div class="post-item">
        <h3 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    </div>

    <div class="generic-content">
        <?php echo get_field('main_body_content') ; ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading</a></p>

    </div>

</div>