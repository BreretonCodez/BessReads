<?php

function bessreads_post_types() {
    register_post_type("book", array(
        'description' => "Add a Book that you need reviewed.",
		'public' => true,
		'menu_icon' => 'dashicons-book-alt',
		'labels' => array(
			'name' => "Books",
			'add_new_item' => 'Add New Book',
 			'edit_item' => 'Edit Book',
 			'all_items' => 'All Books',
			'singular_name' => "Book"
		),
		'supports' => array(
			'title',
			'thumbnail',
			'excerpt',
            'author'
		),
		'has_archive' => true,
		'rewrite' => array('slug' => 'books')
    ));
    register_post_type("review", array(
        'description' => "Add a Review for a Book.",
		'public' => true,
		'menu_icon' => 'dashicons-comments',
		'labels' => array(
			'name' => "Reviews",
			'add_new_item' => 'Add New Review',
 			'edit_item' => 'Edit Review',
 			'all_items' => 'All Reviews',
			'singular_name' => "Review"
		),
		'supports' => array(
			'title',
			'excerpt',
			'author',
            'category'
		),
		'has_archive' => true,
		'rewrite' => array('slug' => 'reviews')
    ));
}

add_action('init','bessreads_post_types');