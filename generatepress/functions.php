<?php
/**
 * GeneratePress.
 *
 * Please do not make any edits to this file. All edits should be done in a child theme.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set our theme version.
define( 'GENERATE_VERSION', '3.4.0' );

if ( ! function_exists( 'generate_setup' ) ) {
	add_action( 'after_setup_theme', 'generate_setup' );
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.1
	 */
	function generate_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'generatepress' );

		// Add theme support for various features.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		$color_palette = generate_get_editor_color_palette();

		if ( ! empty( $color_palette ) ) {
			add_theme_support( 'editor-color-palette', $color_palette );
		}

		add_theme_support(
			'custom-logo',
			array(
				'height' => 70,
				'width' => 350,
				'flex-height' => true,
				'flex-width' => true,
			)
		);

		// Register primary menu.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'generatepress' ),
			)
		);

		/**
		 * Set the content width to something large
		 * We set a more accurate width in generate_smart_content_width()
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1200; /* pixels */
		}

		// Add editor styles to the block editor.
		add_theme_support( 'editor-styles' );

		$editor_styles = apply_filters(
			'generate_editor_styles',
			array(
				'assets/css/admin/block-editor.css',
			)
		);

		add_editor_style( $editor_styles );
	}
}

/**
 * Get all necessary theme files
 */
$theme_dir = get_template_directory();

require $theme_dir . '/inc/theme-functions.php';
require $theme_dir . '/inc/defaults.php';
require $theme_dir . '/inc/class-css.php';
require $theme_dir . '/inc/css-output.php';
require $theme_dir . '/inc/general.php';
require $theme_dir . '/inc/customizer.php';
require $theme_dir . '/inc/markup.php';
require $theme_dir . '/inc/typography.php';
require $theme_dir . '/inc/plugin-compat.php';
require $theme_dir . '/inc/block-editor.php';
require $theme_dir . '/inc/class-typography.php';
require $theme_dir . '/inc/class-typography-migration.php';
require $theme_dir . '/inc/class-html-attributes.php';
require $theme_dir . '/inc/class-theme-update.php';
require $theme_dir . '/inc/class-rest.php';
require $theme_dir . '/inc/deprecated.php';

if ( is_admin() ) {
	require $theme_dir . '/inc/meta-box.php';
	require $theme_dir . '/inc/class-dashboard.php';
}

/**
 * Load our theme structure
 */
require $theme_dir . '/inc/structure/archives.php';
require $theme_dir . '/inc/structure/comments.php';
require $theme_dir . '/inc/structure/featured-images.php';
require $theme_dir . '/inc/structure/footer.php';
require $theme_dir . '/inc/structure/header.php';
require $theme_dir . '/inc/structure/navigation.php';
require $theme_dir . '/inc/structure/post-meta.php';
require $theme_dir . '/inc/structure/sidebars.php';
require $theme_dir . '/inc/structure/search-modal.php';

function enqueue_bootstrap() {
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
}

function custom_admin_headings($wp_admin_bar) {
	$book = array(
		'id' => 'book-heading',
		'title'=> 'My Books',
		'href' => '#',
		'meta' => array(
			'class' => 'book-heading',
			'title' => 'My Books',
		),
		'priority' => 9998,
	);

	$review = array(
		'id' => 'review-heading',
		'title'=> 'Reviews',
		'href' => '#',
		'meta' => array(
			'class' => 'review-heading',
			'title' => 'Reviews',
		),
		'priority' => 9999,
	);

	$wp_admin_bar->add_node($book);
	$wp_admin_bar->add_node($review);

	$wp_admin_bar->add_menu(array(
		'parent' => 'book-heading',
		'id'=> 'book-menu-1',
		'title'=> 'My Books',
		'href' => 'http://testreads.local/wp-admin/edit.php?post_type=book'
	));

	$wp_admin_bar->add_menu(array(
		'parent' => 'review-heading',
		'id'=> 'review-menu-1',
		'title'=> 'My Review List',
		'href' => '#'
	));

	$wp_admin_bar->add_menu(array(
		'parent' => 'review-heading',
		'id'=> 'review-menu-2',
		'title'=> 'My Reviews',
		'href' => 'http://testreads.local/wp-admin/edit.php?post_type=review'
	));

}

function modify_category_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_category()) {
        $query->set('post_type', 'book');
    }
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');
add_action('admin_bar_menu', 'custom_admin_headings', 999);
add_action('after_setup_theme','custom_image_sizes');
add_action('pre_get_posts', 'modify_category_query');

function custom_image_sizes() {
	add_image_size('home-thumbnail', 150, 200, true);
	add_image_size('disp-thumbnail', 200, 350, true);
}