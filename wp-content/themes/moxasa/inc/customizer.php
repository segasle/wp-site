<?php
/**
 * moxasa Theme Customizer
 *
 * @package moxasa
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function moxasa_customize_register( $wp_customize ) {

	global $moxasaPostsPagesArray, $moxasaYesNo, $moxasaSliderType, $moxasaServiceLayouts, $moxasaAvailableCats, $moxasaBusinessLayoutType;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'moxasa_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'moxasa_customize_partial_blogdescription',
		) );
	}
	
	$wp_customize->add_panel( 'moxasa_general', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('General Settings', 'moxasa'),
		'active_callback' => '',
	) );

	$wp_customize->get_section( 'title_tagline' )->panel = 'moxasa_general';
	$wp_customize->get_section( 'background_image' )->panel = 'moxasa_general';
	$wp_customize->get_section( 'background_image' )->title = __('Site background', 'moxasa');
	$wp_customize->get_section( 'header_image' )->panel = 'moxasa_general';
	$wp_customize->get_section( 'header_image' )->title = __('Header Settings', 'moxasa');
	$wp_customize->get_control( 'header_image' )->priority = 20;
	$wp_customize->get_control( 'header_image' )->active_callback = 'moxasa_show_wp_header_control';	
	$wp_customize->get_section( 'static_front_page' )->panel = 'moxasa_business_page';
	$wp_customize->get_section( 'static_front_page' )->title = __('Select frontpage type', 'moxasa');
	$wp_customize->get_section( 'static_front_page' )->priority = 9;
	$wp_customize->remove_section('colors');
	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'background_color', 
			array(
				'label'      => __( 'Background Color', 'moxasa' ),
				'section'    => 'background_image',
				'priority'   => 9
			) ) 
	);
	//$wp_customize->remove_section('static_front_page');	
	//$wp_customize->remove_section('header_image');	

	/* Upgrade */	
	$wp_customize->add_section( 'moxasa_business_upgrade', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'title'      => __('Upgrade to PRO', 'moxasa'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'moxasa_show_sliderr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new moxasa_Customize_Control_Upgrade(
		$wp_customize,
		'moxasa_show_sliderr',
		array(
			'label'      => __( 'Show headerr?', 'moxasa' ),
			'settings'   => 'moxasa_show_sliderr',
			'priority'   => 10,
			'section'    => 'moxasa_business_upgrade',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''			
		)
	) );
	
	/* Usage guide */	
	$wp_customize->add_section( 'moxasa_business_usage', array(
		'priority'       => 9,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme Usage Guide', 'moxasa'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'moxasa_show_sliderrr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new moxasa_Customize_Control_Guide(
		$wp_customize,
		'moxasa_show_sliderrr',
		array(

			'label'      => __( 'Show headerr?', 'moxasa' ),
			'settings'   => 'moxasa_show_sliderrr',
			'priority'   => 10,
			'section'    => 'moxasa_business_usage',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''				
		)
	) );
	
	/* Header Section */
	$wp_customize->add_setting( 'moxasa_show_slider',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_show_slider',
		array(
			'label'      => __( 'Show header?', 'moxasa' ),
			'settings'   => 'moxasa_show_slider',
			'priority'   => 10,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $moxasaYesNo,
		)
	) );	
	$wp_customize->add_setting( 'moxasa_header_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_slider_type_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_header_type',
		array(
			'label'      => __( 'Header type :', 'moxasa' ),
			'settings'   => 'moxasa_header_type',
			'priority'   => 11,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $moxasaSliderType,
		)
	) );
	
	$wp_customize->add_setting( 'moxasa_slider_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_slider_cat',
		array(
			'label'      => __( 'Select a category for owl slider :', 'moxasa' ),
			'settings'   => 'moxasa_slider_cat',
			'priority'   => 20,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $moxasaAvailableCats,
		)
	) );	
	
	
	/* Business page panel */
	$wp_customize->add_panel( 'moxasa_business_page', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'      => __('Home/Front Page Settings', 'moxasa'),
		'active_callback' => '',
	) );
	
	$wp_customize->add_section( 'moxasa_business_page_layout_selection', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('Select FrontPage Layout', 'moxasa'),
		'active_callback' => 'moxasa_front_page_sections',
		'panel'  => 'moxasa_business_page',
	) );
	$wp_customize->add_setting( 'moxasa_business_page_layout_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_layout_type',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_business_page_layout_type',
		array(
			'label'      => __( 'Layout type :', 'moxasa' ),
			'settings'   => 'moxasa_business_page_layout_type',
			'priority'   => 10,
			'section'    => 'moxasa_business_page_layout_selection',
			'type'    => 'select',
			'choices' => $moxasaBusinessLayoutType,
		)
	) );	
	
	
	$wp_customize->add_section( 'moxasa_business_page_layout_four', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Four settings', 'moxasa'),
		'active_callback' => 'moxasa_front_page_sections',
		'panel'  => 'moxasa_business_page',
	) );
	$wp_customize->add_setting( 'moxasa_four_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_six_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'moxasa' ),
			'settings'   => 'moxasa_four_welcome_post',
			'priority'   => 10,
			'section'    => 'moxasa_business_page_layout_four',
			'type'    => 'select',
			'choices' => $moxasaPostsPagesArray,
		)
	) );
	
	$wp_customize->add_setting( 'moxasa_four_services_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_four_services_cat',
		array(
			'label'      => __( 'Select a category :', 'moxasa' ),
			'settings'   => 'moxasa_four_services_cat',
			'priority'   => 20,
			'section'    => 'moxasa_business_page_layout_four',
			'type'    => 'select',
			'choices' => $moxasaAvailableCats,
		)
	) );	
	
	$wp_customize->add_setting( 'moxasa_four_services_num',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_four_services_num',
		array(
			'label'      => __( 'Number of posts :', 'moxasa' ),
			'settings'   => 'moxasa_four_services_num',
			'priority'   => 20,
			'section'    => 'moxasa_business_page_layout_four',
			'type'    => 'text',
		)
	) );	
	
	$wp_customize->add_section( 'business_page_layout_wooone', array(
		'priority'       => 60,
		'capability'     => 'edit_theme_options',
		'title'      => __('Woo One settings', 'moxasa'),
		'active_callback' => 'moxasa_front_page_sections',
		'panel'  => 'moxasa_business_page',
	) );

	$wp_customize->add_setting( 'moxasa_wooone_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_wooone_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'moxasa' ),
			'settings'   => 'moxasa_wooone_welcome_post',
			'priority'   => 10,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'select',
			'choices' => $moxasaPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'moxasa_wooone_latest_heading',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_wooone_latest_heading',
		array(
			'label'      => __( 'Products Heading :', 'moxasa' ),
			'settings'   => 'moxasa_wooone_latest_heading',
			'priority'   => 20,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'text',
		)
	) );
	$wp_customize->add_setting( 'moxasa_wooone_latest_text',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_wooone_latest_text',
		array(
			'label'      => __( 'Products Text :', 'moxasa' ),
			'settings'   => 'moxasa_wooone_latest_text',
			'priority'   => 30,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'text',
		)
	) );	

	$wp_customize->add_section( 'moxasa_business_page_quote', array(
		'priority'       => 110,
		'capability'     => 'edit_theme_options',
		'title'      => __('Quote Settings', 'moxasa'),
		'active_callback' => '',
		'panel'  => 'moxasa_general',
	) );
	$wp_customize->add_setting( 'moxasa_show_quote',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_show_quote',
		array(
			'label'      => __( 'Show quote?', 'moxasa' ),
			'settings'   => 'moxasa_show_quote',
			'priority'   => 10,
			'section'    => 'moxasa_business_page_quote',
			'type'    => 'select',
			'choices' => $moxasaYesNo,
		)
	) );
	$wp_customize->add_setting( 'moxasa_quote_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_quote_post',
		array(
			'label'      => __( 'Select post', 'moxasa' ),
			'description' => __( 'Select a post/page you want to show in quote section', 'moxasa' ),
			'settings'   => 'moxasa_quote_post',
			'priority'   => 11,
			'section'    => 'moxasa_business_page_quote',
			'type'    => 'select',
			'choices' => $moxasaPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_section( 'moxasa_business_page_social', array(
		'priority'       => 120,
		'capability'     => 'edit_theme_options',
		'title'      => __('Social Settings', 'moxasa'),
		'active_callback' => '',
		'panel'  => 'moxasa_general',
	) );	
	$wp_customize->add_setting( 'moxasa_show_social',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'moxasa_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'moxasa_show_social',
		array(
			'label'      => __( 'Show social?', 'moxasa' ),
			'settings'   => 'moxasa_show_social',
			'priority'   => 10,
			'section'    => 'moxasa_business_page_social',
			'type'    => 'select',
			'choices' => $moxasaYesNo,
		)
	) );
	$wp_customize->add_setting( 'business_page_facebook',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_facebook', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Facebook', 'moxasa' ),
	  'description' => __( 'Enter your facebook url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_flickr',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_flickr', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Flickr', 'moxasa' ),
	  'description' => __( 'Enter your flickr url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_gplus',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_gplus', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Gplus', 'moxasa' ),
	  'description' => __( 'Enter your gplus url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_linkedin',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_linkedin', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Linkedin', 'moxasa' ),
	  'description' => __( 'Enter your linkedin url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_reddit',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_reddit', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Reddit', 'moxasa' ),
	  'description' => __( 'Enter your reddit url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_stumble',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_stumble', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Stumble', 'moxasa' ),
	  'description' => __( 'Enter your stumble url.', 'moxasa' ),
	) );
	$wp_customize->add_setting( 'business_page_twitter',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_twitter', array(
	  'type' => 'text',
	  'section' => 'moxasa_business_page_social', // Add a default or your own section
	  'label' => __( 'Twitter', 'moxasa' ),
	  'description' => __( 'Enter your twitter url.', 'moxasa' ),
	) );	
	
}
add_action( 'customize_register', 'moxasa_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function moxasa_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function moxasa_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function moxasa_customize_preview_js() {
	wp_enqueue_script( 'moxasa-customizer', esc_url( get_template_directory_uri() ) . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'moxasa_customize_preview_js' );

require get_template_directory() . '/inc/variables.php';

function moxasa_sanitize_yes_no_setting( $value ){
	global $moxasaYesNo;
    if ( ! array_key_exists( $value, $moxasaYesNo ) ){
        $value = 'select';
	}
    return $value;	
}

function moxasa_sanitize_post_selection( $value ){
	global $moxasaPostsPagesArray;
    if ( ! array_key_exists( $value, $moxasaPostsPagesArray ) ){
        $value = 'select';
	}
    return $value;	
}

function moxasa_front_page_sections(){
	
	$value = false;
	
	if( 'page' == get_option( 'show_on_front' ) ){
		$value = true;
	}
	
	return $value;
	
}

function moxasa_show_wp_header_control(){
	
	$value = false;
	
	if( 'header' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function moxasa_show_header_one_control(){
	
	$value = false;
	
	if( 'header-one' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function moxasa_sanitize_slider_type_setting( $value ){

	global $moxasaSliderType;
    if ( ! array_key_exists( $value, $moxasaSliderType ) ){
        $value = 'select';
	}
    return $value;	
	
}

function moxasa_sanitize_cat_setting( $value ){
	
	global $moxasaAvailableCats;
	
	if( ! array_key_exists( $value, $moxasaAvailableCats ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

function moxasa_sanitize_layout_type( $value ){
	
	global $moxasaBusinessLayoutType;
	
	if( ! array_key_exists( $value, $moxasaBusinessLayoutType ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

add_action( 'customize_register', 'moxasa_load_customize_classes', 0 );
function moxasa_load_customize_classes( $wp_customize ) {
	
	class moxasa_Customize_Control_Upgrade extends WP_Customize_Control {

		public $type = 'moxasa-upgrade';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="moxasa-upgrade-container" class="moxasa-upgrade-container">

				<ul>
					<li>More sliders</li>
					<li>More layouts</li>
					<li>Color customization</li>
					<li>Font customization</li>
				</ul>

				<p>
					<a href="https://www.themealley.com/business/">Upgrade</a>
				</p>
									
			</div><!-- .moxasa-upgrade-container -->
			
		<?php }	
		
	}
	
	class moxasa_Customize_Control_Guide extends WP_Customize_Control {

		public $type = 'moxasa-guide';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="moxasa-upgrade-container" class="moxasa-upgrade-container">

				<ol>
					<li>Select 'A static page' for "your homepage displays" in 'select frontpage type' section of 'Home/Front Page settings' tab.</li>
					<li>Enter details for various section like header, welcome, services, quote, social sections.</li>
				</ol>
									
			</div><!-- .moxasa-upgrade-container -->
			
		<?php }	
		
	}	

	$wp_customize->register_control_type( 'moxasa_Customize_Control_Upgrade' );
	$wp_customize->register_control_type( 'moxasa_Customize_Control_Guide' );
	
	
}