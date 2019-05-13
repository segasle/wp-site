<div class="wooOneContainer">

	<div class="wooOneWelcomeContainer">
		
			<?php
			
				$moxasaWelcomePostTitle = '';
				$moxasaWelcomePostDesc = '';

				if( '' != get_theme_mod('moxasa_wooone_welcome_post') && 'select' != get_theme_mod('moxasa_wooone_welcome_post') ){

					$moxasaWelcomePostId = get_theme_mod('moxasa_wooone_welcome_post');

					if( ctype_alnum($moxasaWelcomePostId) ){

						$moxasaWelcomePost = get_post( $moxasaWelcomePostId );

						$moxasaWelcomePostTitle = $moxasaWelcomePost->post_title;
						$moxasaWelcomePostDesc = $moxasaWelcomePost->post_excerpt;
						$moxasaWelcomePostContent = $moxasaWelcomePost->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($moxasaWelcomePostTitle); ?></h1>
			<div class="wooOneWelcomeContent">
				<p>
					<?php 
					
						if( '' != $moxasaWelcomePostDesc ){
							
							echo esc_html($moxasaWelcomePostDesc);
							
						}else{
							
							echo esc_html($moxasaWelcomePostContent);
							
						}
					
					?>
				</p>
			</div><!-- .wooOneWelcomeContent -->	
		
	</div><!-- .wooOneWelcomeContainer -->
	
	
	<div class="new-arrivals-container">
		
		<?php 
					
			if( 'no' != get_theme_mod('moxasa_show_wooone_heading') ): 
			
				$moxasaWooOneLatestHeading = __('Latest Products', 'moxasa');	
				$moxasaWooOneLatestText = __('Some of our latest products', 'moxasa');
			
					
				if( '' != get_theme_mod('moxasa_wooone_latest_heading') ){
					$moxasaWooOneLatestHeading = get_theme_mod('moxasa_wooone_latest_heading');
				}
				
				if( '' != get_theme_mod('moxasa_wooone_latest_text') ){
					$moxasaWooOneLatestText = get_theme_mod('moxasa_wooone_latest_text');
				}				
			
					
		?>
		<div class="new-arrivals-title">
		
			<h3><?php echo esc_html($moxasaWooOneLatestHeading); ?></h3>
			<p><?php echo esc_html($moxasaWooOneLatestText); ?></p>
		
		</div><!-- .new-arrivals-title -->
		<?php endif; ?>
		
		<?php
			
			$moxasaWooOnePaged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
			
			$moxasa_front_page_ecom = array(
				'post_type' => 'product',
				'paged' => $moxasaWooOnePaged
			);
			$moxasa_front_page_ecom_the_query = new WP_Query( $moxasa_front_page_ecom );
			
			$moxasa_front_page_temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $moxasa_front_page_ecom_the_query;
			
		?>		
		
		<div class="new-arrivals-content">
		<?php if ( have_posts() && post_type_exists('product') ) : ?>
		
		
			<div class="moxasa-woocommerce-content">
			
				<ul class="products">
			
					<?php /* Start the Loop */ ?>
					<?php while ( $moxasa_front_page_ecom_the_query->have_posts() ) : $moxasa_front_page_ecom_the_query->the_post(); ?>			
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				
				</ul><!-- .products -->
				
				<?php //the_posts_navigation(); ?>
				
				<?php moxasa_pagination( $moxasaWooOnePaged, $moxasa_front_page_ecom_the_query->max_num_pages); // Pagination Function ?>
				
			</div><!-- .moxasa-woocommerce-content -->
			
		<?php else : ?>
		
			<p><?php echo __('Please install wooCommerce and add products.', 'moxasa') ?></p>

		<?php 
			
			endif; 
			wp_reset_postdata();
			$wp_query = NULL;
			$wp_query = $moxasa_front_page_temp_query;
		?>			
		
		
		</div><!-- .new-arrivals-content -->		
	
	</div><!-- .new-arrivals-container -->	

</div>