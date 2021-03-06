<?php criWpPost($object); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
	<!-- POUR LES FORMATIONS LA DATE CORRESPOND A CELLE DU JOUR DE LA FORMATION ET NON A CELLE DE LA CREATION DE LA FORMATION EN BDD -->
	<?php
	if ( !empty($object->__model_name) && $object->__model_name == 'Formation' && !empty($object->custom_post_date) ){
		$current_date = $object->custom_post_date;
	} else {
		if ($current_date != get_the_date('Y-m-d')) {
			$current_date = get_the_date('Y-m-d');
		}
	}
	?>
	<div class="date sel-object-date">
		<span class="jour"><?php echo strftime('%d',strtotime($current_date)) ?></span>
		<span class="mois"><?php echo mb_substr(strftime('%b',strtotime($current_date)),0,4) ?></span>
		<span class="annee"><?php echo strftime('%Y',strtotime($current_date)) ?></span>
	</div>
	<?php if ( !empty($object->__model_name) && $object->__model_name == 'Veille' && !empty($object->level) ){
    	$niveau = 'niveau'.$object->level;
    }
    ?>

	<div class="details <?php if(!empty($niveau)){echo $niveau;} ?>">
		<?php if (isset($object->matiere)) : ?>						
		
		<div class="block_left">
			<div class="img-cat">
				<img class="sel-object-picto" src="<?php echo $object->matiere->picto ?>" alt="<?php echo $object->matiere->label ?>" />
			</div>
		</div>
		<?php endif; ?>

		

		<div class="block_right sel-object-content">
		<?php if (isset($object->matiere)) : ?>						
			<div class="matiere"><?php echo $object->matiere->label ?></div>
		<?php endif; ?>
			<h1 class="entry-title single-title"><?php the_title() ?></h1>
		<?php if (!empty($post->post_excerpt)): ?>
			<div class="chapeau">
				<?php echo get_the_excerpt() ?>
			</div>
		<?php endif; ?>
		</div>
		<div class="block_full">
			
			<div class="content">		
				<?php the_content(); ?>
			</div>
			<?php if (!empty($object->address)) : ?>
                 <div class="adresse">
                    <?php echo nl2br($object->address); ?><br />
                    <?php echo $object->postal_code; ?>
                    <?php echo $object->town; ?>
                 </div>
			<?php endif; ?>
			<ul class="mots_cles">
			<?php 
				$tags = get_the_tags();
				if( $tags ) : foreach ($tags as $tag) :
			 ?>
				<li><?php echo $tag->name; ?></li>
			<?php endforeach; endif; ?>
			</ul>

            <?php
            $class = $object->__model_name;
            ?>
            <?php if (property_exists($object, 'documents') || method_exists($class, "getDocuments")) : ?>
            <?php
            if (property_exists($object, 'documents')){
                $documents = $object->documents;
            }else{
                $documents = $class::getDocuments($object);
            }
                if (! empty($documents)) :
            ?>
			<div class="documents-liees">
				<ul>

                    <?php foreach ($documents as $index => $document) : ?>
                        <?php
                        $options = array(
                            'controller' => 'documents',
                            'action'     => 'download',
                            'id'         => $document->id
                        );
                        $publicUrl  = MvcRouter::public_url($options);
                        ?>
                        <li><a href="<?php echo $publicUrl ; ?>" target="_blank"><?php echo $document->name ; ?></a></li>
                    <?php endforeach; ?>
				</ul>
			</div>
                <?php endif; ?>


            <?php endif; ?>
			
		</div>

		
	</div>

 	

    	
  	

</article>
