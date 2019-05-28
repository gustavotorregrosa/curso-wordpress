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
      <div class="create-note">
        <h2 class="headline headline--medium">Create New Note</h2>
        <input class="new-note-title" type="text" placeholder="title">
        <textarea class="new-note-body" name="" id="" cols="30" rows="10" placeholder="your note here..."></textarea>
        <span class="submit-note">Create note</span>
        <span class="note-limit-message">Note limit reached</span>


      </div>

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

          <li data-state="readonly" data-id="<?php the_ID() ?>">
            <input readonly class="note-title-field" type="text" value="<?php echo str_replace("Private: ","",esc_attr(get_the_title())) ?>">
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true">Edit</i></span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></span>
            <textarea readonly class="note-body-field" name="" id="" cols="30" rows="10"><?php echo esc_textarea(get_the_content()) ?></textarea>
            <span class="update-note btn btn--blue btn--smal"><i class="fa fa-arrow-right" aria-hidden="true">Save</i></span>
          </li>

        <?php } ?>
      </ul>
  </div>
   
<?php } ?>

<?php get_footer() ?>

