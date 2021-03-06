<?php if (!empty($message)) : ?>
	<div class="message-erreur"><?php echo $message ?></div>
<?php endif; ?>
<div class="mes-informations" id="sel-compte-profil">

	<h2><?php _e('Mes informations'); ?></h2>

	<div class="img-profil">
	</div>
	
	<div class="coordonnees">
		<div class="etude">
			<div class="nom">
				<span><?php echo $notaire->etude->office_name ?></span>
			</div>

			<div class="adresse">
                <?php if (!empty($notaire->etude->adress_1)): ?>
				<span><?php echo $notaire->etude->adress_1 ?></span>
                <?php endif; ?>
				<?php if (!empty($notaire->etude->adress_2)): ?>
					<span><?php echo $notaire->etude->adress_2 ?></span>
				<?php endif ?>
				<?php if (!empty($notaire->etude->adress_3)): ?>
					<span><?php echo $notaire->etude->adress_3 ?></span>
				<?php endif ?>				
				<span><?php echo $notaire->etude->cp.' '.$notaire->etude->city ?></span>
			</div>

			<div class="mail">
				<span id="sel-compte-mail"><?php echo $notaire->etude->office_email_adress_1 ?></span>
			</div>

            <?php if (!empty($notaire->etude->tel) || !empty($notaire->etude->fax)): ?>

			<div class="contact">

                <?php if (!empty($notaire->etude->tel) && preg_match("/\+?\d{6,}/", $notaire->etude->tel) ): ?>
				<span>Tel <a href="tel:<?php echo $notaire->etude->tel ?>"><?php echo $notaire->etude->tel ?></a></span>
                <?php endif; ?>

                <?php if (!empty($notaire->etude->fax) && preg_match("/\+?\d{6,}/", $notaire->etude->fax)): ?>
				<span>Fax <a href="tel:<?php echo $notaire->etude->fax ?>"><?php echo $notaire->etude->fax ?></a></span>
                <?php endif; ?>
			</div>

            <?php endif; ?>

			<?php if (CriCanAccessSensitiveInfo(CONST_MODIFYOFFICE_ROLE)) : ?>
                <div class="update update-etude js-account-profil-office-modify"
                data-js-ajax-modify-office-url="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'gestionetude')); ?>">
                <?php _e('Modifier les informations de l\'étude'); ?></div>
            <?php endif; ?>
		</div>
		<div class="notaire">
			<div class="nom">
				<span><?php echo $notaire->last_name ?> <s><?php echo $notaire->first_name ?></s></span>
			</div>
            <?php if (
                    !empty($notaire->adress_1) ||
                    !empty($notaire->adress_2) ||
                    !empty($notaire->adress_3) ||
                    !empty($notaire->cp) ||
                    !empty($notaire->city)): ?>
			<div class="adresse">

                <?php if (!empty($notaire->adress_1)): ?>
                    <span><?php echo $notaire->adress_1 ?></span>
                <?php endif; ?>
                <?php if (!empty($notaire->adress_2)): ?>
                    <span><?php echo $notaire->adress_2 ?></span>
                <?php endif ?>
                <?php if (!empty($notaire->adress_3)): ?>
                    <span><?php echo $notaire->adress_3 ?></span>
                <?php endif ?>
                    <span>
                        <?php echo (!empty($notaire->cp)) ? $notaire->cp : "" ; ?> - <?php echo (!empty($notaire->city)) ? $notaire->city : "" ; ?>
                    </span>
			</div>
            <?php endif;  ?>
			<div class="mail">
				<span id="sel-compte-mail"><?php echo $notaire->email_adress ?></span>
			</div>
			<div class="contact">
				<?php if (!empty($notaire->tel_portable) && preg_match("/\+?\d{6,}/", $notaire->tel_portable)): ?>
					<span>Mob  <a href="tel:<?php echo $notaire->tel_portable ?>"><?php echo $notaire->tel_portable ?></a></span>
				<?php endif ?>
				<?php if (!empty($notaire->tel) && preg_match("/\+?\d{6,}/", $notaire->tel)): ?>
				<span>Tel <a href="tel:<?php echo $notaire->tel ?>"><?php echo $notaire->tel ?></a></span>
				<?php endif ?>
				<?php if (!empty($notaire->fax) && preg_match("/\+?\d{6,}/", $notaire->fax)): ?>
					<span>Fax <?php echo $notaire->fax ?></span>
				<?php endif ?>
			</div>

			<div class="update update-profil js-account-profil-modify"
				 data-js-ajax-id="<?php echo $notaire->id; ?>"
				 data-js-ajax-modify-url="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'gestioncollaborateur')); ?>">
				<?php _e('Modifier mes informations'); ?></div>

            <br/>
			<div class="update update-mdp js-account-profil-password"><?php _e('Modifier mon mot de passe'); ?></div>

		</div>

	</div>
</div>


<div class="cridonline-offres">
	<h2><?php _e('Mon abonnement Crid\'online'); ?></h2>
	<div class="description">
			Choisissez le niveau de service qui correspond le mieux à votre organisation, vos besoins, vos objectifs. Il est de toute manière totalement complémentaire aux autres services assurés par votre CRIDON LYON.
	</div>
	
	<?php set_query_var( 'notaire', $notaire ); ?>
	<?php set_query_var( 'priceVeilleLevel2', $priceVeilleLevel2 ); ?>
	<?php set_query_var( 'priceVeilleLevel3', $priceVeilleLevel3 ); ?>
	<?php set_query_var( 'subscription', false ); ?>
	
	<?php if (!isPromoActive()) : ?>		
		<?php echo get_template_part("content","cridonline-offres"); ?>
	<?php else : ?>	
		<?php echo get_template_part("content","cridonline-offres-promo"); ?>
	<?php endif; ?>
</div>




<div class="mes-centres-dinterets">

	<h2><?php _e('Mes centres d\'intérêts'); ?></h2>

	<div class="description">
		Le notaire ou le collaborateur est invité à signaler la ou les thématiques juridiques pour lesquelles il souhaite recevoir automatiquement des veilles et informations prioritaires.
	</div>
	<form method="post" action="<?php echo mvc_public_url(array('controller' => 'notaires', 'action' => 'profil')); ?>" class="form-centre-interet">
		<ul>
			<?php foreach($matieres as $key => $matiere): ?>
			<li>
				<label class="<?php echo ($matiere['subscribed']) ? ' select ' : ' unselect ' ?> js-account-profil-subscription-button">
					<input type="checkbox" id="" class=" js-account-profil-subscription" name="matieres[]" value="<?php echo $key ?>" <?php echo ($matiere['subscribed']) ? 'checked="checked"' : '' ?>>
					<?php echo $matiere['name'] ?>
				</label>
			</li>
			<?php endforeach; ?>
		</ul>
		<input type="submit" name="Valider" value="Enregistrer" />
	</form>
</div>

<!--<div class="newsletter">

	<h2><?php /*_e('Ma newsletter'); */?></h2>
        <div class="description">
            <?php /*if ($notaire->newsletter == 0 ):*/?>
                <script type="text/javascript">
                //<![CDATA[
                	jsvar.newsletter_success_msg = "Inscription terminée avec succès.";
                //]]>
                </script>
            <?php /*_e('Vous n\'êtes pas inscrit à notre newsletter.'); */?>
            <?php /*else : */?>
                <script type="text/javascript">
                    //<![CDATA[
                    jsvar.newsletter_success_msg = "Désinscription terminée avec succès.";
                    //]]>
                </script>
            <?php /*_e('Vous êtes inscrit à notre newsletter selon vos centres d\'intérêts.'); */?>
            <?php /*endif; */?>
        </div>
        <form method="post" accept-charset="utf-8" id="newsletterFormId1" class="form-newsletter js-account-profil-newsletter-form" data-js-ajax-newsletter-url="<?php /*echo mvc_public_url(array('controller' => 'notaires','action' =>'souscriptionnewsletter'));*/?>">
            <input type="hidden" name="userEmail" value="<?php /*echo $notaire->email_adress */?>" class="js-account-profil-newsletter-email" id="userEmail" placeholder="<?php /*_e('Votre adresse email'); */?>">
            <input type="hidden" name="state" value="<?php /*echo $notaire->newsletter == 1 ? "0" : "1"; */?>" class="js-account-profil-newsletter-state">
            <input type="submit" name="submit" value="<?php /*_e( ($notaire->newsletter == 0 ? "S'inscrire" : "Me désinscrire" ) ); */?>">
        </form>
        <div id="newsletterMsgId" class="js-account-profil-newsletter-message">
        </div>

</div>-->

<div class="update-etude">
    <div id="layer-update-etude" class="popup">
    </div>
</div>
<div class="update-profil">
    <div id="layer-update-profil" class="popup">
	</div>
</div>
<div class="update-mdp">
    <?php echo get_template_part("content","update-mdp-popup"); ?>
</div>
