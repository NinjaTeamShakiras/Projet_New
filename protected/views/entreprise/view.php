<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */


if ( $model->id_entreprise == $this->get_id_utilisateur_connexion(Yii::app()->user->getId()) )
{
	$this->menu=array(
		array('label'=>'Mettre à jour mon profil', 'url'=>array('update', 'id'=>$model->id_entreprise)),
	);
}
?>

<?php 	/*		On affiche un message en fonction si c'est le profil de l'utilisteur qui est connecté ou pas 	*/
		if ( $model->id_entreprise == $this->get_id_utilisateur_connexion(Yii::app()->user->getId()) ) : ?>
			<h1>Votre espace personnel :</h1>
<?php  	else : 		?>
			<h1>Profil entreprise <?php echo $model->nom_entreprise ?></h1>
<?php  	endif; 		?>


<?php

$recherche = "Non renseigné";
if($model->recherche_employes == 0){
	$recherche = "Non";
}
else if ($model->recherche_employes == 1){
	$recherche = "Oui";
}

$adresse = "Non renseignée";
if ($model->Adresse->rue != NULL && $model->Adresse->code_postal != NULL && $model->Adresse->ville != NULL)
{
	 $adresse = $model->Adresse->rue.", ".$model->Adresse->code_postal." ".$model->Adresse->ville;
}

$utilisateur = Utilisateur::model()->FindByAttributes(array('id_entreprise'=>$model->id_entreprise));
	$this->widget('zii.widgets.CDetailView',
		array(
			'data'=>$model,
			'attributes'=>array(
				'nom_entreprise',
				array(
					'label'=>'Nombre d\'employés',
					'value'=>$model->nombre_employes != NULL ? 'nombre_employes' : "Non renseigné",
					),
				array(
					'label'=>'Cherche des nouveaux employés',
					'value'=>$recherche,
					),
				array(
					'label'=>'Adresse mail',
					'value'=>$utilisateur->mail != NULL ? $utilisateur->mail : "Non renseignée",
					),
				array(
					'label'=>'Télephone',
					'value'=>$model->telephone_entreprise != NULL ? $model->AfficheTelephone($model->telephone_entreprise," ") : "Non renseigné",
					),
				array(
					'label'=>'Adresse',
					'value'=>$adresse ,
					),
			),
		)
	);
?>





<?php 
		/*		On affiche les message si l'avis a bien été publié, en gros s'il n'y pas d'erreurs 		*/
		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] == 0 && !isset( $_GET['update'] ) ) 
			echo '<div class="success-avis-entreprise" style="margin : 2% 0%; color : green; border: solid 2px green; padding : 2%;" >Votre avis a bien été publié</div>';
		
		/*		S'il y a des erreurs 	*/
		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] > 0 && !isset( $_GET['update'] ) ) 
			echo '<div class="success-avis-entreprise" style="margin : 2% 0%; color : red; border: solid 2px red; padding : 2%;" >Une erreur s\'est produite lors de la création de votre avis. Contactez l\'administrateur du site</div>';
		

		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] == 0 && Yii::app()->request->getParam('update') != NULL &&  $_GET['update'] == "true" )
			echo '<div class="success-update-avis-entreprise" style="margin : 2% 0%; color : green; border: solid 2px green; padding : 2%;" >Votre avis a bien été modifié</div>';

		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] > 0 && Yii::app()->request->getParam('update') != NULL &&  $_GET['update'] == "true" )
			echo '<div class="success-avis-entreprise" style="margin : 2% 0%; color : red; border: solid 2px red; padding : 2%;" >Une erreur s\'est produite lors de la modification de votre avis. Contactez l\'administrateur du site</div>';

		/*		Message de suppression d'un avis 		*/
		if( Yii::app()->request->getParam( 'delete' ) != NULL && Yii::app()->request->getParam( 'delete' ) == "true" ) 
			echo '<div class="success-avis-employe" style="margin : 2% 0%; color : blue; border: solid 2px blue; padding : 2%;" >Votre avis a bien été supprimé</div>';
	
?>















<?php  	
		/*			Si la personne vient de publier un avis 		*/
		if ( isset( $_COOKIE['dernier-avis'] ) ) :
			$dernierAvis_obj = AvisEntreprise::model()->findByAttributes( array( "id_avis_entreprise" => intval( $_COOKIE['dernier-avis'] ) ) );	
		endif;
		/*		On vérifie si l'avis appartient bien à l'entreprise et c'est la même personne qui l'a publié qui est connecté sur le compte 		*/
		if( isset( $dernierAvis_obj ) && $dernierAvis_obj->id_entreprise == $model->id_entreprise && $dernierAvis_obj->id_utilisateur == Utilisateur::get_id_utilisateur_connexion(Yii::app()->user->getId() ) ) :
?>
				<div style="margin : 5% 0%;">
					<h3>Votre dernier avis :</h3>
<?php   			
						$criteresEntrepriseDernier_arr = EntrepriseAvisCritere::model()->findAll( "id_avis_entreprise = " . $dernierAvis_obj->id_avis_entreprise );
?>
					<div>
						<p>Note générale : <?php echo round( $dernierAvis_obj->note_generale_avis_entreprise, 1 ); ?></p>
						<ul class="ul-entre-single-avis-<?php print( $dernierAvis_obj->id_avis_entreprise ); ?>">
<?php  						/*			On parcourt chaque critère de l'avis concerné 		*/
							foreach ( $criteresEntrepriseDernier_arr as $key => $critere_obj ) :
 								$critere_notation_obj = CriteresNotationEntreprise::model()->findByAttributes( array( "id_critere_notation_entreprise"=>$critere_obj->id_critere_notation_entreprise ) );

  								if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_entreprise_avis ) ) : 
?>
									<li><?php print( $critere_notation_obj->nom_critere_entreprise ); ?> : <?php is_null( $critere_obj->note_entreprise_avis ) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_entreprise_avis ); ?> </li>

<?php   						endif; 			?>
<?php  						endforeach; 		?>

						</ul>
						<p>
							<button class="entreprise-update-avis" id_avis="<?php print( $dernierAvis_obj->id_avis_entreprise ); ?>">Modifier mon avis</button>
							<a class="delete-avis-entreprise" href="<?php echo $this->createUrl( 'AvisEntreprise/delete', array( 'id' => $dernierAvis_obj->id_avis_entreprise, 'id_entreprise' => $model->id_entreprise ) ); ?>">Supprimer mon avis</a>
						</p>
							<div class="update-entrep-form-avis-<?php print( $dernierAvis_obj->id_avis_entreprise ); ?>" style="display: none;">
<?php  						
								$this->renderPartial('./../avisEntreprise/update', array 	( 
																								'model' => AvisEntreprise::model(),
																								'avisEntreprise_layout' => $dernierAvis_obj,
																								'criteresAvis_layout' => $criteresEntrepriseDernier_arr
																							) );
?>
							</div>
					</div>

<?php 
				/*		Récupérations de tous les avis de l'entreprise 		*/
				$avis_all = AvisEntreprise::model()->findAll( "id_entreprise = " . $model->id_entreprise );
				/* 		S'il y a des avis on affiche le bouton pour afficher tous les avis		*/	
				if( sizeof( $avis_all ) - 1 > 0 ) : 
?>
					<button class="show-all-avis-cook">Voir les autres avis</button>

						<h2 class="last-avis-all-title hide">Les autres avis sur cette entreprise : </h2>
						<div class="last-avis-all hide">
<?php						
							/*		On parcourt tous les avis de l'utilisateur pour les afficher 		*/
							foreach ( $avis_all as $key => $avis_obj ) :
								if( $avis_obj->id_avis_entreprise != intval( $_COOKIE['dernier-avis'] ) ) :				
?>
								
									<p>Note générale : <b><?php echo round( $avis_obj->note_generale_avis_entreprise, 1 ); ?></b></p>

<?php 								$criteresEntreprise_arr = EntrepriseAvisCritere::model()->findAll( "id_avis_entreprise = " . $avis_obj->id_avis_entreprise ); 		?>

									<ul class="ul-entre-single-avis-<?php print( $avis_obj->id_avis_entreprise ); ?>">

<?php  								/*			On parcourt chaque critère de l'avis concerné 		*/
									foreach ( $criteresEntreprise_arr as $key => $critere_obj ) :
										$critere_notation_obj = CriteresNotationEntreprise::model()->findByAttributes( array( "id_critere_notation_entreprise"=>$critere_obj->id_critere_notation_entreprise ) );
 										if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_entreprise_avis ) ) : 
?>

											<li><?php print( $critere_notation_obj->nom_critere_entreprise ); ?> : <?php is_null( $critere_obj->note_entreprise_avis ) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_entreprise_avis ); ?> </li>

<?php   								endif; 
									endforeach;
									/*		Récupération de la personne qui a créé l'avis  		*/
									$auteur_avis_obj = Employe::get_employe_by_id_utilisateur( $avis_obj->id_utilisateur );  
?>				
									</ul>
									<p>Par : <?php $auteur_avis_obj != NULL ? print( $auteur_avis_obj->prenom_employe ) :  print( "administrateur" );  ?></p>

<?php  								if ( $avis_obj->id_utilisateur == Utilisateur::get_utilisateur_connexion( Yii::app()->user->getId() )->id_utilisateur ) :	?>
					
										<p>
											<button class="entreprise-update-avis" id_avis="<?php print( $avis_obj->id_avis_entreprise ); ?>">Modifier mon avis</button>
											<a class="delete-avis-entreprise" href="<?php echo $this->createUrl( 'AvisEntreprise/delete', array( 'id' => $avis_obj->id_avis_entreprise, 'id_entreprise' => $model->id_entreprise ) ); ?>">Supprimer mon avis</a>
										</p>
										<div class="update-entrep-form-avis-<?php print( $avis_obj->id_avis_entreprise ); ?>" style="display: none;">
<?php  									$this->renderPartial('./../avisEntreprise/update', array 	( 
																								'model' => AvisEntreprise::model(),
																								'avisEntreprise_layout' => $avis_obj,
																								'criteresAvis_layout' => $criteresEntreprise_arr
																							) ); 		?>
										</div>

<?php  								endif;
								endif;
  							endforeach; 	?>
						</div>

<?php  				endif; 			?>

			</div>

















<?php   else : 		?>

	<?php  	/*		Modification du message en fonction de qui voit le profil	*/
			if ( $model->id_entreprise == $this->get_id_utilisateur_connexion(Yii::app()->user->getId() ) ) : 	?>
				<h2>Les derniers avis de votre entreprise :</h2>
	<?php  	else :  	?>
				<h2>Avis de cette entreprise :</h2>

	<?php   endif; ?>



<?php 
	/*		Récupérations de tous les avis de l'entreprise 		*/
	$avis_all = AvisEntreprise::model()->findAll( "id_entreprise = " . $model->id_entreprise );
?>


<div>
<?php 
		/*			S'il y a des avis on les affiche 	 	*/
		if( sizeof( $avis_all ) > 0 ) :
			/*		On parcourt tous les avis de l'utilisateur pour les afficher 		*/
			foreach ( $avis_all as $key => $avis_obj ) :				?>

				<p>Note générale : <b><?php echo round( $avis_obj->note_generale_avis_entreprise, 1 ); ?></b></p>

<?php 			$criteresEntreprise_arr = EntrepriseAvisCritere::model()->findAll( "id_avis_entreprise = " . $avis_obj->id_avis_entreprise ); 		?>

				<ul class="ul-entre-single-avis-<?php print( $avis_obj->id_avis_entreprise ); ?>">

<?php  			/*			On parcourt chaque critère de l'avis concerné 		*/
				foreach ( $criteresEntreprise_arr as $key => $critere_obj ) :			?>
<?php 				$critere_notation_obj = CriteresNotationEntreprise::model()->findByAttributes( array( "id_critere_notation_entreprise"=>$critere_obj->id_critere_notation_entreprise ) );		?>

<?php  				if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_entreprise_avis ) ) : ?>

						<li><?php print( $critere_notation_obj->nom_critere_entreprise ); ?> : <?php is_null( $critere_obj->note_entreprise_avis ) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_entreprise_avis ); ?> </li>

<?php   			endif; 			?>
<?php  			endforeach; 		?>

<?php  			
				/*		Récupération de la personne qui a créé l'avis  		*/
				$auteur_avis_obj = Employe::get_employe_by_id_utilisateur( $avis_obj->id_utilisateur );  
?>				
				</ul>
				<p>Par : <?php $auteur_avis_obj != NULL ? print( $auteur_avis_obj->prenom_employe ) :  print( "administrateur" );  ?></p>

<?php  			if ( $avis_obj->id_utilisateur == Utilisateur::get_utilisateur_connexion( Yii::app()->user->getId() )->id_utilisateur ) :	?>
					
					<p>
						<button class="entreprise-update-avis" id_avis="<?php print( $avis_obj->id_avis_entreprise ); ?>">Modifier mon avis</button>
						<a class="delete-avis-entreprise" href="<?php echo $this->createUrl( 'AvisEntreprise/delete', array( 'id' => $avis_obj->id_avis_entreprise, 'id_entreprise' => $model->id_entreprise ) ); ?>">Supprimer mon avis</a>
					</p>
					<div class="update-entrep-form-avis-<?php print( $avis_obj->id_avis_entreprise ); ?>" style="display: none;">
<?php  					$this->renderPartial('./../avisEntreprise/update', array 	( 
																				'model' => AvisEntreprise::model(),
																				'avisEntreprise_layout' => $avis_obj,
																				'criteresAvis_layout' => $criteresEntreprise_arr
																			) ); 		?>
					</div>

<?php  			endif; ?>

<?php  		endforeach; 	?>

<?php  	else : ?>
	<p>Il n'y a pas encore d'avis.</p>
<?php  	endif; ?>


</div>

<?php   endif; ?>


<?php if( Utilisateur::est_employe( Yii::app()->user->role ) ) : ?>

<h2>Laissez votre avis à cette entreprise</h2>

<?php 
	$this->renderPartial('./../avisEntreprise/_form', array( 'model' => AvisEntreprise::model() ) ); 
	endif;
?>




<!-- A supprimer pour remmetre dans un vrai fichier .js -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).on( 'click', ".entreprise-update-avis", function() {
		$(this).hide();
		$( '.ul-entre-single-avis-' + $(this).attr("id_avis") ).hide();
		$( '.update-entrep-form-avis-' + $(this).attr("id_avis") ).fadeIn();
	});
	
	$(document).on( 'click', '.show-all-avis-cook', function() {
		$(this).hide();
		$('.last-avis-all-title').fadeIn();
		$('.last-avis-all').fadeIn();
	});

	/*		Vérification JS lors qu'on veut supprimet un avis 		*/
	$(document).on( 'click', '.delete-avis-entreprise', function(e) {
		e.preventDefault();
		var confirmation = confirm( 'Voulez-vous supprimer votre avis ?' );
		if ( confirmation )
			window.location.href = $(this).attr("href");
	});
</script>