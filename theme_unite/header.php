<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package unite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header>
		<div class="container header-area">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header col-sm-12" role="banner">

				<div class="site-branding col-md-4 col-sm-4">
					<?php if( get_header_image() != '' ) : ?>

						<div id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
							<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
						</div><!-- end of #logo -->

					<?php endif; // header image was removed ?>

					<?php if( !get_header_image() ) : ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>

					<?php endif; // header image was removed (again) ?>
				</div>

			<div class="social-header col-md-6">
				<?php unite_social_icons(); // Social icons in header ?>
			</div>

			<div class="col-md-3 col-sm-3 col-sm-offset-3 col-md-offset-3">
				<div class="list">
					<!-- Add your phone number here -->
					<div class="headline">
						Beratung und Buchung
					</div>
					<hr />
					<div class="phone">
						schreiben Sie uns, wir rufen Sie zurück:
					</div>
					<hr />
					<!-- Add your email id here -->
					<div class="email">
						<i class="fa fa-envelope-o"></i> <a href="mailto:tk@diereiseagenten.de">tk@diereiseagenten.de</a>
					</div>
					<hr />
					<div class="anfrage">
						<i class="fa fa-edit"></i>
						<a href="anfrage.html"> Angebotsformular</a>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 image hidden-xs">
				<img src="http://diereiseagenten.de/wp-content/uploads/2016/09/sekretaerin.jpg" alt="Kontaktieren Sie uns - wir setzen uns mit Ihnen in Verbindung">
			</div>


		</header><!-- #masthead -->
	</div>
	</header>

		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>

		        </div>

				<?php
		            wp_nav_menu( array(
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'div',
		                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		                'menu_class'        => 'nav navbar-nav',
		                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                'walker'            => new wp_bootstrap_navwalker())
		            );
		        ?>
		    </div>
		</nav><!-- .site-navigation -->

	<div id="content" class="site-content container"><?php
            global $post;
            if( is_singular() && get_post_meta($post->ID, 'site_layout', true) ){
                $layout_class = get_post_meta($post->ID, 'site_layout', true);
            }
            else{
                $layout_class = of_get_option( 'site_layout' );
            }
            ?>
            <div class="row <?php echo $layout_class; ?>">
