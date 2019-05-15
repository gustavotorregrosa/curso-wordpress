<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
    register_rest_route('university/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'

    ]);
}

function universitySearchResults($data){
    $mainQuery = new WP_Query([
        'post_type' => ['professor', 'page', 'post', 'program', 'campus', 'event'],
        's' => sanitize_text_field($data['key'])
    ]);


    $results = [
        'generalInfo' => [],
        'professors' => [],
        'programs' => [],
        'events' => [],
        'campi' => []
    ];

    

    while($mainQuery->have_posts()){
        $mainQuery->the_post();
        if(get_post_type() == 'post' or get_post_type() == 'page'){
            $results['generalInfo'][] = [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                 'postType' => get_post_type(),
                 'authorName' => get_the_author()   
            ];
        }
        
        if(get_post_type() == 'professor'){
            $results['professors'][] = [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
            ];
        }

        if(get_post_type() == 'program'){
            $results['programs'][] = [
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ];
        }

        if(get_post_type() == 'event'){
            $results['events'][] = [
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ];
        }

        if(get_post_type() == 'campus'){
            $results['campi'][] = [
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ];
        }

    }

    // return $professors->posts;
    return $results;
}