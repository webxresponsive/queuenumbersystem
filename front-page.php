<?php 
/**
 * The front-page template file.
 *
 *
 * @package WordPress
 * @subpackage RS Responsive
 */

get_header(); ?>
	<!-- content --> 
	<div class="row" role="main">
	
		<div class="col-md-12">
			
			<div class="row text-center">
				
				<div class="col-md-4">
					<section class="queue-board">
						<div class="queue-thumbnail-box">
							<!--<div class="queue-thumbnail">
								<div class="queue-board-image">
									<figure>
										<img src="" height=200 width=200/>
									</figure>
								</div>
							</div>-->
							<div class="queue-board-link">
								<a href="http://localhost/wordpress/queue-board-page/"><p>Queue Board</p></a>
							</div>
						</div>
					</section>
				</div>
				
				<div class="col-md-4">
					<section class="queue-counter">
						<div class="queue-thumbnail-box">
							<!--<div class="queue-thumbnail">
								<div class="queue-counter-image">
									<figure>
										<img src=""  height=200 width=200/>
									</figure>
								</div>
							</div>-->
							<div class="queue-counter-link">
								<a href="http://localhost/wordpress/queue-counter/"><p>Queue Counter</p></a>
							</div>
						</div>
					</section>
				</div>
				
				<div class="col-md-4">
					<section class="queue-station">
						<div class="queue-thumbnail-box">
							<!--<div class="queue-thumbnail">
								<div class="queue-station-image">
									<figure>
										<img src=""  height=200 width=200/>
									</figure>
								</div>
							</div>-->
							<div class="queue-station-link">
								<a href="http://localhost/wordpress/queue-station/"><p>Queue Station</p></a>
							</div>
						</div>
					</section>
				</div>
				
			</div>
				
		</div>
		
	</div>
	<!--<div class="row text-center">
		
		<div class="col-md-8 col-md-push-2">
			<div class="missed-number">
				<p>MISSING NUMBERS<span>
			<?php $args = array(
					'post_type' => 'post',
					);
				$query = new WP_Query($args);
				if($query->have_posts()){
					while($query->have_posts()){
						$query->the_post();
						$missed = get_post_meta(get_the_ID(),'_cmb_counter_late',true);
						echo $missed.' ';
					}
				}
				wp_reset_postdata();
				?>
				</span></p>
			</div>
		</div>
		
	</div>-->

<?php get_footer(); ?>