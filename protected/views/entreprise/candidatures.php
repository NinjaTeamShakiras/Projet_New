<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

$modelOffre = OffreEmploi::model();
$tabOffre = OffreEmploi::model()->FindAll("id_entreprise =".$utilisateur->id_entreprise);

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





<!-- Formulaire avec le bouton pour Rechercher cv -->
<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/entreprise/index'),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Rechercher un cv'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>






<h1>Candidats : </h1>


<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('entreprise/Candidatures'),
			)
		);
	?>

	<div class="row">	
		<?php
			//Afficher candidats par annonce
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner une annonce ...'));
			$posteOffre = CHtml::listData($tabOffre,'id_offre_emploi','poste_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($modelOffre,'id_offre_emploi',$static_type + $posteOffre); // On affiche une liste déroulante de toutes les offres

		?>
	</div>

	<div class="row buttons">	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Actualiser');
		?>
	</div>

	<?php $this->endWidget(); ?>

</div>



<?php


	if($data == -2)
	{
		// Uniquement lorsqu'on viens d'une autre page
	}
	else if($data == -1)
	{
		// Pas de paramètre selectionné
	}
	else
	{
		// Candidats chercher et rendu
		if($data == null)
		{
			print("<p> Vous n'avez aucun candidat à cette offre </p>");
		}
		else
		{
			if(sizeof($data) == 1)
			{
				print("<p> Vous avez ".(sizeof($data))." candidat qui a postulé à cette annonce</p>");
			}
			else
			{
				print("<p> Vous avez ".(sizeof($data))." candidats qui ont postulé à cette annonce</p>");
			}
			
			foreach($data as $employe)
			{
				print("<p> Le candidat ".$employe->id_employe." a postulé à votre offre</p>");
			}
		}
	
	}

?>




