<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

/*$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	$model->id_offre_emploi,
);
*/

$titre ="";
$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));
$adresse = Adresse::model()->FindByAttributes(array("id_adresse"=>$utilisateur->id_adresse));





if (!Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si entreprise on affiche la possibilité de maj/suppr l'offre en question
		?>

		<!--	MENU 	-->
		<!-- Formulaire avec le bouton pour voir mon profil -->
		<div class="wide form">
			<?php
			//Début du form
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('/entreprise/view',array('id'=>$utilisateur->id_entreprise)),
				)
			);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Mon profil'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>





		<!-- Formulaire avec le bouton pour Mes annonce -->
		<div class="wide form">
			<?php
			//Début du form
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('/offreEmploi/index'),
				)
			);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Mes annonces'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>





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

			<div class="row buttons">
				<?php echo CHtml::submitButton('Modifier mon annonce'); ?>
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

			<div class="row buttons">
				<?php echo CHtml::submitButton('Supprimer mon annonce'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>




		<?php

		$titre = "Mon offre d'emploi";



	}
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



		<!--	MENU 	-->
		<!-- Formulaire avec le bouton pour voir mon profil -->
		<div class="wide form">
			<?php
			//Début du form
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('/employe/view',array('id'=>$utilisateur->id_employe)),
				)
			);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Mon profil'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>




		<!-- Formulaire avec le bouton pour voir mes candidatures -->
		<div class="wide form">
			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('offreEmploi/mesOffres') ,
					)
				);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Voir mes candidature'); ?>
			</div>

			<?php $this->endWidget(); ?>
				
		</div>






		<!-- Formulaire avec le bouton pour rechercher une offre -->
		<div class="wide form">
			<?php
				//Début du form
				$form=$this->beginWidget('CActiveForm',
					array(
						'action'=>Yii::app()->createUrl('offreEmploi/recherche'),
					)
				);
			?>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Rechercher une offre'); ?>
			</div>

			<?php $this->endWidget(); ?>
				
		</div>


	<?php

		$titre = "Offre d'emploi";
		
	}
	else 
	{ // Si autre on affiche toutes les possibilité
		$this->menu=array(
			array('label'=>'Postuler', 'url'=>array('postule', 'id_offre'=>$model->id_offre_emploi)),
			array('label'=>'Dépostuler', 'url'=>array('depostule', 'id_offre'=>$model->id_offre_emploi)),
			array('label'=>'Modifier', 'url'=>array('update', 'id'=>$model->id_offre_emploi)),
			//Marche pas
			//array('label'=>'Supprimer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_offre_emploi),'confirm'=>'Vous êtes sur le point de supprimer, voulez vous continuer ?')),
		);

	}

?>
<?php
	$titre = "";
	
	if(!Utilisateur::est_employe(Yii::app()->user->role))// Entreprise
	{
		$titre = "Votre offre de ".$model->poste_offre_emploi;
	}
	else if(Utilisateur::est_employe(Yii::app()->user->role)) // Employe
	{
		// on récupère l'entreprise concerné
		$entreprise = Entreprise::model()->FindByAttributes(array("id_entreprise"=>$model->id_entreprise));
		// On adapte le titre
		$titre = "Offre proposé par ".$entreprise->nom_entreprise.".";
	}
?>



<h1><?php echo $titre ?></h1>



<?php
	$date_creation = $this->changeDateNaissance($model->date_creation_offre_emploi);
	$date_debut = $this->changeDateNaissance($model->date_debut_offre_emploi);


	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			//'id_offre_emploi',
			array(
				'label'=>'Poste ',
				'value'=>$model->poste_offre_emploi
			),
			array(
				'label'=>'Type de contrat ',
				'value'=>$model->type_offre_emploi
			),
			array(
				'label'=>'Date de prévisionnel d\'embauche',
				'value'=>$model->date_debut_offre_emploi != NULL ? $date_debut : "Non renseignée",
				),
			array(
				'label'=>'Salaire ',
				'value'=>$model->salaire_offre_emploi." €"
			),
			array(
				'label'=>'Lieu ',
				'value'=>$adresse->ville,
			),
			array(
				'label'=>'Expérience nécéssaire ',
				'value'=>$model->experience_offre_emploi
			),
			array(
				'label'=>'Description de l\'offre ',
				'value'=>$model->description_offre_emploi
			),
			array(
				'label'=>'Date de mise en ligne ',
				'value'=>$model->date_creation_offre_emploi != NULL ? $date_creation : "Non renseignée"
			),
			//'id_entreprise',
			),
		));



 

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
			print("<p> Vous avez ".$nombreCandidature." candidature pour cette offre : </p>");

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
			print("<p> Vous n'avez aucune candidature à cette offre </p>");
		}




	}/*			EMPLOYE 			*/
	else if(Utilisateur::est_employe(Yii::app()->user->role))
	{
		// On rajoute la date de postulation
		if($aPostuler)
		{
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array(
						'label'=>'Vous avez postuler le ',
						'value'=>$datePostule != NULL ? $datePostule : "Non renseignée",
					),

				),
			));
		}

		?> 


		<!-- Formulaire avec le bouton pour postuler/dépostuler -->
		<div class="wide form">
			<?php
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

			<div class="row buttons">
				<!-- Bouton pour postuler/Dépostuler -->
				<?php 
					if($aPostuler)
					{
						echo CHtml::submitButton('Retirer ma candidature');
					}
					else
					{
						echo CHtml::submitButton('Postuler');
					}

				?>
			</div>

			<?php $this->endWidget(); ?>
		</div>



<?php
	}

?>



