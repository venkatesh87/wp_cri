<!-- @todo à styler -->

<br>
<br>
<!-- Nom du lieu - ex : Chambre départementale des notaires de la région de la france de la terre -->
<?php if ($lieu): ?>
    <p><?php echo $lieu->name ?></p>
<?php endif; ?>

<!-- Contact : tel + email -- Visible uniquement si notaire connecté + chambre dont il dépends -->
<?php if ($contact_lieu): ?>
    <p><?php echo $lieu->phone_number ?></p>
    <p><?php echo $lieu->email ?></p>
<?php endif; ?>

<!-- Bouton CTA : "Contacter le cridon lyon" si notaire + chambre dont il ne dépends pas ; "Se pré-inscrire" si le lieu est le cridon et le notaire connecté -->
<?php if (!empty($session['action']) && !empty($session['action_label'])): ?>
    <a href="<?php echo $session['action'] ?>"><?php echo $session['action_label'] ?></a>
<?php endif; ?>
