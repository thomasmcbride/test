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
			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
				
					<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail(); ?>
					<?php endif; ?>
					
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					
					<span class="date">Posted on <?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?> <?php _e( 'by', 'html5blank' ); ?> <?php the_author(); ?></span>

					
					<?php the_content(); ?>
					
					
				</article>
				<!-- /article -->
				
			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</article>
				<!-- /article -->

			<?php endif; ?>
			
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