<?php
	
function removed_queue_number($served_id){
	$serve_now = array(
		'ID'		 => $served_id,
		'post_type'	 => 'queue_item',
		'post_status'=> 'trash'			
	);
	$test = wp_insert_post($serve_now,true); 
}
	
	$selected_counterid = $_GET['c'];  // get the counter id
	$counter_post = get_post($selected_counterid);    //get the content of the counter based on id
	$current_serve = get_post_meta($selected_counterid, '_cmb_counter_status', true); //get the current serve
	$queued_number = get_post_meta($selected_counterid,'_cmb_number_queue',true);  // get the queued number
	$late_customer = get_post_meta($selected_counterid,'_cmb_counter_late',true);   // get the late customer
	$served_customer = get_post_meta($selected_counterid,'_cmb_counter_serve',true);  //get the serve customer
	// query arguments
	$args = array(
			'post_type'   	  => 'queue_item', 
			'post_status'	  => 'publish',
			'posts_per_page ' => '1',  
			'order'			  => 'ASC' // ascending
		);
	$query = new WP_Query($args); // find the queue number available
		if($query->have_posts()){ $query->the_post();
			$queue_number = get_the_title();
			$queue_id = get_the_ID();
		}
		wp_reset_postdata();	
	
	if($_POST['done']){
		$number = $_POST['customer-number'];
		if($served_customer<>NULL){
			$served_customer = $served_customer.', '.$number;  // add number to the served customer as an array
			update_post_meta($selected_counterid,'_cmb_counter_serve',$served_customer); // update_post_meta value for the new serve number
		}else{
			add_post_meta($selected_counterid,'_cmb_counter_serve',number,false); // add_post_meta value for the new serve number
		}
		update_post_meta($selected_counterid,'_cmb_counter_status','Available to Serve',$current_serve);	// update the serve_status then save to database
		//removed_queue_number($served_id, $served_number);
	}elseif($_POST['skip']){
		$number = $_POST['customer-number'];
		if($late_customer<>NULL){
			$late_customer = $late_customer.', '.$number;  // add number to the late customer as an array
			update_post_meta($selected_counterid,'_cmb_counter_late',$late_customer);  // update_post_meta value for the late number
		}else{
			add_post_meta($selected_counterid,'_cmb_counter_late',$number,false);  // add_post_meta value for the late number
		}		
		update_post_meta($selected_counterid,'_cmb_counter_status','Available to Serve',$current_serve);	// update the serve_status then save to database
		}elseif($_POST['serve-now']){
		$served_id = $_POST['customer-id'];
		$served_number = $_POST['customer-number'];
		if($queued_number<>NULL){
			update_post_meta($selected_counterid,'_cmb_number_queue',$served_number,$queued_number);  // update_post_meta value for the new queue number
		}else{
			add_post_meta($selected_counterid,'_cmb_number_queue',$served_number);  // add_post_meta value for the new queue number
		}
		update_post_meta($selected_counterid,'_cmb_counter_status','Currently Serving');  // update the serve_status then save to database
		removed_queue_number($served_id); ?>
		<script>
			window.history.back();
		</script>
<?php	} ?>
	<!--content-->
    
<div class="row text-center">
		<div class="col-md-12">
			<section class="qcounter">
				<div class="qcounter-title">
					<h1>COUNTER <?php echo $counter_post->post_title; ?></h1>
				</div>
			</section>
		</div>
	</div>
	<div class="row text-center">
	<?php if($current_serve=='Available to Serve'){ ?>
		<div class="col-md-6">
			<section class="qcounter">
				<div class="qcounter-title">
					<h1>NEW CUSTOMERS</h1>
				</div>
				<div class="qcounter-content">
					<p>You are currently Available to Serve Customer No.</p>
					<h1><?php echo $queue_number; ?></h1>
					<p><form name="form1" method="post">
						<input type="hidden" name="customer-id" value="<?php echo $queue_id; ?>">
						<input type="hidden" name="customer-number" value="<?php echo $queue_number; ?>">
						<input type="submit" name="serve-now" value="PRESS TO SERVE NOW" class="btn btn-success h5">
					</form></p>
				</div>						
			</section>		
		</div>
		<div class="col-md-6">
			<section class="qcounter">
				<div class="qcounter-title">
					<h1>LATE COMERS</h1>
				</div>
				<div class="qcounter-content">
					<p>These are the Customer numbers that you currently skip</p>
					<p class="qcounter-number"><?php echo $message; ?><i class="fa fa-repeat"></i></p>
					<p class="qcounter-number">sdfs <i class="fa fa-repeat"></i></p>
					<p class="qcounter-number">dsfs <i class="fa fa-repeat"></i></p>
				</div>						
			</section>
		</div>
	<?php }elseif($current_serve=='Currently Serving'){ ?>
		<div class="col-md-12">
			<section class="qcounter">
				<div class="qcounter-content">
					<p>You are currently Serving Customer No.</p>
					<h1><?php echo $queued_number; ?></h1>
					<p>
						<form method="post">
							<input type="hidden" name="customer-number" value="<?php echo $queued_number; ?>">
							<input type="submit" name="done" class="btn btn-success h5" id="button" value="PRESS WHEN DONE" />
							<input type="submit" name="skip" class="btn btn-warning h5" type="button" id="button" value="SKIP" />
						</form>
					</p>
				</div>						
			</section>
		</div>		
	<?php }else{ ?>
		<p class="text-center">Go to <a href="<?php get_permalink(); ?>">Queue_Serve</a> to select counter</p>
	<?php } ?>
	</div>