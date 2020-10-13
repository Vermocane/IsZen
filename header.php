<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<header id="header">
		<nav id="menu">
			<div id="search"><?php get_search_form(); ?></div>
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>

		<nav role="navigation" id="menu_mobile">
		  <div id="menuToggle">
		    <input type="checkbox" />
	    	<span class="burger"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
   				<rect width="100" height="12" rx="8" fill="#000"></rect>
			</svg></span>
	    	<span class="burger"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
   				<rect width="100" height="12" rx="8" fill="#000"></rect>
			</svg></span>
	    	<span class="burger"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
   				<rect width="100" height="12" rx="8" fill="#000"></rect>
			</svg></span>
			<div class="cont_mob">
				<div class="cont_mob_inner">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
				</div>
			</div>
		  </div>
		</nav>

	</header>
<div id="container">
