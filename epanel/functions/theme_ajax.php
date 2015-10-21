<?php
/*
 * @author	Ryan Sutana
 * @desc	Process all datas coming from theme-ajax.js
 * since 	v 1.0
 */

add_action( 'wp_ajax_nopriv_theme_contact', 'theme_contact_callback' );
add_action( 'wp_ajax_theme_contact', 'theme_contact_callback' );
/*
 *	@desc	Process theme contact
 */
function theme_contact_callback() {
	global $wpdb, $data;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'rs_contact_action' ) )
       die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['message'];
	
	if( empty( $name ) ) {
		$error = 'Name field is required.';
	} else if( empty( $email ) ) {
		$error = 'Email field is required.';
	} else if( ! is_email( $email ) ) {
		$error = 'Invalid email address.';
	} else {
		$to = get_bloginfo('admin_email');
		$subject = get_bloginfo('name') . ' Contact';
		
		$message = '
			<html>
			<head>
			  <title>'. $subject .'</title>
			</head>
			<body>
				<p>
					<strong>Name: </strong>'. $name .' <br/>
					<strong>Email: </strong>'. $email .'
				</p>
				<p>'. $comment .'</p>
			</body>
			</html>
		';
		
		$headers[] = 'MIME-Version: 1.0' . "\r\n";
		$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers[] = "X-Mailer: PHP \r\n";
		$headers[] = 'From: ' . $name . ' <'. $email .'>' . "\r\n";
	
		$mail = wp_mail( $to, $subject, $message, $headers );
		
		if( $mail ) {
			if( $data['rsclean_contact_message'] )
				$success = $data['rsclean_contact_message'];
			else
				$success = 'Thank you! We will get back to you as soon as possible';
		}
		
	}
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo '<p class="success">'. $success .'</p>';
		
	// return proper result
	die();
}

add_action( 'wp_ajax_nopriv_user_registration', 'user_registration_callback' );
add_action( 'wp_ajax_user_registration', 'user_registration_callback' );
/*
 *	@desc	Process theme contact
 */
function user_registration_callback() {
	global $wpdb;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'rs_user_registration_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$pwd1 = $_POST['pwd1'];
	$pwd2 = $_POST['pwd2'];
	
	if( empty( $email ) || empty( $pwd1 ) || empty( $pwd2 ) || empty( $username ) || empty( $first_name ) || empty( $last_name) ) {
        $error = 'All fields are required.';
    } else if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $error = 'Invalid email address.';
    } else if( email_exists($email) ) {
        $error = 'Email already exist.';
    } else if( $pwd1 <> $pwd2 ) {
        $error = 'Password do not match.';        
    } else {
 
		$user_params = array (
			'first_name' 	=> apply_filters( 'pre_user_first_name', $first_name ), 
			'last_name' 	=> apply_filters( 'pre_user_last_name', $last_name ), 
			'user_pass' 	=> apply_filters( 'pre_user_user_pass', $pwd1 ), 
			'user_login' 	=> apply_filters( 'pre_user_user_login', $username ), 
			'user_email' 	=> apply_filters( 'pre_user_user_email', $email ), 
			'role' 			=> 'subscriber'
		);
        $user_id = wp_insert_user( $user_params );
		
        if( is_wp_error( $user_id ) ) {
            $error = 'Error on user creation.';
        } else {
            do_action( 'user_register', $user_id );
            
            $success = 1;
        }
        
    }
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo $success;
		
	// return proper result
	die();
}


add_action( 'wp_ajax_nopriv_user_login', 'user_login_callback' );
add_action( 'wp_ajax_user_login', 'user_login_callback' );
/*
 *	@desc	Process theme contact
 */
function user_login_callback() {
	global $wpdb;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
	
	
	if ( ! wp_verify_nonce( $nonce, 'rs_user_login_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	//We shall SQL escape all inputs to avoid sql injection.
	$username = $wpdb->escape($_GET['log']);
	$password = $wpdb->escape($_GET['pwd']);
	$remember = $wpdb->escape($_POST['remember']);
	
	if( empty( $username ) ) {
		$error = 'Username field is required.';
	} else if( empty( $password ) ) {
		$error = 'Password field is required.';
	} else {
		$user_data = array();
		$user_data['user_login'] = $username;
		$user_data['user_password'] = $password;
		$user_data['remember'] = $remember;  
		$user = wp_signon( $user_data, false );
		
		if ( is_wp_error($user) ) {
			$error = $user->get_error_message();
		} else {
			wp_set_current_user( $user->ID, $username );
			do_action('set_current_user');
			
			$success = 1;
		}
	}
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo $success;
		
	// return proper result
	die();
}

add_action( 'wp_ajax_nopriv_customer_registration', 'customer_registration_callback' );
add_action( 'wp_ajax_customer_registration', 'customer_registration_callback' );
/*
 *	@desc	Process theme contact
 */
function customer_registration_callback() {
	global $wpdb;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'rs_customer_registration_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	$station = $_POST['station'];
	$customer_name = $_POST['customer_name'];
	$customer_age = $_POST['age'];
	$validate_member = $_POST['member'];
	
	if( empty( $customer_name ) || empty( $customer_age ) || empty( $validate_member ) ) {
        $error = 'All fields are required.';     
    } else {		
		$tbl = $wpdb->prefix.'posts'; // prefix for table in wordpress
		// query
		$result = $wpdb->get_col(
				"SELECT ID FROM $tbl
				ORDER BY ID DESC
				LIMIT 1"
			);
		// get the previous queue id
		$prev_id = $result[0];
		
		// get the value of post meta of previous queue number
		$prev_queue = get_post_meta($prev_id,'_cmb_queue_number', true);
		if($prev_queue==NULL){	// check the $prev_queue if not null
			$prev_queue=1;
		}else{
			$prev_queue++; // +1 to the existing queue number			
		}	
		// generate random slug
		$string = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$slug = array(); //remember to declare $pass as an array
		$stringLength = strlen($string) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $stringLength);
			$slug[] = $string[$n];
		}
		$random_slug = implode($slug);
		
		// arguments for the entry of queue 
		$add_queue_args = array(
			'post_type' 	=> 	'queue_item',
			'post_status'	=>	'publish',
			'post_title'	=>	$prev_queue,
			'post_name'		=>	$random_slug
		);
		
		$add_queue_result = wp_insert_post($add_queue_args, true);
		// check for the $add_queue_result
		if($add_queue_result){
			$tbl = $wpdb->prefix.'posts'; // prefix for table in wordpress
			// query
			$query_result = $wpdb->get_col(
					"SELECT ID FROM $tbl
					ORDER BY ID DESC
					LIMIT 1"
				);
			// get the latest queue id
			$current_id = $query_result[0];
			$url = get_permalink($current_id).'?cid='.$current_id;
			add_post_meta($current_id,'_cmb_customer_name', $customer_name); // add to customer name in post meta 
			add_post_meta($current_id,'_cmb_customer_age', $customer_age);  // add to customer age in post meta
			add_post_meta($current_id,'_cmb_member', $validate_member); // add to customer member status in post meta
			add_post_meta($current_id,'_cmb_queue_number', $prev_queue); // add new to queue number in post meta
			add_post_meta($current_id,'_cmb_member_url', $url); // add new to queue number in post meta
			// insert queue post to terms
			wp_set_object_terms( $current_id, $station, 'queue_category', false );         
		} 
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $url ) )
		echo $url;
	
	// return proper result
	die();
	}
} 