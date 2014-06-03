<?php get_header(); ?>
	
<section class="main">
	<div class="wrap clearfix">

		<?php 
		if (get_field('top_block')): 
			the_field('top_block');
		endif;
		?>

		<div class="container left blog">

			<div class="mobile-title center">
				<h2>Arizona United</h2>
				<h1><?php wp_title(''); ?></h1>
			</div>

			<div class="divider"></div>
	
			<?php get_template_part('loop'); ?>
			
			<?php get_template_part('pagination'); ?>
			
		</div>

		<?php get_sidebar(); ?>

		<div class="divider"></div>

		<div class="home-boxes clearfix">
			<?php if (get_field('boxes', 5)) : while (has_sub_field('boxes', 5)): ?>
			<div class="box"><a href="<?php echo get_sub_field('page_link', 5); ?>"><img src="<?php echo get_sub_field('image', 5); ?>" alt=""></a></div>
			<?php endwhile; wp_reset_query(); endif; ?>
		</div>

	</div>
</section>

<?php get_footer(); ?>