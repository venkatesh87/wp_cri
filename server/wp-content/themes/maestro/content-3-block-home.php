<div class="block_03">
	<div class="block consulter layer-posez-question_open js-question-open" >
		<div class="content">
			<h2>
				<?php _e('Consulter'); ?>
				<span><?php _e('un expert juridique'); ?></span>
			</h2>
			<a class="poser-question layer-posez-question_open js-question-open" href="#" >+</a>
		</div>						
	</div>

	<div class="block rechercher js-home-block-link">
		<div class="content">
			<h2>
				<?php _e('Rechercher'); ?>
				<span><?php _e('dans les bases de connaissances'); ?></span> 
			</h2>
			<a href="<?php echo CONST_URL_SINEQUA ?>">+</a>
		</div>						
	</div>

	<div class="block acceder js-home-block-link">
		<div class="content">
			<h2>
				<?php _e('Accéder'); ?>
				<span><?php _e('à ma veille juridique'); ?></span>
			</h2>
			<a href="<?php echo MvcRouter::public_url(array('controller' => 'veilles', 'action'     => 'index')) ?>">+</a>
		</div>						
	</div>
</div>