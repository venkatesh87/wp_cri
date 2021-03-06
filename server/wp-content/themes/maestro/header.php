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
<?php
    $bodyClass = array();
    if (CriIsNotaire()) {
        $bodyClass[] = "is_notaire";
    }
	if (CriCanAccessSensitiveInfo(CONST_QUESTIONECRITES_ROLE)) {
		$bodyClass[] = "has_question_role";
	}
?>
<body <?php body_class($bodyClass); ?>>
<?php
/*
 * Google Analytics
 * Ne pas déplacer cette ligne.
 * Ne rien mettre avant
 */
echo get_template_part("content","ga");
?>


	<div id="container">
		<div id="posez-questions">
			<?php echo get_template_part("content","posez-question"); ?>
		</div>

		<header class="header" role="banner" id="sel-header">
			<div class="header-sup">
				<div id="inner-header" class="wrap cf">
					<!-- <div class="logo-partenaires">
						
					</div> -->
					<ul id="rechercher">
						<li>
							<a href="#">
								<?php _e('Rechercher dans les bases de connaissances'); ?>
							</a>
							<ul class="overlay">
								<li>
									<?php
									list($access, $url) = CridonlineAutologinLink();
									?>
									<a href="<?php echo $url ?>"
									   class="js-cridonline-link"
									   data-js-cridonline-access="<?php echo $access ?>"
									   data-js-redirect="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'show')) . '?error=FONCTION_NON_AUTORISE'; ?>"
									>
										<?php _e('Bases CRID’'); ?><span><?php _e('ONLINE'); ?></span>
									</a>
								</li>
								<li>
									<a href="<?php echo CONST_URL_SINEQUA ?>"  >
										<?php _e('Bases CRIDON'); ?> <span><?php _e('LYON'); ?></span> 
									</a>
								</li>
								<li>
									<a href="http://cridon.notaires.fr/" title="Accès avec votre clé Real">
										<?php _e('Portail des 5 CRIDON'); ?>
									</a>
								</li>								
								<?php if (!isPromoActive()) : ?>
									<li> 
										<a href="<?php echo CONST_URL_INFO_PAGE_CRIDONLINE ?>" title="Décourvrir l’offre CRID’ONLINE +">
											<?php _e('Décourvrir l’offre CRID’ONLINE +'); ?>
										</a>
									</li>
								<?php else : ?>
									<li>
										<a href="<?php echo CONST_URL_INFO_PAGE_CRIDONLINE_promo ?>" title="Décourvrir l’offre CRID’ONLINE +">
											<?php _e('Décourvrir l’offre CRID’ONLINE +'); ?>
										</a>
									</li>
								<?php endif ?>
							</ul>
						</li>
					</ul>
					<!-- <a class="contacter" href="#">
						<?php // _e('Contacter'); ?>
					</a> -->
					<a
						class="poser-question layer-posez-question_open js-question-open analytics_Poser_question"
						data-js-redirect="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'show')) . '?error=FONCTION_NON_AUTORISE'; ?>"
						href="#"
					>

						<?php _e('Poser une question'); ?>
					</a>
					<?php if (!is_user_logged_in() || (is_user_logged_in() && !CriIsNotaire() ) ) : ?>
						<ul id="acceder-compte">
							<li>
								<a class="acceder-compte desktop js-panel-connexion-open sel-open-onglet-connexion" href="#">
									<?php _e('acceder à mon compte'); ?>
								</a>

							</li>
						</ul>
					<?php else: ?>
						<ul id="acceder-compte">
							<li>
								<a class="acceder-compte desktop js-panel-connexion-open sel-open-onglet-connexion" href="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'show')); ?>">
									<?php _e('acceder à mon compte'); ?>
								</a>
								<ul class="logout-2">
									<li>
										<a href="/wp-login.php?action=logout" >
											<?php _e('Se déconnecter'); ?>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					<?php endif; ?>
				</div>
			</div>

			<div class="header-bottom">
				<div id="inner-header" class="wrap cf">

					<?php if( is_front_page() ) : ?>
						<h1>
							<a href="/" class="lienhome" rel="nofollow" title="CRIDON Lyon : aide juridique pour les notaires"></a> 
						</h1>
						<?php else :?>
						<p id="logo" class="h1">
							<a href="/" class="lienhome" rel="nofollow"></a>
						</p>
					<?php endif; ?>

					<nav id="menu" role="navigation">
						<?php // nav_principal(); ?>

						<?php echo get_template_part("content","menu"); ?>



					</nav>

					<a id="bt-nav-mobile" href="#menu_mobile"></a>
					<?php if (!is_user_logged_in() || (is_user_logged_in() && !CriIsNotaire() ) ) : ?>
						<div id="bt-account" class="js-panel-connexion-open sel-open-onglet-connexion"></div>
					<?php else: ?>
						<a id="bt-account" class="sel-open-onglet-connexion" href="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'show')); ?>" ></a>
					<?php endif; ?>

				</div>
			</div>
			<?php if (!is_user_logged_in() || (is_user_logged_in() && !CriIsNotaire() ) ) : ?>
				
				
				<div id="panel_connexion" class="js-panel-connexion">
					<div class="fieldset">
						<div id="close" class="js-panel-connexion-close">+</div>
						<div class="titre">connectez-vous</div>
						<p>Accédez à vos informations et bénéficiez d’un contenu personnalisé.</p>
						 <div class="pannel_01 js-panel-connexion-connexion-form">
							<form action="header_submit" method="" accept-charset="utf-8" id="loginFormId">
								<input type="text" class="js-panel-connexion-reset-error js-login-login-field" name="loginFieldId" value="" id="loginFieldId" placeholder="Votre CRPCEN">
								<input type="password" class="js-panel-connexion-reset-error js-login-password-field" name="passwordFieldId" value="" id="passwordFieldId" placeholder="Votre mot de passe">
								<input type="submit" name="submit" value="Connectez-vous">
							</form>
							<a href="#" id="mdp_oublie" class="js-panel-connexion-to-mdp">> Mot de passe oublié ? <</a>
							<div id="errorMsgId" class="js-login-error-message-block">
							</div>
						<?php 
							criSetLoginFormOptions('loginFormId', 'loginFieldId', 'passwordFieldId', 'errorMsgId');

						 ?>
						</div>
						
						<div class="pannel_02 js-panel-connexion-mdp-form">
							<form action="" method="" accept-charset="utf-8" id="lostPwdFormId">
								<input type="text" class="js-panel-connexion-reset-error js-password-mail-field" name="emailFieldId" value="" id="emailFieldId" placeholder="Votre adresse mail">
								<input type="text" class="js-panel-connexion-reset-error js-password-crpcen-field" name="crpcenFieldId" value="" id="crpcenFieldId" placeholder="Votre CRPCEN">
								<input type="submit" name="submit" value="Récupérer mon mot de passe">						
							</form>
							<a href="#" id="mdp_retour" class="js-panel-connexion-to-connexion">< Retour </a>
							<div id="errorMsgForgotId" class="js-forgot-error-message-block">
							</div>
							<?php criSetLostPwdOptions('lostPwdFormId', 'emailFieldId', 'crpcenFieldId', 'errorMsgForgotId'); ?>
						</div>

						
					</div>
				</div>
			<?php endif ?>
			
			
		</header>
