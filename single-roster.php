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
				<h1>Pro Roster</h1>
			</div>

			<div class="single-page-roster">

				<p><a href="<?php echo site_url(); ?>/club/pro-roster">&lt; back to full roster</a></p>

				<h3><?php the_title(); ?></h3>

				<?php 
				if (get_the_post_thumbnail()): 
					echo get_the_post_thumbnail();
				else:
					echo '<img src="'. get_template_directory_uri() . '/img/no-img.jpg">';
				endif;
				?>

				<?php if (get_field('player_number')): ?>
					<span class="bignumber">#<?php the_field('player_number'); ?></span>
				<?php elseif (get_field('player_number') == '0'): ?>
					<span class="bignumber">#0</span>
				<?php endif; ?>
				
				<ul class="deets">
					<li><span class="red bold">Date of Birth:</span> <?php the_field('date_of_birth'); ?></li>
					<li><span class="red bold">Hometown:</span> <?php the_field('hometown'); ?></li>					
					<li><span class="red bold">Height:</span> <?php the_field('height'); ?></li>
					<li><span class="red bold">Weight:</span> <?php the_field('weight'); ?></li>
					<li><span class="red bold">Position:</span> <?php the_field('position'); ?></li>
					<li><span class="red bold">Country:</span> <?php the_field('country'); ?></li>
				</ul>
			
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>	
				<?php the_content(); ?>	
				<?php endwhile; ?>

			</div>
			
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