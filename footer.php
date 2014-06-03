<footer>
	<div class="main-sponsors">
		<div class="clearfix">
			<ul>
				<?php if (get_field('sponsors', 'options')) : while (has_sub_field('sponsors', 'options')): ?>
					<li><a href="<?php the_sub_field('sponsor_link', 'options'); ?>" target="_blank"><img src="<?php the_sub_field('logo', 'options'); ?>" alt=""></a></li>
				<?php endwhile; wp_reset_query(); endif; ?>
			</ul>
		</div>
	</div>

	<div class="connect">
		<div class="wrap clearfix">
			<div class="left forty8">
				<?php echo do_shortcode('[contact-form-7 id="339" title="Newsletter"]'); ?>
			</div>
			<div class="right forty8 clearfix">
				<i class="twitter-icon left"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter-icon.png" alt=""></i> 
				<div class="tweet right"><?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?></div>
			</div>
		</div>
	</div>
	<div class="divider"></div>
	<div class="links">
		<div class="wrap clearfix">
			<div class="boxes">
				<?php wp_nav_menu(array('menu' => 'Footer', 'depth' => 1)); ?>
			</div>
			<div class="boxes">
				<ul>
					<li>Get Social With Us</li>
					<li class="social-links">
						<?php if (get_field('facebook_url', 'options')): ?>
							<a href="<?php the_field('facebook_url', 'options'); ?>" class="icon fb" target="_blank">Facebook</a>
						<?php endif; ?>
						<?php if (get_field('youtube_url', 'options')): ?>
							<a href="<?php the_field('youtube_url', 'options'); ?>" class="icon yt" target="_blank">YouTube</a>
						<?php endif; ?>
						<?php if (get_field('twitter_url', 'options')): ?>
							<a href="<?php the_field('twitter_url', 'options'); ?>" class="icon tw" target="_blank">Twitter</a>
						<?php endif; ?>
						<?php if (get_field('google_plus_url', 'options')): ?>
							<a href="<?php the_field('google_plus_url', 'options'); ?>" target="_blank" class="icon go">Google+</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
			<div class="boxes">
				<ul>
					<li>Keep In Touch</li>
					<li class="address">
						<?php the_field('address', 'options'); ?>
					</li>
				</ul>
			</div>
			<div class="boxes"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/img/uslpr.jpg" alt=""></a></div>
		</div>
	</div>
	<div class="divider"></div>
	<div class="copyright">
		<div class="wrap clearfix">
			<p class="center">&copy; 2014 Arizona United SC. All Rights Reserved.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
	
</body>
</html>