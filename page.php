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
				<h1><?php wp_title(''); ?></h1>
			</div>
			
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>	
			<?php the_content(); ?>	
			<?php endwhile; ?>
			
		</div>

		<?php get_sidebar('page'); ?>

		<div class="clearfix"></div>

		<div class="home-boxes clearfix">
			<?php if (get_field('boxes', 5)) : while (has_sub_field('boxes', 5)): ?>
			<div class="box"><a href="<?php echo get_sub_field('page_link', 5); ?>"><img src="<?php echo get_sub_field('image', 5); ?>" alt=""></a></div>
			<?php endwhile; wp_reset_query(); endif; ?>
		</div>

	</div>
</section>

<?php get_footer(); ?>