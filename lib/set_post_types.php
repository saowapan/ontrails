<?php 
function set_post_types() {
    $post_types = [
        'journey' => [
            'singular_name'     => 'Journey',
            'plural_name'       => 'Journeys',
            'description'       => 'A list of all Journeys',
            'rewrite'           => 'journey',
            'supports'          => [
                'title','editor','thumbnail',
            ]
        ],
    ];
    foreach($post_types as $type) {

        if (!isset($type['hierarchical'])) {
            $type['hierarchical'] = false;
        }
        register_post_types(
            $type['singular_name'],
            $type['plural_name'],
            $type['description'],
            $type['rewrite'],
            $type['supports'],
            $type['hierarchical']
        );
    }
}
add_action( 'init', 'set_post_types' );


function register_post_types( $singular_name, $plural_name, $description , $rewrite, $supports, $hierarchical = false, $textdomain = 'wordpress') { //wordpress == ctt 
    $labels = array(
        'name'               => _x( $plural_name, $plural_name, $textdomain ),
        'singular_name'      => _x( $singular_name, 'post type singular name', $textdomain ),
        'menu_name'          => _x( $plural_name, 'admin menu', $textdomain ),
        'name_admin_bar'     => _x( $singular_name, 'add new on admin bar', $textdomain ),
        'add_new'            => _x( 'Add New', $singular_name, $textdomain ),
        'add_new_item'       => __( 'Add New ' . $singular_name, $textdomain ),
        'new_item'           => __( 'New ' . $singular_name, $textdomain ),
        'edit_item'          => __( 'Edit ' . $singular_name, $textdomain ),
        'view_item'          => __( 'View ' . $singular_name, $textdomain ),
        'all_items'          => __( 'All ' . $plural_name, $textdomain ),
        'search_items'       => __( 'Search ' . $plural_name, $textdomain ),
        'parent_item_colon'  => __( 'Parent ' . $plural_name . ':', $textdomain ),
        'not_found'          => __( 'No ' . $plural_name . ' found.', $textdomain ),
        'not_found_in_trash' => __( 'No ' . $plural_name . ' found in Trash.', $textdomain )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', $textdomain ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => $rewrite ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => $hierarchical,
        'menu_position'      => null,
        'supports'           => $supports
    );

    register_post_type( $singular_name, $args );
}
?>