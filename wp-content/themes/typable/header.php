<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />

	<!-- media queries -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0" />
	
	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/styles/ie.css" media="screen"/>
	<![endif]-->
	
	<!-- add js class -->
	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>
	
	<!-- load scripts -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header class="header">
		<div class="header-inside clearfix">
			
			<!-- grab the logo and site title -->
			<?php if ( get_theme_mod('okay_theme_customizer_logo') ) { ?>
		    	<h1 class="logo-image">
					<a href="<?php echo home_url( '/' ); ?>"><img class="logo" src="<?php echo '' .get_theme_mod( 'okay_theme_customizer_logo', '' )."\n";?>" alt="<?php the_title(); ?>" /></a>
				</h1>
		    <?php } else { ?>
			    <div class="hgroup animated flipInX">	
			    	<h1 class="logo-text"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a></h1>
			    	<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
			    </div>
		    <?php } ?>
		    
		    <!-- nav icons -->
		    <div class="icon-nav animated flipInX">
				<a class="nav-toggle" href="#"><i class="icon-reorder"></i></a>
		    	<a id="archive-toggle" class="archive-toggle" href="#">
		    		<i class="icon-folder-close"></i>
		    		<i class="icon-folder-open"></i>
		    	</a>
			    <a class="search-toggle" href="#"><i class="icon-search"></i></a>
			    
			    <!-- add widget toggle if there are widgets -->
			    <?php if ( is_active_sidebar(1) ) : ?>
			    	<a class="drawer-toggle" href="#"><i class="icon-list-alt"></i></a>
			    <?php endif; ?>
		    </div>
		    
		    <!-- searchform toggle -->
		    <div id="searchform" class="header-panel">
				<?php get_search_form();?>
			</div>

			<!-- nav menu toggle -->
			<div id="nav-list" class="header-panel">
				<?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'nav')); ?>
			</div>
			
			<!-- latest posts toggle -->
			<div id="archive-list" class="header-panel">
				<ul>
					<?php
						global $post;
						$args = array( 'numberposts' => 10 );
						$archive_posts = get_posts( $args );
						foreach( $archive_posts as $post ) : setup_postdata($post); 
					?>
					
					<li><span><?php echo get_the_date('m.d.y'); ?></span> <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'editor' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
					
					<?php endforeach; wp_reset_postdata(); ?>
				</ul>
			</div>

			<!-- widget toggle -->
			<?php if ( is_active_sidebar(1) ) : ?>
				<div id="widget-drawer" class="header-panel">
					<div class="widget-drawer-wrap">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Widget Drawer') ) : else : ?>		
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
	    </div>
	</header>
	
	<div id="wrapper">
		<div id="main">