<?php if(!is_user_logged_in()){ 
    wp_redirect(site_url('/'));
    exit();
} ?>

    




<?php get_header() ?>

<?php
    while(have_posts()){
        the_post();
?>
  
  <?php pageBanner() ?>
    
  <div class="container container--narrow page-section">
      <ul id="my-notes" class="min-list link-list">
        <?php 
        
        $userNotes = new WP_Query([
          'post_type' => 'note',
          'posts_per_page' => -1,
          'author' => get_current_user_id() 
        ]);


        while($userNotes->have_posts()){
            $userNotes->the_post(); 
        ?>

          <li>
            <input class="note-title-field" type="text" value="<?php echo esc_attr(get_the_title()) ?>">
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true">Edit</i></span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></span>
            <textarea class="note-body-field" name="" id="" cols="30" rows="10"><?php echo esc_attr(get_the_content()) ?></textarea>
          </li>

        <?php } ?>
      </ul>
  </div>
   
<?php } ?>

<?php get_footer() ?>

