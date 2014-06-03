<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	
		<?php if ( has_post_thumbnail()) : ?>
				<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		
		<span class="date">Posted on <?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?> <?php _e( 'by', 'html5blank' ); ?> <?php the_author(); ?></span>

		
		<?php html5wp_excerpt(140); ?>
		
		
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