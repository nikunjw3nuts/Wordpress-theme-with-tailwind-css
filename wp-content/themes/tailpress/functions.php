<?php

/**
 * Enqueue scripts.
 */
function tailpress_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', tailpress_get_mix_compiled_asset_url( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'tailpress-fonts', tailpress_get_mix_compiled_asset_url( 'fonts/fonts.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'owl.carousel-style', tailpress_get_mix_compiled_asset_url( 'css/owl.carousel.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'tailpress-style', tailpress_get_mix_compiled_asset_url( 'css/style.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress-slim', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), $theme->get( 'Version' ) );//
	wp_enqueue_script( 'tailpress', tailpress_get_mix_compiled_asset_url( 'js/app.js' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'owl.carousel', tailpress_get_mix_compiled_asset_url( 'js/owl.carousel.js' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'script', tailpress_get_mix_compiled_asset_url( 'js/script.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get mix compiled asset.
 *
 * @param string $path The path to the asset.
 *
 * @return string
 */
function tailpress_get_mix_compiled_asset_url( $path ) {
	$path                = '/' . $path;
	$stylesheet_dir_uri  = get_stylesheet_directory_uri();
	$stylesheet_dir_path = get_stylesheet_directory();

	if ( ! file_exists( $stylesheet_dir_path . '/mix-manifest.json' ) ) {
		return $stylesheet_dir_uri . $path;
	}

	$mix_file_path = file_get_contents( $stylesheet_dir_path . '/mix-manifest.json' );
	$manifest      = json_decode( $mix_file_path, true );
	$asset_path    = ! empty( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return $stylesheet_dir_uri . $asset_path;
}

/**
 * Get data from the tailpress.json file.
 *
 * @param mixed $key The key to retrieve.
 *
 * @return mixed|null
 */
function tailpress_get_data( $key = null ) {
	$config = json_decode( file_get_contents( get_stylesheet_directory() . '/tailpress.json' ), true );

	if ( $key === null ) {
		return filter_var_array( $config, FILTER_SANITIZE_STRING );
	}

	$option = filter_var( $config[ $key ], FILTER_SANITIZE_STRING );

	return $option ?? null;
}

/**
 * Theme setup.
 */
function tailpress_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Adding Thumbnail basic support.
	add_theme_support( 'post-thumbnails' );

	// Block editor.
	add_theme_support( 'align-wide' );

	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style();

	$tailpress = tailpress_get_data();

	$colors = array_map(
		function ( $color, $hex ) {
			return array(
				'name'  => ucfirst( $color ),
				'slug'  => $color,
				'color' => $hex,
			);
		},
		array_keys( $tailpress['colors'] ),
		$tailpress['colors']
	);

	$font_sizes = array_map(
		function ( $size, $px ) {
			return array(
				'name' => ucfirst( $size ),
				'size' => $px,
				'slug' => $size,
			);
		},
		array_keys( $tailpress['fontSizes'] ),
		$tailpress['fontSizes']
	);

	add_theme_support( 'editor-color-palette', $colors );
	add_theme_support( 'editor-font-sizes', $font_sizes );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


function tailwind_specialty_cpt()
{
    $labels = array(
        'name' => _x('Performance', 'plural'),
        'singular_name' => _x('Performance', 'singular'),
        'menu_name' => _x('Performance', 'admin menu'),
        'name_admin_bar' => _x('Performance', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New Performance'),
        'new_item' => __('New Performance'),
        'edit_item' => __('Edit Performance'),
        'view_item' => __('View Performance'),
        'all_items' => __('All Performance'),
        'search_items' => __('Search Performance'),
        'not_found' => __('No Performance found.'),
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-media-spreadsheet',
        'supports' => array('title', 'thumbnail'),
        'show_in_rest' => true,
        'public' => false,
        'archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'cpt_performance'),
        'has_archive' => false,
        'hierarchical' => true,
    );
    register_post_type('cpt_performance', $args);
}
add_action('init', 'tailwind_specialty_cpt');