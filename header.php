<!doctype html>
<html <?php language_attributes(); ?> class="no-js" style="margin-top:0px;">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<!-- dns prefetch -->
<link href="//www.google-analytics.com" rel="dns-prefetch">

<!-- meta -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- icons -->
<link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
	
<!-- css + javascript -->
<?php wp_head(); ?>
<script>
!function(){
	// configure legacy, retina, touch requirements @ conditionizr.com
	conditionizr();
}()
</script>
<?php if (is_front_page()): 
else: ?>
<script>
$(document).ready(function() {
	$('body').addClass('internal');
});
</script>
<?php endif; ?>
<script>
$(document).ready(function() {
	var template = '<?= get_bloginfo("template_url"); ?>';
	var uri = '<? echo site_url(); ?>';
	contactForm(template, uri);
});
</script>
</head>
<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=440111889375432";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="desktop-iframe iframe-wrapper"><iframe src="http://twinportsweb.com/usl_bar/index.cfm?team=AZU" height="52" width="100%" frameborder="0"></iframe></div>

<header class="desktop relative">
	<div class="wrap clearfix relative">
	
		<a href="<?php echo site_url(); ?>" class="logo left"><img src="<?php echo get_template_directory_uri(); ?>/img/az-logo.png" alt=""></a>

		<nav class="clearfix">
			<ul class="socials">
				<?php if (get_field('facebook_url', 'options')): ?>
					<li><a href="<?php the_field('facebook_url', 'options'); ?>" class="icon fb" target="_blank">Facebook</a></li>
				<?php endif; ?>
				<?php if (get_field('youtube_url', 'options')): ?>
					<li><a href="<?php the_field('youtube_url', 'options'); ?>" class="icon yt" target="_blank">YouTube</a></li>
				<?php endif; ?>
				<?php if (get_field('twitter_url', 'options')): ?>
					<li><a href="<?php the_field('twitter_url', 'options'); ?>" class="icon tw" target="_blank">Twitter</a></li>
				<?php endif; ?>
				<?php if (get_field('google_plus_url', 'options')): ?>
					<li><a href="<?php the_field('google_plus_url', 'options'); ?>" target="_blank" class="icon go">Google+</a></li>
				<?php endif; ?>
				<li><a href="https://twitter.com/intent/user?screen_name=AZUnitedSC" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/follow-tw.jpg" class="followme" alt=""></a></li>
			</ul>
			<?php wp_nav_menu(array('menu' => 'Main')); ?>

			<div class="clearfix"></div>
		</nav>
	</div>
</header>

<div class="splash">

	<?php if (is_front_page()): ?>
		<div class="block center splashguy"><img src="<?php the_field('splash', 5); ?>" alt=""></div>
	<?php else: ?>
		<div class="wrap clearfix">
			<div class="title">
			<h2>Arizona United</h2>

			<?php if (is_404()): ?>
				<h1>Error 404</h1>
			<?php elseif (get_post_type() == 'roster'): ?>
				<h1>Pro Roster</h1>
			<?php elseif (is_single()): ?>
				<h1>News</h1>
			<?php else: ?>
				<h1><?php wp_title(''); ?></h1>
			<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<header class="mobile">
	<iframe src="http://www.twinportsweb.com/usl_bar/index.cfm?team=HARR" height="52" width="100%" frameborder="0"></iframe>
	<a href="<?php echo site_url(); ?>" class="left logoish"><img src="<?php echo get_template_directory_uri(); ?>/img/mobile-logo.png" alt=""></a>
	<a href="" class="mobile-menu-btn right"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-mobile-menu.png" width="20" height="20" alt=""></a>
</header>

<nav class="mobile-nav">
	<?php wp_nav_menu(array('menu' => 'Main')); ?>
</nav>