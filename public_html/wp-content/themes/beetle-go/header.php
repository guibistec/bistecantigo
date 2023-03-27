<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<?php
		global $mokaine, $intro_meta, $intro_featured;

		$page_id = ( is_home() ) ? get_option( 'page_for_posts' ) : get_the_ID();

		$intro_meta = get_post_meta( $page_id, '_mokaine_select_intro_parse', true );
		$intro_featured = get_post_meta( $page_id, '_mokaine_set_featured_as_intro', true );

		$header_layout = $mokaine['header-style'];
		$parallax = $mokaine['parallax'];

		// Reset vars
		$header_class = $extra_body_class = '';

		// Cases
		if ( $header_layout == "header-2" ) {
			$header_class = ' transparent';
		} else if ( $header_layout == "header-1" ) {
			$header_class = ' transparent light';
		}

		if ( ( $intro_meta && ( is_page() || is_home() ) ) || ( $intro_featured && is_single() ) ) {
			$extra_body_class = ' has-intro';
		} else {
			$extra_body_class = ' no-intro';
			$header_class = ' fixed-header';				
		}

		if ( $parallax == false ) {
			$extra_body_class = ' no-parallax';
			$header_class = ' fixed-header';		
		}
		?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!-- Favicon and iOS icons -->
		<?php if ( isset( $mokaine['custom-favicon']['url'] ) && $mokaine['custom-favicon']['url'] != '' ) : ?>
		<link rel="shortcut icon" href="<?php echo $mokaine['custom-favicon']['url']; ?>" />
		<?php endif; ?>

		<?php wp_head(); ?>	

	</head>

	<body <?php body_class( $extra_body_class ); ?>>
	

		<header id="masthead" class="site-header <?php echo $header_class; ?>" role="banner">

			<div class="row">

				<div class="nav-inner row-content buffer-left buffer-right even clear-after">

					<div id="brand" class="site-branding">

						<h1 class="site-title reset">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

								<?php bloginfo( 'name' ); ?>

							</a>

						</h1>
					
					</div><!-- brand -->

					<a id="menu-toggle" href="#"><i class="icon-bars icon-lg"></i></a>

					<nav id="site-navigation" role="navigation">

						<?php if( has_nav_menu( 'primary' ) ) : ?>

							<?php wp_nav_menu( array( 'walker' => new beetle_walker_menu, 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'reset' ) ); ?>

						<?php else : ?>

							<?php echo '<ul class="reset"><li><a href="'. admin_url( 'nav-menus.php' ) .'">' . __( 'No menu assigned', MOKAINE_THEME_NAME ) . '</a></li></ul>'; ?>

						<?php endif; ?>
					
					</nav>

				</div><!-- row-content -->	

			</div><!-- row -->	

		</header>

		<main class="site-main" role="main">

			<?php if ( is_single() || is_page() || is_home() ) : ?>

				<?php get_template_part( 'section', 'intro' ); ?>

			<?php endif; ?>

			<div id="main">