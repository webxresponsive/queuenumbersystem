				<?php global $data; ?>
				
				</div> <!--<div class="wrapper">-->
			</main> <!--<div role="main" id="main">-->
		
		<footer id="footer">
		
			<div class="container">
				<div class="row">
					
					<div class="col-md-12 ">
						<p class="copyright text-center">
							<?php echo $data['rsclean_footer_text']; ?>
						</p>
					</div>
					
				</div>
			</div>
			
		</footer>
		
		<?php
			/* Always have wp_footer() just before the closing </body>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to reference JavaScript files.
			 */
			
			wp_footer();
			
			echo $data['rsclean_ga_code'];
		?>
		
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</body>
</html>