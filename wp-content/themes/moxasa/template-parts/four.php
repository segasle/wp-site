<div class="moxasaFourContainer">
	
	<?php if( '' != get_theme_mod('moxasa_four_welcome_post') && 'select' != get_theme_mod('moxasa_four_welcome_post') ) : 

			$moxasaFourWelcomePostTitle = '';
			$moxasaFourWelcomePostDesc = '';
			$moxasaFourWelcomePostContent = '';


			$moxasaFourWelcomePostId = get_theme_mod('moxasa_four_welcome_post');

			if( ctype_alnum($moxasaFourWelcomePostId) ){

				$moxasaFourWelcomePost = get_post( $moxasaFourWelcomePostId );

				$moxasaFourWelcomePostTitle = $moxasaFourWelcomePost->post_title;
				$moxasaFourWelcomePostDesc = $moxasaFourWelcomePost->post_excerpt;
				$moxasaFourWelcomePostContent = $moxasaFourWelcomePost->post_content;

			}			

	?>

	<div class="moxasaFourWelcome">

		<h2><?php echo esc_html($moxasaFourWelcomePostTitle); ?></h2>
		<p>
		<?php 

			if( '' != $moxasaFourWelcomePostDesc ){

				echo esc_html($moxasaFourWelcomePostDesc);

			}else{

				echo esc_html($moxasaFourWelcomePostContent);

			}

		?>			
		</p>

	</div>	
	
	<?php endif; ?>
	
	<?php
		if( '' != get_theme_mod('moxasa_four_services_cat') && 'select' != get_theme_mod('moxasa_four_services_cat') ):
	?>
	<div class="moxasaFouServices">
		
		<?php

			$moxasa_four_cat = '';

			if(get_theme_mod('moxasa_four_services_cat')){
					$moxasa_four_cat = get_theme_mod('moxasa_four_services_cat');
			}else{
					$moxasa_four_cat = 0;
			}
		
			if(get_theme_mod('moxasa_four_services_num')){
					$moxasa_four_cat_num = get_theme_mod('moxasa_four_services_num');
			}else{
					$moxasa_four_cat_num = 4;
			}		

			$moxasa_four_args = array(
				   // Change these category SLUGS to suit your use.
				   'ignore_sticky_posts' => 1,
				   'post_type' => array('post'),
				   'posts_per_page'=> $moxasa_four_cat_num,
				   'cat' => $moxasa_four_cat
			);

			$moxasa_four = new WP_Query($moxasa_four_args);		

			if ( $moxasa_four->have_posts() ) : while ( $moxasa_four->have_posts() ) : $moxasa_four->the_post();
		
   		?>		
	
		<div class="moxasaFouServicesItem">
			
			<div class="moxasaFouServicesItemImage">
			
				<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('moxasa-home-posts');
						}else{
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/frontsix.png" />';
						}						
				?>
				
			</div>
			
			<div class="moxasaFouServicesItemContent">
			
				<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
				<p>
					<?php  
						
						//$frontPostExcerpt = '';
						//$frontPostExcerpt = get_the_excerpt();
					
						if( has_excerpt() ){
							echo esc_html(get_the_excerpt());
						}else{
							echo esc_html(moxasa_limitedstring(get_the_content(), 50));
						}
					
					?>
				</p>
				
			</div>			
			
		</div>
		<?php endwhile; wp_reset_postdata(); endif;?>
		
	</div>
	<?php endif; ?>
	
</div>