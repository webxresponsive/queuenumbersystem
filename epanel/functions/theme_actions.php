<?php 
/**
 * @desc	If you have something to add in add_action function add it here.
 * 
 */
 
add_action('wp_head','custom_placeholder_callback');
function custom_placeholder_callback() { ?>
	<script>
	jQuery(document).ready(function($){
		$("#whats-new-textarea textarea").attr('placeholder','What are you in the mood to do...');
	});
	</script>
	<?php
}

add_action( 'login_head', 'rs_custom_admin_logo' );
/*
 * @desc Change WP Login Logo
 */
function rs_custom_admin_logo() 
{
	global $data;
	
	$logo_path = $data['rsclean_logo'];
	?>
	<style type="text/css">
		.login h1 a{
			background: url('<?php echo $logo_path; ?>') top center no-repeat;
			width: 326px;
			height: 88px;
		}
	</style>
	<?php 
}
add_action( 'wp_head', 'jquery_value' );
function jquery_value() {
	$args = array(
				'post_type' 	=> 'post',
				'post_status'	=> 'publish',
				'order'			=> 'ASC'
		); 
	$query = new WP_Query($args);
	while( $query->have_posts() ) { $query->the_post(); 
		$queue_serve = get_post_meta( get_the_ID(),'_cmb_number_queue', true ); ?>
		<script>
			jQuery(document).ready(function($){
				$(".servingnumber").append(<?php echo $queue_serve; ?>);
			});
		</script>
<?php	} 
	wp_reset_postdata();
}
/* 
add_action( 'wp_head','modal_box');
function modal_box(){ ?>
	<script type='text/javascript'>
		jQuery(function($) {
			$('#submit').click(function() {
			Boxy.confirm("Please confirm:", function() { alert('Confirmed!'); }, {title: 'Message'});
			return false;
		  });
		});
	</script>
<?php	
}
 */
