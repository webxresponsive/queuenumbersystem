<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Queue Number
 * 
 */

get_header(); 

if($_GET['c']){
	// get the content counter template
	get_template_part( 'content', 'counter' );

	}else{
	// get the content ticket template
	get_template_part( 'content', 'ticket' );
} 

get_footer(); ?>