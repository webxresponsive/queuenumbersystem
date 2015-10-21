<?php
/**
 * The Template for displaying 404 page or page not found
 */

get_header(); ?>
	
	<div class="row">
		
		<div class="col-md-12">
			
			<section class="section section-content">
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry">
						<p>Sorry but we can't find the posts you're looking for, perhaps searching will help.</p>
					
						<?php get_search_form(); ?>
					</div>
				</article>
			</section>
		</div>
		
	</div>

<?php get_footer(); ?>