<?php 

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes(){
    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'POST',
        'callback' => 'createLike'

    ]);


    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'DELETE',
        'callback' => 'deleteLike'

    ]);
}

function createLike($data){
    if(is_user_logged_in()){
        $professor = sanitize_text_field($data['professorID']); 

        $existQuery = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => [
                [
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professor
                ]
            ]
        ]);  

        if($existQuery->found_posts == 0 && get_post_type($professor) == 'professor'){
           
            return wp_insert_post([
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => 'our php create post test 2',
                'meta_input' => [
                    'liked_professor_id' => $professor
                ]
            ]);
        } else{
            die('invalid professor ID');
        }

       
    }else{
        die('Only logged in users - teste 123 PI');
    }

   
}

function deleteLike($data){
    $likeId = sanitize_text_field($data['like']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) and get_post_type($likeId) == 'like'){
        wp_delete_post($likeId, true);
        return "Congrats...";
    } else {
        die('You do not have permission to delete that');
    }

    
}