<?php /* Template Name: Home */ get_header(); ?>
	
<section class="main">
	<div class="wrap clearfix">
		
		<div class="home-boxes clearfix">
			<?php if (get_field('boxes')) : while (has_sub_field('boxes')): ?>
			<div class="box"><a href="<?php echo get_sub_field('page_link'); ?>"><img src="<?php echo get_sub_field('image'); ?>" alt=""></a></div>
			<?php endwhile; wp_reset_query(); endif; ?>
		</div>

		<div class="container left">
				
			<article class="featured-video">
				<h2>Arizona United Featured Video</h2>

				<div class="video-wrapper"><?php echo do_shortcode('[featured_video]'); ?></div> 
				<!--<p><a href="" class="btn red">See All Videos</a></p>-->
			</article>

			<div class="divider"></div>

			<h2>Arizona United Press Releases</h2>

			<?php query_posts(array('category_name' => 'Featured', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC')); 
			if (have_posts()) : while(have_posts()) : the_post();
			?>
			<article class="press-releases">
				<h3><?php the_title(); ?></h3>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; wp_reset_query(); endif; ?>
			<p><a href="<?php echo site_url(); ?>/category/press-releases/" class="btn red">See additional press releases</a></p>
		</div>

		<?php get_sidebar('page'); ?>

	</div>
</section>

<?php get_footer(); ?>