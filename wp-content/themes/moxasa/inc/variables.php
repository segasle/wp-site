<?php

$moxasaPostsPagesArray = array(
	'select' => __('Select a post/page', 'moxasa'),
);

$moxasaPostsPagesArgs = array(
	
	// Change these category SLUGS to suit your use.
	'ignore_sticky_posts' => 1,
	'post_type' => array('post', 'page'),
	'orderby' => 'date',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	
);
$moxasaPostsPagesQuery = new WP_Query( $moxasaPostsPagesArgs );
	
if ( $moxasaPostsPagesQuery->have_posts() ) :
							
	while ( $moxasaPostsPagesQuery->have_posts() ) : $moxasaPostsPagesQuery->the_post();
			
		$moxasaPostsPagesId = get_the_ID();
		if(get_the_title() != ''){
				$moxasaPostsPagesTitle = get_the_title();
		}else{
				$moxasaPostsPagesTitle = get_the_ID();
		}
		$moxasaPostsPagesArray[$moxasaPostsPagesId] = $moxasaPostsPagesTitle;
	   
	endwhile; wp_reset_postdata();
							
endif;

$moxasaYesNo = array(
	'select' => __('Select', 'moxasa'),
	'yes' => __('Yes', 'moxasa'),
	'no' => __('No', 'moxasa'),
);

$moxasaSliderType = array(
	'select' => __('Select', 'moxasa'),
	'header' => __('WP Custom Header', 'moxasa'),
	'owl' => __('Owl Slider', 'moxasa'),
);

$moxasaServiceLayouts = array(
	'select' => __('Select', 'moxasa'),
	'one' => __('One', 'moxasa'),
	'two' => __('Two', 'moxasa'),
);

$moxasaAvailableCats = array( 'select' => __('Select', 'moxasa') );

$moxasa_categories_raw = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, ) );

foreach( $moxasa_categories_raw as $category ){
	
	$moxasaAvailableCats[$category->term_id] = $category->name;
	
}

$moxasaBusinessLayoutType = array( 
	'select' => __('Select', 'moxasa'), 
	'four' => __('Four', 'moxasa'),
	'woo-one' => __('Woocommerce One', 'moxasa'),
);
