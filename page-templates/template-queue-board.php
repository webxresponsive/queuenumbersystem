<?php
/*
Template Name: Queue Board
*/

get_header(); wp_cron(); ?>
	
	<!--content-->
    <div class="row">
		<div class="col-md-12 text-center">
			<section class="serving">
			<div class="row">
				<?php for($i=0; $i<4; $i++){ // loop for the queue number and counter no title ?>
				<div class="col-md-3 col-sm-3 col-xs-3">
						<?php if($i%2!=0){ ?>
							<h1 class="serving-title">NOW SERVING</h1>
						<?php }else{?>
							<h1 class="serving-title">COUNTER</h1>
						<?php } ?>
				</div>
				<?php } 
				$args = array(
							'post_type' 	=> 'post',
							'post_status'	=> 'publish',
							'order'			=> 'ASC'
					); // loop the value in queue number in every counter 
					
					$query = new WP_Query($args);
					
				while( $query->have_posts() ) : $query->the_post(); 
					$queue_serve = get_post_meta(get_the_ID(),'_cmb_number_queue', true); ?>	
				<?php if($i%2!=0){?>
					<div class="col-md-6 col-sm-6 col-xs-6">
				<?php }else{ ?>
					<div class="col-md-6 col-sm-6 col-xs-6">
				<?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<p class="servingnumber"><?php //echo $queue_serve; ?></p>	
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<p class="counternumber"><?php echo the_title(); ?></p>		
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			</section>
		</div>
		
    </div>

<?php get_footer(); ?>