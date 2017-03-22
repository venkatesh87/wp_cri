<!-- DEMANDE DE PRE-INSCRIPTION -->
<h1>Votre demande de pré-inscription a bien été transmise au CRIDON LYON</h1>
<span>Vous serez prochainement recontacté par le CRIDON LYON pour finaliser votre inscription à la session choisie ci-dessous :</span>
<br /><br /><br />
<i>Formation</i> : <span class="section"><?php echo $name ; ?></span> <br /><br />
<span class="newsletter_date">le <?php echo $date ; ?></span><br/>
<?php if (!empty(trim($organisme))) : ?>
    <span class="introduction">au <?php echo $organisme ; ?></span><br />
<?php endif; ?>
<br />
<i>Nombre de participant(s)</i> : <?php echo $participants ; ?><br />
<!-- Fin -->