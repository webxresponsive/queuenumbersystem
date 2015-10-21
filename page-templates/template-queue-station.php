<?php 
/*
Template Name: Queue Station
*/

get_header(); wp_cron();
	/* global $wpdb;
	
	if(isset($_POST['add-queue'])){
		$customer_name = $_POST['customer-name']; // customer name
		$customer_age  = $_POST['customer-age'];  // customer age
		$member		   = $_POST['member'];        // member status
		if($_POST['station-1']<>NULL){
			$station = $_POST['station-1'];        // member station
		}elseif($_POST['station-2']<>NULL){
			$station = $_POST['station-2'];        // member station
		}else{
			$station = $_POST['station-3'];        // member station
		}
		
		$tbl = $wpdb->prefix.'posts'; */ // prefix for table in wordpress
		// query
	/* 	$result = $wpdb->get_col(
				"SELECT ID FROM $tbl
				ORDER BY ID DESC
				LIMIT 1"
			); */
		// get the previous queue id
	//	$prev_id = $result[0];
		
		// get the value of post meta of previous queue number
	/* 	$prev_queue = get_post_meta($prev_id,'_cmb_queue_number', true);
		if($prev_queue==NULL){	// check the $prev_queue if not null
			$prev_queue=1;
		}else{
			$prev_queue++; // +1 to the existing queue number			
		}	 */
		// generate random slug
	/* 	$string = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$slug = array(); //remember to declare $pass as an array
		$stringLength = strlen($string) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $stringLength);
			$slug[] = $string[$n];
		}
		$random_slug = implode($slug); */
		
		// arguments for the entry of queue 
	/* 	$add_queue_args = array(
			'post_type' 	=> 	'queue_item',
			'post_status'	=>	'publish',
			'post_title'	=>	$prev_queue,
			'post_name'		=>	$random_slug
		);
		
		$add_queue_result = wp_insert_post($add_queue_args, true); */
		// check for the $add_queue_result
	//	if($add_queue_result){
		//	$tbl = $wpdb->prefix.'posts'; // prefix for table in wordpress
			// query
			/* $query_result = $wpdb->get_col(
					"SELECT ID FROM $tbl
					ORDER BY ID DESC
					LIMIT 1"
				); */
			// get the latest queue id
		//	$current_id = $query_result[0];
		//	$url = get_permalink($current_id).'?cid='.$current_id;
		//	add_post_meta($current_id,'_cmb_customer_name', $customer_name); // add to customer name in post meta 
			//add_post_meta($current_id,'_cmb_customer_age', $customer_age);  // add to customer age in post meta
			//add_post_meta($current_id,'_cmb_member', $member); // add to customer member status in post meta
		//	add_post_meta($current_id,'_cmb_queue_number', $prev_queue); // add new to queue number in post meta
			//add_post_meta($current_id,'_cmb_member_url', $url); // add new to queue number in post meta
			// insert queue post to terms
		//	wp_set_object_terms( $current_id, $station, 'queue_category', false ); ?>
			 <script>
			/*	var message = 'Thank you for queueing\n Please type this url\n"<?php echo $url; ?>"\non your phone browser to get your queue number';
				alert(message);*/
				
			</script> 
<?php/* 	}
	} */
?>
		
		<!-- content -->        	
		<div class="row" role="main">
		
			<div class="col-md-12 station text-center">
				
				<div class="row" id="queue-station">
				
				<?php 
					$args = array(
							'orderby'	=> 'name', 
							'order'		=> 'ASC',
							'hide_empty'=> false,
						); 
					$terms = get_terms('queue_category', $args);
					foreach($terms as $term){ 
					if($term->count==NULL){ ?>
						
					<?php }else{ ?>
					<div class="col-md-4">
						<section class="station-content">
						
							<div class="queue-station-content">
								<p><?php echo $term->count; ?></p>	<!-- total no. of people in the queue -->
								<p>PEOPLE IN THIS QUEUE</p>
							</div>
							<?php if($term->name=="Station 1") {?>
							<a href="#" class="queue_station1"><img src="" height=200 width=200/></a><!-- link to the form-->
							<?php }elseif($term->name=="Station 2"){ ?><a href="#" class="queue_station2"><img src="" height=200 width=200/></a> <!-- link to the form-->
							<?php }else{ ?><a href="#" class="queue_station3"><img src="" height=200 width=200/></a><?php } ?> <!-- link to the form-->
						</section>
					</div>
					<?php } } ?>
					
				</div>
				
			</div>	
			<?php echo do_shortcode("[customer_registration]");?>
			<!--<div class="row station">
				<div class="col-md-4 col-md-push-4">
					<div class="add-queue">
						<form class="add-queue-form" method="post">
							<label>Name : </label><input type="text" name="customer-name" value="" placeholder="Enter Your Name" autofocus/><br/>
							<label>Age : </label><input type="text" name="customer-age" value="" placeholder="How old Are You?"/><br/>
							<label>Are you a member? </label>
								<input type="radio" name="member" value="yes"/> Yes 
								<input type="radio" name="member" value="no"/> No <br/><br/>
							<input type="submit" name="add-queue" value="submit" class="btn-submit">
						</form>
					</div>
				</div>
			</div>-->
			
		</div>

<?php get_footer(); ?>