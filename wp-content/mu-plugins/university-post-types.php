<?php

function university_post_types(){
    register_post_type('event', [
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
    
}

add_action('init', 'university_post_types');