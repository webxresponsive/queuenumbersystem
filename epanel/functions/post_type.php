<?php
/*
 * @desc Register new post type
 * 
 */	

add_action( 'init', 'register_posts_types' );
/*
 * @desc	Regsiter customer post_types for queue number
 */
function register_posts_types() {
	global $theme_domain;

	// Queue Categories
	$args = array(
		'label' => __( 'Queue Categories', $theme_domain ),
		'labels' => array(
			'name' => __( 'Queue Categories', $theme_domain ),
			'singular_name' => __( 'Queue Category', $theme_domain ),
			'search_items' => __( 'Search Queue Category', $theme_domain ),
			'popular_items' => __( 'Popular Queue Categories', $theme_domain ),
			'all_items' => __( 'All Queue Categories', $theme_domain ),
			'parent_item' => __( 'Parent Queue Category', $theme_domain ),
			'edit_item' => __( 'Edit Queue Category', $theme_domain ),
			'update_item' => __( 'Update Queue Category', $theme_domain ),
			'add_new_item' => __( 'Add New Queue Category', $theme_domain ),
			'new_item_name' => __( 'New Queue Category', $theme_domain ),
			'separate_items_with_commas' => __( 'Separate categories with commas', $theme_domain ),
			'add_or_remove_items' => __( 'Add or remove categories', $theme_domain ),
			'choose_from_most_used' => __( 'Choose from most used categories', $theme_domain )
			),
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite' => array(
			'slug' => 'queue_category',
			'hierarchical' => true,
			),
		'query_var' => true
	);
	register_taxonomy( 'queue_category', 'queue_item', $args );
	
	// add term in the queue custom post type
	$parent_term = term_exists( '', 'queue_category' ); // array is returned if taxonomy is given
	$parent_term_id = $parent_term['term_id']; // get numeric term id
	wp_insert_term(
	  'Station 1', 			// the term 
	  'queue_category', 		// the taxonomy
	  array(
		'description'=> 'Station 1',
		'slug' => 'station-1',
		'parent'=> $parent_term_id
	  )
	);
	wp_insert_term(
	  'Station 2', 			// the term 
	  'queue_category', 		// the taxonomy
	  array(
		'description'=> 'Station 2',
		'slug' => 'station-2',
		'parent'=> $parent_term_id
	  )
	);
	wp_insert_term(
	  'Station 3', 			// the term 
	  'queue_category', 		// the taxonomy
	  array(
		'description'=> 'Station 3',
		'slug' => 'station-3',
		'parent'=> $parent_term_id
	  )
	);
	
	
	// register posttype for our queue number
	register_post_type( 'queue_item',
		array(
			'labels' => array(
				'name' 					=> __( 'Queue Items' ),
				'singular_name' 		=> __( 'Queue Item' ),
				'add_new' 				=> __( 'Add Queue Item' ),
				'add_new_item' 			=> __( 'Add New Queue Item' ),
				'edit_item' 			=> __( 'Edit Queue Item' ),
				'new_item' 				=> __( 'Add New Queue Item' ),
				'view_item' 			=> __( 'View Queue Item' ),
				'search_items' 			=> __( 'Search Queue Item' ),
				'not_found' 			=> __( 'No queue item found' ),
				'not_found_in_trash' 	=> __( 'No queue item found in trash' )
			),
			'public' 				=> true,
			'supports' 				=> array( 'title' ),
			'hierarchical' 			=> true,
			'rewrite' 				=> array( "slug" => "queue_item" ),
			'menu_position' 		=> 80
		)
	);
	
	//insert page for the queue menu in admin
	/* $queue_titles = array('QueueBoard','QueueCounter','QueueStation','AddCounter');
	for($i=0; $i<4; $i++){
		$queue_menu = array(
		'post_type'    => 'page',
		'post_title'   => $title[$i],
		'post_status'  => 'publish',
		'post_name'	   => $title,
		'page_template'=> 'template'.$title.php
		);
	}
	
	$test = wp_insert_post($queue_menu);
	
	var_dump($test); */
}