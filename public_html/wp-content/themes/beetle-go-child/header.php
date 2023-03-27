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
	
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-43238584-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments)};
		  gtag('js', new Date());

		  gtag('config', 'UA-43238584-1');
		</script>

		<script type="text/javascript"> _linkedin_data_partner_id = "89341"; </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=89341&fmt=gif" /> </noscript>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="p:domain_verify" content="5c0b5403fb4b49a4ad751545163a7299"/>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!-- Favicon and iOS icons -->
		<?php if ( isset( $mokaine['custom-favicon']['url'] ) && $mokaine['custom-favicon']['url'] != '' ) : ?>
		<link rel="shortcut icon" href="<?php echo $mokaine['custom-favicon']['url']; ?>" />
		<?php endif; ?>
		
		<!-- Font Awesome 5 -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


		<?php wp_head(); ?>	

	</head>

	<body <?php body_class( $extra_body_class ); ?>>
	

		<header id="masthead" class="site-header <?php echo $header_class; ?>" role="banner">
			
			<!-- Notificação no Cabeçalho -->

			<!-- <div class="row" style="background: #0077B5; margin-top: -12px;">
				<h5 style="text-align: center; margin: 4px; color: white; padding: 9px;">
					<a style="color: white;" target="_blank" href="http://www.bistec.com.br/20-anos-bistec/"> 
						Participe da campanha #20AnosBistec e ganhe isenção no valor do seu contrato. Saiba Mais.
					</a>
				</h5>
			</div> -->

			<!-- Fim da Notificação no Cabeçalho -->

			<div class="row">

				<div class="nav-inner row-content buffer-left buffer-right even clear-after">

					<div id="brand" class="site-branding">

						<h1 class="site-title reset">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">

								<?php // bloginfo( 'name' ); ?>
								<img src="http://www.bistec.com.br/wp-content/uploads/2018/06/header-logo-bistec.png" alt="Logo Bistec" />
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