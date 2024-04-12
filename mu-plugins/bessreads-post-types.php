<?php

function bessreads_post_types() {
    register_post_type("book", array(
        'description' => "Add a Book that you need reviewed.",
		'public' => true,
		'menu_icon' => 'dashicons-book-alt',
		'labels' => array(
			'name' => "Books",
			'add_new' => 'Add New Book',
			'add_new_item' => 'Add New Book',
 			'edit_item' => 'Edit Book',
 			'all_items' => 'All Books',
			'singular_name' => "Book"
		),
		'supports' => array(
			'title',
			'summary',
			'thumbnail',
			'excerpt',
            'author',
			'custom-fields',
			'comments',
		),
		'taxonomies' => array(
			'category',
		),
		'has_archive' => true,
		'rewrite' => array('slug' => 'books')
    ));
    register_post_type("review", array(
        'description' => "Add a Review for a Book.",
		'public' => true,
		'menu_icon' => 'dashicons-slides',
		'labels' => array(
			'name' => "Reviews",
			'add_new' => 'Add New Review',
			'add_new_item' => 'Add New Review',
 			'edit_item' => 'Edit Review',
 			'all_items' => 'All Reviews',
			'singular_name' => "Review"
		),
		'supports' => array(
			'title',
			'excerpt',
			'author',
            'custom-fields',
			'page-attributes',
		),
		'has_archive' => true,
		'rewrite' => array('slug' => 'reviews')
    ));
    register_post_type( "club", array(
		'label' => "Book Club",
        'description' => "Book Clubs",
        'labels' => array(
			'name' => 'Book Clubs',
			'singular_name' => 'Book Club',
			'menu_name' => 'Book Clubs',
			'name_admin_bar' => 'Book Club',
			'archives' => 'Book Club Archives',
			'attributes' => 'Book Club Attributes',
			'parent_item_colon' => 'Parent Book Club:',
			'all_items' => 'All Book Clubs',
			'add_new_item' => 'Add New Book Club',
			'add_new' => 'Add New Book Club',
			'new_item' => 'New Book Club',
			'edit_item' => 'Edit Book Club',
			'update_item' => 'Update Book Club',
			'view_item' => 'View Book Club',
			'view_items' => 'View Book Clubs',
			'search_items' => 'Search Book Club',
			'not_found' => 'Not found',
			'not_found_in_trash' => 'Not found in Trash',
			'featured_image' => 'Featured Image',
			'set_featured_image' => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image' => 'Use as featured image',
			'insert_into_item' => 'Insert into book club',
			'uploaded_to_this_item' => 'Uploaded to this book club',
			'items_list' => 'Book Clubs list',
			'items_list_navigation' => 'Book Clubs list navigation',
			'filter_items_list' => 'Filter book clubs list',
		),
        'supports' => array( 
			'title', 
			'editor', 
			'thumbnail', 
			'custom-fields', 
			'page-attributes', 
		),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'rewrite' => array( 
			'slug' => 'book-clubs' 
		),
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
	));
	register_post_type('spotlight', array(
		'label' => "Spotlight",
        'labels' => array(
            'name' => "Author Spotlights",
			'add_new' => 'Add Spotlight',
            'add_new_item' => 'Add Spotlight',
            'edit_item' => 'Edit Author Spotlight',
            'all_items' => 'All Authors Spotlight',
            'singular_name' => "Author Spotlight",
        ),
        'menu_icon' => 'dashicons-buddicons-buddypress-logo',
        'rewrite' => array('slug' => 'spotlight'),
        'has_archive' => true,
        'supports' => array('title', 'thumbnail'),
		'public' => true,
    ));
}

add_action('init','bessreads_post_types');