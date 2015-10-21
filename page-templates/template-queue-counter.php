<?php
/*
Template Name: Queue Counter
*/

get_header(); wp_cron(); ?>
	
	<!--content-->
    <div class="row">
		<div class="col-md-12 text-center">
		
			<div class="row counter">
			
				<div class="col-md-4">
					<div class="counter-title">
						<h1>COUNTER</h1>
					</div>
				</div>
				<div class="col-md-4">
					<div class="counter-title">
						<h1>STATUS</h1>
					</div>
				</div>
				<div class="col-md-4">
					<div class="counter-title">
						<h1>CUSTOMER NO</h1>
					</div>
				</div>
				
			</div>
			<?php 
					$args = array(
							'post_type'	  => 'post',
							'post_status' => 'publish',
							'order'		  => 'ASC'
					);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>
				<?php 	while ( $the_query->have_posts() ) : $the_query->the_post(); // the loop the counter ?>
			<div class="row counter">
				
				<div class="col-md-4">
					<div class="counter-content">
						<p><?php the_title(); ?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="counter-content">
						<?php $status = get_post_meta(get_the_ID(), '_cmb_counter_status',true); ?>
						<p><?php echo $status; ?><a href="<?php echo get_the_permalink().'?c='.get_the_ID(); ?>"><i class="fa fa-pencil-square-o"></i></a></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="counter-content">
					<?php $served_number = get_post_meta(get_the_ID(), '_cmb_number_queue', true); ?>
						<p><?php echo $served_number; ?></p>
					</div>
				</div>
				
			</div>
		
			<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>	
			
		</div>
		
    </div>

<?php get_footer(); ?>