<?php
/**
 * Header template for the theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	// Print the <title> tag based on what is being viewed.
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<style>
	
	.popo{position:absolute;opacity:0;visibility:hidden;background:#eee;box-shadow:0 0 6px rgba(0,0,0,0.2) inset;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;}
	
	#popo1{-webkit-animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo2{-webkit-animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;-moz-animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;}
	#popo3{-webkit-animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;-moz-animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;}
	#popo4{-webkit-animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;-moz-animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;}
	#popo5{-webkit-animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;-moz-animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;}
	#popo6{-webkit-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo7{-webkit-animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;-moz-animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;}
	#popo8{-webkit-animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo9{-webkit-animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	
	#popo10{-webkit-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo11{-webkit-animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo12{-webkit-animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo13{-webkit-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo14{-webkit-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo15{-webkit-animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo16{-webkit-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo17{-webkit-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	
	@-webkit-keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;-webkit-transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;-webkit-transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;-webkit-transform:translate(240px,260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;-moz-transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;-moz-transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;-moz-transform:translate(240px,260px) scale(2) rotate(20deg);}
	}
	@keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;transform:translate(240px,260px) scale(2) rotate(20deg);}
	}
	
	@-webkit-keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}
	@keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}
	
	@-webkit-keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}
	@keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}
	
	@-webkit-keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}
	@keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}
	
	@-webkit-keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;-webkit-transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;-webkit-transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(0,-800px) scale(4) rotate(20deg);}
	}
	@-moz-keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;-moz-transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;-moz-transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(0,-800px) scale(4) rotate(20deg);}
	}
	@keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;transform:translate(0,-800px) scale(4) rotate(20deg);}
	}
	
	@-webkit-keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
	@keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
</style>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/*
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div class="bbg"><div id="popo1" class="popo" style="height: 150px; width: 150px;; left:0;top:0;"></div><div id="popo2" class="popo" style="height: 180px; width: 180px; right:0;bottom:0;"></div><div id="popo3" class="popo" style="height: 90px; width: 90px; right:0;top:0;"></div><div id="popo4" class="popo" style="height: 100px; width: 100px; left:0;bottom:0;"></div><div id="popo5" class="popo" style="height: 82px; width: 82px; left:50%;top:50%;"></div><div id="popo6" class="popo" style="height: 140px; width: 140px; left:0;top:50%;"></div><div id="popo7" class="popo" style="height: 94px; width: 94px; right:0;top:50%;"></div><div id="popo8" class="popo" style="height: 120px; width: 120px; left:50%;top:0;"></div><div id="popo9" class="popo" style="height: 174px; width: 174px; left:50%;bottom:0;"></div><div id="popo10" class="popo" style="height: 116px; width: 116px; left:25%;top:25%;"></div><div id="popo11" class="popo" style="height: 140px; width: 140px; left:25%;bottom:25%;"></div><div id="popo12" class="popo" style="height: 160px; width: 160px; right:25%;top:25%;"></div><div id="popo13" class="popo" style="height: 120px; width: 120px; right:25%;bottom:25%;"></div><div id="popo14" class="popo" style="height: 174px; width: 174px; left:25%;top:50%;"></div><div id="popo15" class="popo" style="height: 116px; width: 116px; right:25%;top:50%;"></div><div id="popo16" class="popo" style="height: 140px; width: 140px; left:50%;top:25%;"></div><div id="popo17" class="popo" style="height: 100px; width: 100px; left:50%;bottom:25%;"></div></div>
<script>
var img=new Image();
img.src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/semitransparent/images/comment-bubble-a.png";
</script>
<div id="page" class="hfeed">
	<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<?php
				// Check to see if the header image has been removed
				$header_image = get_header_image();
				if ( $header_image ) :
					// Compatibility with versions of WordPress prior to 3.4.
					if ( function_exists( 'get_custom_header' ) ) {
						/*
						 * We need to figure out what the minimum width should be for our featured image.
						 * This result would be the suggested width if the theme were to implement flexible widths.
						 */
						$header_image_width = get_theme_support( 'custom-header', 'width' );
					} else {
						$header_image_width = HEADER_IMAGE_WIDTH;
					}
					?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					/*
					 * The header image.
					 * Check if this is a post or page, if it has a thumbnail, and if it's a big one
					 */
					if ( is_singular() && has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
							$image[1] >= $header_image_width ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else :
						// Compatibility with versions of WordPress prior to 3.4.
						if ( function_exists( 'get_custom_header' ) ) {
							$header_image_width  = get_custom_header()->width;
							$header_image_height = get_custom_header()->height;
						} else {
							$header_image_width  = HEADER_IMAGE_WIDTH;
							$header_image_height = HEADER_IMAGE_HEIGHT;
						}
						?>
					<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
				<?php endif; // end check for featured image or standard header ?>
			</a>
			<?php endif; // end check for removed header image ?>

			<?php
				// Has the text been hidden?
				if ( 'blank' == get_header_textcolor() ) :
			?>
				<div class="only-search<?php if ( $header_image ) : ?> with-image<?php endif; ?>">
				<?php get_search_form(); ?>
				</div>
			<?php
				else :
			?>
				<?php get_search_form(); ?>
			<?php endif; ?>

			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<?php if ( ! is_singular() ) : ?>
					<div class="skip-link"><a class="assistive-text" href="#secondary"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<?php endif; ?>
				<?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
	</header><!-- #branding -->


	<div id="main">
