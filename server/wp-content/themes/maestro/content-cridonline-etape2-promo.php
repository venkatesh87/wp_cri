<h2><?php _e("Souscription à l'offre Crid'online"); ?></h2>

<div id="layer-cridonline" class="popup" style="display:none;">
</div>
<div class="message-offre">
    Vous avez choisi l'offre CRID'ONLINE <?php echo ($level == 2) ? CONST_CRIDONLINE_LABEL_LEVEL_2 : CONST_CRIDONLINE_LABEL_LEVEL_3 ?> pour <strong><?php echo $price ?> € HT</strong> par an.<br />
    Afin de procéder au règlement par prélèvement SEPA, vous allez pouvoir télécharger le document ci-après :
</div>

<div class="bloc-souscription">
    <form method="post" accept-charset="utf-8" class="form-sublevel js-account-cridonline-validation-form" data-js-ajax-souscription-url="<?php echo mvc_public_url(array('controller' => 'notaires','action' =>'souscriptionveillepromo'));?>">
        <label for="label_radio_B2B" class="radio select js-account-cridonline-validation-radio">
            <input id="label_radio_B2B" type="radio" name="B2B_B2C" value="B2B" class="js-account-cridonline-validation-b2b" checked>
            <span>J'exerce en tant que personne morale</span>
        </label>
        <label for="label_radio_B2C" class="radio marge unselect js-account-cridonline-validation-radio">
            <input id="label_radio_B2C" type="radio" name="B2B_B2C" value="B2C" class="js-account-cridonline-validation-b2c">
            <span>J'exerce en tant que personne physique/indépendant</span>
        </label>

        <label class="unselect js-account-cridonline-validation-checkbox cguv">
            <input type="checkbox" name="CGV" class="js-account-cridonline-validation-cgv" value="value">
            <span><?php _e("J'ai lu, j'ai compris et j'accepte les CGUV"); ?></span>
        </label>
        <a href="<?php echo CONST_CRIDONLINE_DOCUMENT_CGUV_PATH ?>" title="CGV" target="_blank"><?php _e("Télécharger les conditions générales de vente (CGUV)"); ?></a>
        <input type="hidden" name="level" value="<?php echo $level; ?>" class="js-account-cridonline-validation-level">
        <input type="hidden" name="promo" value="<?php echo $promo ?>"  class="js-account-cridonline-validation-promo">
        <input type="submit" name="submit" value="<?php _e("souscrire"); ?>">

        <div class="message-erreur js-account-cridonline-validation-message">
        </div>

    </form>
</div>
