<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js ie9"><![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>

	<meta charset="utf-8">

	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php // mobile meta ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="minimum-scale=1.0, width=device-width, user-scalable=no, initial-scale=1.0"/>

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
	<meta name="msapplication-config" content="none"/>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>
	
</head>

<body <?php body_class(); ?>>

	<?php
	/*
	 * Google Analytics
	 * Ne pas déplacer cette ligne.
	 * Ne rien mettre avant
	 */
	echo get_template_part("content","ga");
	?>

	<div id="container">

		<header class="header" role="banner">
			<div class="header-sup">
				<div id="inner-header" class="wrap cf">
					<div class="logo-partenaires">
						<img src="" alt="">
						<img src="" alt="">
					</div>
					<a href="#" class="rechercher">
						<?php _e('Rechercher dans les bases de connaissances'); ?>
					</a>
					<a class="contacter" href="#">
						<?php _e('Contacter'); ?>
					</a>
					<a class="poser-question" href="#">
						<?php _e('Posez une question'); ?>
					</a>
					<a class="acceder-compte desktop js-panel-connexion-open" href="#">
						<?php _e('acceder à mon compte'); ?>
					</a>
				</div>
			</div>

			<div class="header-bottom">
				<div id="inner-header" class="wrap cf">

					<?php if( is_front_page() ) : ?>
						<h1>
							<a href="/" class="lienhome" rel="nofollow"></a> 
						</h1>
						<?php else :?>
						<p id="logo" class="h1">
							<a href="/" class="lienhome" rel="nofollow"></a>
						</p>
					<?php endif; ?>

					<nav role="navigation">
						<?php // nav_principal(); ?>
					</nav>

					<a id="bt-nav-mobile" href="#"></a>
					<div id="bt-account" class="js-panel-connexion-open"></div>
					

				</div>
			</div>

			<div id="panel_connexion" class="js-panel-connexion">
				<div class="fieldset">
					<div id="close" class="js-panel-connexion-close">+</div>
					<div class="titre">connectez-vous</div>
					<p>Accédez à vos informations et bénéficiez d’un contenu personnalisé.</p>
					<?php 
						criSetLoginFormOptions('loginFormId', 'loginFieldId', 'passwordFieldId', 'errorMsgId');

					 ?>
					 <div class="pannel_01 active">
						<form action="header_submit" method="" accept-charset="utf-8" id="loginFormId">
							<input type="text" name="loginFieldId" value="" id="loginFieldId" placeholder="Votre adresse mail">
							<input type="password" name="passwordFieldId" value="" id="passwordFieldId" placeholder="Votre mot de passe">
							<input type="submit" name="submit" value="Connectez-vous">
						</form>
						<a href="#" id="mdp_oublie">> Mot de passe oublié ? <</a>
						<div id="errorMsgId">									
						</div>
					</div>
					
					<div class="pannel_02">
						<form action="" method="" accept-charset="utf-8" id="">
							<input type="text" name="loginFieldId" value="" id="loginFieldId" placeholder="Votre adresse mail">
							<input type="submit" name="submit" value="Mot de passe oublié">						
						</form>
						<a href="#" id="mdp_retour">< Retour </a>
					</div>

					
				</div>
			</div>

		</header>