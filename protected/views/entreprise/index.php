<?php
/* @var $this EntrepriseController */
/* @var $dataProvider CActiveDataProvider */

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>

<!--	MENU 	-->

<!-- Formulaire avec le bouton pour voir Déposer une annonce -->
<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/offreEmploi/create'),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Déposer une annonce'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>



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





<!-- Formulaire avec le bouton pour Mes annonces -->
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


<!-- Formulaire avec le bouton pour Mes candidats -->
<div class="wide form">
	<?php
	//Début du form
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('/entreprise/candidatures'),
		)
	);
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Mes candidats'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>


<h1>Rechercher un CV : </h1>

<?php 
	$tabEmploye = employe::model()->FindAll();

	$nombreEmploye = sizeof($tabEmploye);

	print("<p> Trouver le candidat que vous rechercher parmis ".$nombreEmploye." CV.</p>"); 
?>


<!-- FORMAULAIRE DE RECHERCHE DE CV-->
<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('entreprise/Search'),
			)
		);
	?>

	<!-- Recherche par niveau de compétence (textfield + bouton submit) -->
	<div class="row">
		<?php
			//Recherche par COMPETENCE
			$competence = competence::model();
			echo $form->textField(
				$competence,'intitule_competence', array(	
					'class' => 'autocomplete-find-entreprise',
					'url_data_auto' => Yii::app()->createUrl('entreprise/GetAllCompetenceJSON'),
					'size' => 45,
					'maxlength' => 45,
					'placeholder' => 'Rechercher par compétence',
				)
			);
		?>
	</div>

	<div class="row">
		<?php
			//Recherche par NIVEAU de COMPETENCE
			echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5','Sans importance'),array('separator' => ' '));
		?>
	</div>

	<div class="row buttons">	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>
	</div>

	
	<?php $this->endWidget(); ?>

</div>



<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<h1><strong>Voir avec le client pour le dernier formulaire, c'est pas clair</strong></h1>
