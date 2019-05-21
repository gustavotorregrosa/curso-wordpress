<?php

function university_post_types(){

    register_post_type('campus', [
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'supports' => [
            'title',
            'editor',
            'excerpt'
        ],
        'rewrite' => [
            'slug' => 'campi'
        ],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Campi',
            'add_new_item' => 'Adicionar campus',
            'edit_item' => 'Editar Campus',
            'all_items' => 'Todos os Campi',
            'singular_name' => 'Campus'
        ],
        'menu_icon' => 'dashicons-location-alt'
    ]);

    register_post_type('professor', [
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
            'thumbnail'
        ],
  
        'public' => true,
        'labels' => [
            'name' => 'Professores',
            'add_new_item' => 'Adicionar professor',
            'edit_item' => 'Editar professor',
            'all_items' => 'Todos os professores',
            'singular_name' => 'Professor'
        ],
        'menu_icon' => 'dashicons-welcome-learn-more'
    ]);





    register_post_type('event', [
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'supports' => [
            'title',
            'editor',
            'excerpt'
        ],
        'rewrite' => [
            'slug' => 'events'
        ],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Events',
            'add_new_item' => 'Adicionar evento',
            'edit_item' => 'Editar Evento',
            'all_items' => 'Todos os Eventos',
            'singular_name' => 'Evento'
        ],
        'menu_icon' => 'dashicons-calendar-alt'
    ]);


    register_post_type('program', [
        'supports' => [
            'title',
            // 'editor'
        ],
        'rewrite' => [
            'slug' => 'programs'
        ],
        'has_archive' => true,
        'public' => true,
        'labels' => [
            'name' => 'Programas',
            'add_new_item' => 'Adicionar programa',
            'edit_item' => 'Editar programa',
            'all_items' => 'Todos os Programas',
            'singular_name' => 'Programa'
        ],
        'menu_icon' => 'dashicons-awards'
    ]);
    
}

add_action('init', 'university_post_types');