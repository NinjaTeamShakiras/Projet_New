<?php
/* @var $this EmployeController */
/* @var $model Employe */

$this->breadcrumbs=array(
	'Employes'=>array('index'),
	$model->id_employe,
);

		/* 		Si ce n'est pas le profil de l'utilisateur en cours on ne l'affiche pas		*/
		if($model->id_employe == $this->get_id_utilisateur_connexion(Yii::app()->user->getId())) :
			$this->menu=array(
				//array('label'=>'Paramètres du compte', 'url'=>array('parametres', 'model'=>$model)),
				array('label'=>'Mettre à jour mon profil', 'url'=>array('update', 'id'=>$model->id_employe)),
			);

?>
<div>
	<h1>Bonjour <?php echo $model->prenom_employe;?> ,</h1>
	<h2>Bienvenue sur votre profil</h2>
</div> 

<?php else :  ?>
<div>
	<h1><?php echo $model->nom_employe . " " .$model->prenom_employe;?></h1>
</div>


<?php  endif; ?>



<?php 

//On change le format du téléphone via une fonction du controller
$telephone = $this->AfficheTelephone($model->telephone_employe," ");

//On passe la date de naissance au format français via une fonction du controller
$date_naissance = $this->changeDateNaissance($model->date_naissance_employe);

//On récupère l'adresse depuis la table Adresse
$adresse = "Non renseignée";
if($model->id_adresse != NULL)
{
	$modelAdresse = Adresse::model()->FindByAttributes(array("id_adresse" => $model->id_adresse));

	if ($modelAdresse->rue != NULL && $modelAdresse->code_postal != NULL && $modelAdresse->ville != NULL)
	{
		 $adresse = $model->Adresse->rue.", ".$model->Adresse->code_postal." ".$model->Adresse->ville;
	}
}

//On change le champ emploi par rapport au contenu de la base
$emploi = "Non renseigné";
if($model->employe_travaille == 0)
{
	$emploi = "Oui";
}
else if ($model->employe_travaille)
{
	$emploi = "Non";
}

//On récupère l'utulisateur dans la base
$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));


$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nom_employe',
		'prenom_employe',
		array(
			'label'=>'Date de naissance',
			'value'=> $model->date_naissance_employe != NULL ? $date_naissance : "Non renseignée",
			),
		//On modifie la valeur de employe_travaille
		array(
			'label'=>'Recherche un emploi',
			'value'=>$emploi,
			),
		array(
			'label'=>'Adresse mail',
			'value'=>$utilisateur->mail != NULL ? $utilisateur->mail : "Non renseignée",
			),
		array(
			'label'=>'Télephone',
			'value'=>$model->telephone_employe != NULL ? $telephone : "Non renseigné",
		),
		//On affiche l'adresse en passant par la clé étrangère
		array(
			'label'=>'Adresse',
			'value'=>$adresse,
			),
	),
));

//Lien de supression du profil
echo CHtml::link(CHtml::encode('Supprimer mon profil'), array('employe/delete', 'id'=>$model->id_employe), array('confirm'=>'Etes-vous sur de vouloir supprimer votre profil ?'));
 

?>

<?php 
		/*		On affiche les message si l'avis a bien été publié, en gros s'il n'y pas d'erreurs 		*/
		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] == 0 && !isset( $_GET['update'] ) ) 
			echo '<div class="success-avis-employe" style="margin : 2% 0%; color : green; border: solid 2px green; padding : 2%;" >Votre avis a bien été publié</div>';
		
		/*		S'il y a des erreurs 	*/
		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] > 0 && !isset( $_GET['update'] ) ) 
			echo '<div class="success-avis-employe" style="margin : 2% 0%; color : red; border: solid 2px red; padding : 2%;" >Une erreur s\'est produite lors de la création de votre avis. Contactez l\'administrateur du site</div>';
		

		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] == 0 && Yii::app()->request->getParam('update') != NULL &&  $_GET['update'] == "true" )
			echo '<div class="success-update-avis-employe" style="margin : 2% 0%; color : green; border: solid 2px green; padding : 2%;" >Votre avis a bien été modifié</div>';

		if( Yii::app()->request->getParam('error') != NULL && $_GET['error'] > 0 && Yii::app()->request->getParam('update') != NULL &&  $_GET['update'] == "true" )
			echo '<div class="success-avis-employe" style="margin : 2% 0%; color : red; border: solid 2px red; padding : 2%;" >Une erreur s\'est produite lors de la modification de votre avis. Contactez l\'administrateur du site</div>';

		/*		Message de suppression d'un avis 		*/
		if( Yii::app()->request->getParam( 'delete' ) != NULL && Yii::app()->request->getParam( 'delete' ) == "true" ) 
			echo '<div class="success-avis-employe" style="margin : 2% 0%; color : blue; border: solid 2px blue; padding : 2%;" >Votre avis a bien été supprimé</div>';
	
?>






<?php  	
		/*			Si la personne vient de publier un avis  		*/
		if ( isset( $_COOKIE['dernier-avis-employe'] ) ) :
			$dernierAvis_obj = AvisEmploye::model()->findByAttributes( array( "id_avis_employe" => intval( $_COOKIE['dernier-avis-employe'] ) ) );	
		endif;
		/*		On vérifie si l'avis appartient bien à l'employe et c'est la même personne qui l'a publié qui est connecté sur le compte 		*/
		if( isset( $dernierAvis_obj ) && $dernierAvis_obj->id_employe == $model->id_employe && $dernierAvis_obj->id_utilisateur == Utilisateur::get_id_utilisateur_connexion(Yii::app()->user->getId() ) ) :
?>
				<div style="margin : 5% 0%;">
					<h3>Votre dernier avis :</h3>
<?php   			
						$criteresEmployeDernier_arr = EmployeAvisCritere::model()->findAll( "id_avis_employe = " . $dernierAvis_obj->id_avis_employe );
?>
					<div>
						<p>Note générale : <?php echo round( $dernierAvis_obj->note_generale_avis_employe, 1 ); ?></p>
						<ul class="ul-single-avis-<?php print( $dernierAvis_obj->id_avis_employe ); ?>">
<?php  						/*			On parcourt chaque critère de l'avis concerné 		*/
							foreach ( $criteresEmployeDernier_arr as $key => $critere_obj ) :
 								$critere_notation_obj = CriteresNotationEmploye::model()->findByAttributes( array( "id_critere_notation_employe"=>$critere_obj->id_critere_notation_employe ) );

  								if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_employe_avis ) ) : 
?>
									<li><?php print( $critere_notation_obj->nom_critere_employe ); ?> : <?php is_null( $critere_obj->note_employe_avis ) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_employe_avis ); ?> </li>

<?php   						endif; 			?>
<?php  						endforeach; 		?>

						</ul>
						<p>
							<button class="update-avis" id_avis="<?php print( $dernierAvis_obj->id_avis_employe ); ?>">Modifier mon avis</button>
							<a class="delete-avis-employe" href="<?php echo $this->createUrl( 'AvisEmploye/delete', array( 'id' => $dernierAvis_obj->id_avis_employe, 'id_employe' => $model->id_employe ) ); ?>">Supprimer mon avis</a>
						</p>
							<div class="update-form-avis-<?php print( $dernierAvis_obj->id_avis_employe ); ?>" style="display: none;">
<?php  						
								$this->renderPartial('./../avisEmploye/update', array 	( 
																								'model' => AvisEmploye::model(),
																								'avisEmploye_layout' => $dernierAvis_obj,
																								'criteresAvis_layout' => $criteresEmployeDernier_arr
																							) );
?>
							</div>
					</div>

<?php 
				/*		Récupérations de tous les avis de l'employe 		*/
				$avis_all = AvisEmploye::model()->findAll( "id_employe = " . $model->id_employe );
				/* 		S'il y a des avis on affiche le bouton pour afficher tous les avis		*/	
				if( sizeof( $avis_all ) - 1 > 0 ) : 
?>
					<button class="show-all-avis-cook">Voir les autres avis</button>

						<h2 class="last-avis-all-title hide">Les autres avis sur cette employe : </h2>
						<div class="last-avis-all hide">
<?php						
							/*		On parcourt tous les avis de l'utilisateur pour les afficher 		*/
							foreach ( $avis_all as $key => $avis_obj ) :
								if( $avis_obj->id_avis_employe != intval( $_COOKIE['dernier-avis-employe'] ) ) :				
?>
								
									<p>Note générale : <b><?php echo round( $avis_obj->note_generale_avis_employe, 1 ); ?></b></p>

<?php 								$criteresEmploye_arr = EmployeAvisCritere::model()->findAll( "id_avis_employe = " . $avis_obj->id_avis_employe ); 		?>

									<ul class="ul-entre-single-avis-<?php print( $avis_obj->id_avis_employe ); ?>">

<?php  								/*			On parcourt chaque critère de l'avis concerné 		*/
									foreach ( $criteresEmploye_arr as $key => $critere_obj ) :
										$critere_notation_obj = CriteresNotationEmploye::model()->findByAttributes( array( "id_critere_notation_employe"=>$critere_obj->id_critere_notation_employe ) );
 										if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_employe_avis ) ) : 
?>

											<li><?php print( $critere_notation_obj->nom_critere_employe ); ?> : <?php is_null( $critere_obj->note_employe_avis ) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_employe_avis ); ?> </li>

<?php   								endif; 
									endforeach;
									/*		Récupération de la personne qui a créé l'avis  		*/
									$auteur_avis_obj = Entreprise::get_entreprise_by_id_utilisateur( $avis_obj->id_utilisateur );  
?>				
									</ul>
									<p>Par : <?php $auteur_avis_obj != NULL ? print( $auteur_avis_obj->nom_entreprise ) :  print( "administrateur" );  ?></p>

<?php  								if ( $avis_obj->id_utilisateur == Utilisateur::get_utilisateur_connexion( Yii::app()->user->getId() )->id_utilisateur ) :	?>
					
										<p>
											<button class="update-avis" id_avis="<?php print( $avis_obj->id_avis_employe ); ?>">Modifier mon avis</button>
											<a class="delete-avis-employe" href="<?php echo $this->createUrl( 'AvisEmploye/delete', array( 'id' => $avis_obj->id_avis_employe, 'id_employe' => $model->id_employe ) ); ?>">Supprimer mon avis</a>
										</p>
										<div class="update-form-avis-<?php print( $avis_obj->id_avis_employe ); ?>" style="display: none;">
<?php  									$this->renderPartial('./../avisEmploye/update', array 	( 
																								'model' => AvisEmploye::model(),
																								'avisEmploye_layout' => $avis_obj,
																								'criteresAvis_layout' => $criteresEmploye_arr
																							) ); 		?>
										</div>

<?php  								endif;
								endif;
  							endforeach; 	?>
						</div>

<?php  				endif; 			?>


<?php  	else : 		?>



<?php  	if($model->id_employe == $this->get_id_utilisateur_connexion(Yii::app()->user->getId())) : 	?>
			<h2>Vos derniers avis :</h2>
<?php  	else :  	?>
			<h2>Avis de cet employé :</h2>

<?php   endif; ?>

<?php 
	/*		Récupérations des informations des autres tables 		*/
	$avis_all = AvisEmploye::model()->findAll( "id_employe = " . $model->id_employe );
?>
	

<div>
<?php 
			if( sizeof( $avis_all ) > 0 ) :
				/*		On parcourt tous les avis de l'utilisateur pour les afficher 		*/
				foreach ( $avis_all as $key => $avis_obj ) :				?>

					<p>Note générale : <b><?php echo round( $avis_obj->note_generale_avis_employe, 1 ); ?></b></p>

<?php 				$criteresEmploye_array = EmployeAvisCritere::model()->findAll( "id_avis_employe = " . $avis_obj->id_avis_employe ); 		?>

					<ul class="ul-single-avis-<?php print( $avis_obj->id_avis_employe ); ?>">

<?php  				/*			On parcourt chaque critère de l'avis concerné 		*/
					foreach ( $criteresEmploye_array as $key => $critere_obj ) :			?>
<?php 					$critere_notation_obj = CriteresNotationEmploye::model()->findByAttributes( array( "id_critere_notation_employe"=>$critere_obj->id_critere_notation_employe ) );		?>

<?php  					if( !empty( $critere_obj->commentaire_evaluation_critere ) || !is_null( $critere_obj->note_employe_avis ) ) : ?>

							<li><?php print( $critere_notation_obj->nom_critere_employe); ?> : <?php is_null($critere_obj->note_employe_avis) ? print( $critere_obj->commentaire_evaluation_critere ) : print( $critere_obj->note_employe_avis ); ?> </li>

<?php   				endif; 			?>
<?php  				endforeach; 		?>

<?php  			
					/*		Récupération de la personne qui a créé l'avis  		*/
					$auteur_avis_obj = Entreprise::get_entreprise_by_id_utilisateur( $avis_obj->id_utilisateur );  
?>				
					</ul>
					<p>Par : <?php $auteur_avis_obj != NULL ? print( $auteur_avis_obj->nom_entreprise ) :  print( "administrateur" );  ?></p>

<?php  				if ( $avis_obj->id_utilisateur == Utilisateur::get_utilisateur_connexion( Yii::app()->user->getId() )->id_utilisateur ) :	?>
					
						<p>
							<button class="update-avis" id_avis="<?php print( $avis_obj->id_avis_employe ); ?>">Modifier mon avis</button>
							<a class="delete-avis-employe" href="<?php echo $this->createUrl( 'AvisEmploye/delete', array( 'id' => $avis_obj->id_avis_employe, 'id_employe' => $model->id_employe ) ); ?>">Supprimer mon avis</a>
						</p>
						<div class="update-form-avis-<?php print( $avis_obj->id_avis_employe ); ?>" style="display: none;">
<?php  						$this->renderPartial('./../avisEmploye/update', array 	( 
																					'model' => AvisEmploye::model(),
																					'avisEmploye_layout' => $avis_obj,
																					'criteresAvis_layout' => $criteresEmploye_array
																				) ); 		?>
						</div>

<?php  				endif; ?>

<?php  			endforeach; 	?>

<?php  		else : ?>
				<p>Il n'y a pas encore d'avis.</p>

<?php  
			endif;
		/*			Endif pour savoir s'il y un dernier avis ou pas 		*/
		endif; 
?>


</div>


<?php 
	/*			Si l'utilisateur n'est pas un employé 		*/
	if( !Utilisateur::est_employe(Yii::app()->user->role ) ) : 
?>

	<h2>Laissez votre avis à cet employé</h2>

<?php
		/**
		 * Affichage du formulaire pour ajouter un avis
		 */
		$this->renderPartial('./../avisEmploye/_form', array( 'model' => AvisEmploye::model()) ); 
	endif;
?>


<!-- A supprimer pour remmetre dans un vrai fichier .js -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on( 'click', ".update-avis", function() {
		$(this).hide();
		$( '.ul-single-avis-' + $(this).attr("id_avis") ).hide();
		$( '.update-form-avis-' + $(this).attr("id_avis") ).fadeIn();
	});
	
	/*			Code pour afficher les avis quand on a un avis qui a été récemment publié 			*/
	$(document).on( 'click', '.show-all-avis-cook', function() {
		$(this).hide();
		$('.last-avis-all-title').fadeIn();
		$('.last-avis-all').fadeIn();
	});

	/*		Vérification JS lors qu'on veut supprimet un avis 		*/
	$(document).on( 'click', '.delete-avis-employe', function(e) {
		e.preventDefault();
		var confirmation = confirm( 'Voulez-vous supprimer votre avis ?' );
		if ( confirmation )
			window.location.href = $(this).attr("href");
	});
</script>

