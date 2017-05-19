<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

/*$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi,
);
*/

?>
<?php
$titre ="";
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

//$image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png','Image accueil');
//echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe)); 


	if($utilisateur != null)
	{ // Si connecter
		if (!Utilisateur::est_employe(Yii::app()->user->role) )
			{ // Si entreprise on affiche la possibilité de maj/suppr l'offre en question
				?>

				<!--  MENU 	-->
				<div class="btn-group" style="float: right;">
					<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Menu
				   	<span class="caret"></span>
				   	</button>
					<ul class="dropdown-menu dropdown-menu-right">
					<li>
						<a href="index.php?r=offreEmploi/create" title="Déposer une annonce">
						Déposer une annonce
						</a>
					</li>
					<li>
						<a href="index.php?r=entreprise/view&id=<?php echo $utilisateur->id_entreprise;?>" title="Mon profil">
						Mon profil
						</a>
					</li>
					<li>
						<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
						Mes annonces
						</a>
					</li>
					<li>
						<a href="index.php?r=entreprise/candidats" title="Mes candidats">
						Mes candidats
						</a>
					</li>
					<li>
						<a href="index.php?r=entreprise/index" title="Rechercher un CV">
						Rechercher un CV
						</a>
					</li>
					<li role="separator" class="divider"></li>
					<li>
						<a href="index.php?r=entreprise/Deconnexion" title="Déconnexion">
						Déconnexion
					</a>
				</li>
				</ul>
			</div>
		<?php

		$titre = "Mon offre d'emploi";





	} /* 	EMPLOYE 	*/
	else if( Utilisateur::est_employe(Yii::app()->user->role))
	{  // Si employé on affiche la possibilité de postuler à l'offre en question
		$tablePostuler = Postuler::model()->FindAll();
		$aPostuler = false;
		foreach($tablePostuler as $postuler)
		{
			if($postuler->id_offre_emploi == $model->id_offre_emploi && $postuler->id_employe == $utilisateur->id_employe )
			{
				$aPostuler = true;
				$datePostule = $this->changeDateNaissance($postuler->date_postule);
			}
		}

		?>

			<!--  MENU 	-->
			<div class="btn-group" style="float: right;">
				<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu
			   	<span class="caret"></span>
			   	</button>
				<ul class="dropdown-menu dropdown-menu-right">
				<li>
					<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
					Mon profil
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
					Mes candidatures
					</a>
				</li>
				<li>
					<a href="index.php?r=employe/index" title="Rechercher une offre">
					Rechercher une offre
					</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
					<a href="index.php?r=entreprise/Deconnexion" title="Déconnexion">
					Déconnexion
					</a>
				</li>
			</ul>
		</div>
	<?php

		$titre = "Offre d'emploi";
		
	}


}
else
{ // Si non connecté
	?>

			<!--  MENU 	-->
			<div class="btn-group" style="float: right;">
				<button type="button" class="btn-menu btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu
			   	<span class="caret"></span>
			   	</button>
				<ul class="dropdown-menu dropdown-menu-right">
			<li>
				<a href="index.php?r=site/redirectInscriptionCV" title="Ajouter mon CV">
				Ajouter mon CV
				</a>
			</li>
			<li>
				<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
				Liste des offres d'emplois
				</a>
			</li>
			<li>
				<a href="index.php?r=employe/index" title="Rechercher une offre">
				Rechercher une offre
				</a>
			</li>
		</ul>
	</div>
<?php

	$titre = "Offre d'emploi";
	
}



?>
<div class='filtre-blanc'>
	<div class="div-type-offre">
		<?php
			$titre = "";
		if($utilisateur != null)
		{
			if(!Utilisateur::est_employe(Yii::app()->user->role))// Entreprise
			{
				$titre = "Votre offre de ".$model->poste_offre_emploi;
			}
			else if(Utilisateur::est_employe(Yii::app()->user->role)) // Employe
			{
				// on récupère l'entreprise concerné
				$entreprise = Entreprise::model()->FindByAttributes(array("id_entreprise"=>$model->id_entreprise));
				// On adapte le titre
				$titre = "Offre proposée par ".$entreprise->nom_entreprise.".";
			}
		}
		else
		{// Si non connecté
			$titre = "Votre offre de ".$model->poste_offre_emploi;
		}
		// Message de confirmation de mise à jour
		echo Yii::app()->user->getFlash('success_update_offre');
		// Message de confirmation de création
		echo Yii::app()->user->getFlash('success_create_offre');
		?>



		<h1><?php echo $titre ?></h1>

		</div>


		<?php
			// On corrige l'affichage de date 
			$date_creation = $this->changeDateNaissance($model->date_creation_offre_emploi);
			$date_debut = $this->changeDateNaissance($model->date_debut_offre_emploi);

			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$model->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));
			?>
			<div class='div-description-offre'>
				<?php
				print("<p><strong> Secteur d'activité : </strong>".$entreprise->secteur_activite_entreprise." </p>");
				print("<p><strong>Poste : </strong>".$model->poste_offre_emploi."</p>");
				print("<p><strong>Type de contrat : </strong>".$model->type_offre_emploi."</p>");
				print("<p><strong> Date prévisionnelle d'embauche :</strong> ".$this->changeDateNaissance($model->date_debut_offre_emploi)."</p>");
				print("<p><strong>Salaire proposé :</strong> ".$model->salaire_offre_emploi." €</p>");
				print("<p><strong>Lieu : </strong>".$adresse->ville." </p>");
				print("<p><strong>Expérience nécéssaire :</strong> ".$model->experience_offre_emploi."</p>");
				print("<p><strong>Description de l'offre : </strong>".$model->description_offre_emploi."</p>");
				print("<p><strong>Date de mise en ligne : </strong>".$this->changeDateNaissance($model->date_creation_offre_emploi)."</p>");
				?>
	<!-- Fin type-offre -->
	</div>

	<div class='div-postule-ou-non'>

		<?php
		 

		if($utilisateur != null)
		{
			/*		ENTREPRISE 			*/
			if (!Utilisateur::est_employe(Yii::app()->user->role) )
			{ // Si entreprise on affiche les candidatures éventuelle
				$nombreCandidature = 0;
				$tabIdEmploye=array();
				$candidats = Postuler::model()->FindAll("id_offre_emploi =".$model->id_offre_emploi); // On récupère tout les candidats à l'offre

				// Recherche du nombre de candidature et des candidat
				foreach($candidats as $candidat) // Pour chaque candidat
				{ // On stoque tout les id des employé qui on candidaté dans un tableau
					$tabIdEmploye[$nombreCandidature] = $candidat->id_employe;
					$nombreCandidature++;
				}


				// Lien de suppression
				//echo CHtml::link(CHtml::encode('Supprimer cette offre'), array('delete', 'id'=>$model->id_offre_emploi), array('confirm'=> 'Etes-vous sur de vouloir supprimer cette offre ?'));


				// Affichage des candidats ou non
				if($nombreCandidature > 0) // Si il y a des candidats
				{ // On affiche le nombre de candidat, puis un lien vers les candidats
					print("<p> Vous avez ".$nombreCandidature." candidature(s) pour cette offre : </p>");

					$tablePostuler = Postuler::model()->FindAll();
					for($i=0; $i<$nombreCandidature; $i++)// parcours de chaques candidatures (correspond à un employé)
					{ 
						// On affiche un lien pour chacun des candidat
						//echo CHtml::link("<p> Voir la candidature $i </p>",array('employe/view', 'id'=>$tabIdEmploye[$i]));

						foreach($tablePostuler as $postuler) // Parcours de TOUT les postulants
						{ 
						 	if( ($postuler->id_offre_emploi == $model->id_offre_emploi)  && ($tabIdEmploye[$i] == $postuler->id_employe) )
						 	{ // Si l'offre de la table postuler concerne l'offre en question ET  :
						 		print("<p>Candidat numéro ".$i." (id = ".$tabIdEmploye[$i].") a candidaté le ".$this->changeDateNaissance($postuler->date_postule).". </p>");
						 	}
						}
					}
				}
				else
				{
					print("<p> Vous n'avez aucune candidature pour cette offre </p>");
				}

				?>


				<!-- Formulaire avec le bouton pour Modifier annonce -->
				<div class="wide form">
					<?php
					//Début du form
					$form=$this->beginWidget('CActiveForm',
						array(
							'action'=>Yii::app()->createUrl('/offreEmploi/update',array('id'=>$model->id_offre_emploi)),
						)
					);
					?>

					<div class="row">
						<?php echo CHtml::submitButton('Modifier mon annonce',array('class'=>'btn-candidature')); ?>
					</div>

					<?php $this->endWidget(); ?>
				
				</div>




				<!-- Formulaire avec le bouton pour Supprimer annonce -->
				<div class="wide form">
					<?php
					//Début du form
					$form=$this->beginWidget('CActiveForm',
						array(
							'action'=>Yii::app()->createUrl('/offreEmploi/delete',array('id'=>$model->id_offre_emploi)),
						)
					);
					?>

					<div class="row">
						<?php echo CHtml::submitButton('Supprimer mon annonce',array('class'=>'btn-canditure')); ?>
					</div>

					<?php $this->endWidget(); ?>
				
				</div>


			<?php




			}/*			EMPLOYE 			*/
			else if(Utilisateur::est_employe(Yii::app()->user->role))
			{
				// On rajoute la date de postulation
				if($aPostuler)
				{
					print"<p>Vous avez postuler à cette offre le ".$datePostule."</p>";
				}

				?> 



				<!-- Formulaire avec le bouton pour postuler/dépostuler -->
				<div class="wide form">
					<?php
						// Message de confirmation de candidature
						echo Yii::app()->user->getFlash('success_postule_offre');
						echo Yii::app()->user->getFlash('success_depostule_offre');

						//Début du form
						if($aPostuler)
						{
							$form=$this->beginWidget('CActiveForm',
								array(
									'action'=>Yii::app()->createUrl('/offreEmploi/depostule',array('id_offre'=>$model->id_offre_emploi))
								)
							);
						}
						else
						{
							$form=$this->beginWidget('CActiveForm',
								array(
									'action'=>Yii::app()->createUrl('/offreEmploi/postule',array('id_offre'=>$model->id_offre_emploi))
								)
							);
						}
					?>

					<div class="row div-btn-candidature">
						<!-- Bouton pour postuler/Dépostuler -->
						<?php 
							if($aPostuler)
							{ // si l'employe à postuler
								echo CHtml::submitButton('Retirer ma candidature',array('class'=>'btn-candidature'));
							}
							else
							{ // si l'employé n'a pas postulé
								echo CHtml::submitButton('Postuler',array('class'=>'btn-candidature'));
							}

						?>
					</div>

					<?php $this->endWidget(); ?>
				</div>



		<?php
			}
		}
		else
		{
			?>
				<!-- Formulaire avec le bouton pour postuler/dépostuler -->
				<div class="wide form">
					<?php $form=$this->beginWidget('CActiveForm',array('action'=>Yii::app()->createUrl('/offreEmploi/postule',array('id_offre'=>$model->id_offre_emploi))));?>

					<div class="row buttons">
						<!-- Bouton pour postuler/Dépostuler -->
						<?php echo CHtml::submitButton('Postuler',array('class'=>'btn-candidature'));	?>
					</div>

					<?php $this->endWidget(); ?>
				</div>

				<?php
		}

		?>
	</div>
</div>