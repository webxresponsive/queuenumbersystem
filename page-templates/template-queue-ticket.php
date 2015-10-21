<?php
	$customer_id = $_GET['cid'];
	if($_GET['cancel']){
		$queue_id = $_GET['queue_id'];
		
		if($queue_id<>NULL){
			$serve_now = array(
				'ID'		 => $queue_id,
				'post_type'	 => 'queue_item',
				'post_status'=> 'trash'			
			);
			$test = wp_insert_post($serve_now,true); 
			$location = header('Location : '.get_template_directory_uri().'/template-queue-station.php');
			var_dump($location);
		}
	}
?>
	<!-- content -->        	
	<div class="row" role="main">
	
		<div class="col-md-12">
		
			<section class="ticket text-center">
				
				<div class="queue-thumbnail-box">
					<div class="queue-ticket-thumbnail">
						<div class="queue-ticket-image">
							<figure>
								<img src="/wordpress/wp-content/uploads/2015/07/images_05.jpg" height=200 width=200/>
							</figure>
						</div>
					</div>
				</div>
				<div class="queue-ticket-content">
					<p class="queue-ticket-content">THERE ARE</p>
					<?php 
					$args = array( // arguments array for selecting queue post type
								'post_type'		=> 'queue_item',
								'order'			=> 'ASC',
								/* 'date_query' 	=> array( // getting the date now
										array(
											'year'  => $today['year'],
											'month' => $today['mon'],
											'day'   => $today['mday'],
										),
									),  */
							);		 
						$query_queue = new WP_Query($args); // the query the arguments
						$i = 0;
						while($query_queue->have_posts()) : $query_queue->the_post();   // loop the all results 
								switch(get_the_ID()) { 								// check each id of queue number 
								case $customer_id:  										// check the current selected queue_id
									$count_left = $i; 									// count the left before it's turn
									break; 												// force to end the execution of loop
								default:  												// default for the switch
									break; 												// force also to end the execution of loop
							}$i++;												// count loop times
						endwhile; 
						wp_reset_postdata(); ?>
						if(count_left)
					<h1><?php echo $count_left; ?></h1>	
					<p class="queue-ticket-text-content">PEOPLE AHEAD OF YOU</p>
					<form method="get">
						<input type="hidden" name="queue_id" value="<?php echo $customer_id; ?>">
						<p class="queue-ticket-cancel-button"><input type="submit" class="btn-danger" name="cancel" value="CANCEL QUEUE"></p>
					</form>
				</div>
				
			</section>
			
		</div>
		
	</div> 