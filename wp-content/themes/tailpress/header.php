<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<div class="main_wapper">

	<?php do_action( 'tailpress_header' ); ?>
	<div class="header">
		<div class="header_wapper">
			<div class="flex w-full px-5 py-3">
				<div class="logo"><a href="<?php echo get_bloginfo( 'url' ); ?>"><img src="<?php echo get_field('header_logo','option')?>" alt=""></a></div>
				<div class="navigation_menu">
					<?php
					wp_nav_menu(
						array(
							'container' => false,
							'theme_location'  => 'primary',
							'fallback_cb'     => false,
						)
					);
					if(get_field('tickets_button_text','option'))
					{
						?>
						<a href="<?php echo get_field('tickets_button_link','option');?>" class="ticket-btn"><?php echo get_field('tickets_button_text','option');?></a>
						<?php
					}
					?>
					
				</div>
			</div>
		</div>
	</div>
	<?php do_action( 'tailpress_content_start' ); ?>
