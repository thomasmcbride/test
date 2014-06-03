<?php get_header(); ?>
	
<section class="main">
	<div class="wrap clearfix">

		<?php 
		if (get_field('top_block')): 
			the_field('top_block');
		endif;
		?>

		<div class="container left">

			<div class="mobile-title center">
				<h2>Arizona United</h2>
				<h1>Error 404</h1>
			</div>

			<h2>Page Not Found</h2>
			
			<p>We're very sorry, but the page you are trying to reach has not been found. Try checking the URL for errors, then hit the refresh button on your browser, or click <a href="<?php echo site_url(); ?>">here</a> to go back to the homepage.</p>
			
		</div>

		<?php get_sidebar('page'); ?>

		<div class="divider"></div>

		<div class="home-boxes clearfix">
			<?php if (get_field('boxes', 5)) : while (has_sub_field('boxes', 5)): ?>
			<div class="box"><a href="<?php echo get_sub_field('page_link', 5); ?>"><img src="<?php echo get_sub_field('image', 5); ?>" alt=""></a></div>
			<?php endwhile; wp_reset_query(); endif; ?>
		</div>

	</div>
</section>

<?php get_footer(); ?>