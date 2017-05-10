<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

	$offreEmploi = OffreEmploi::model();

?>

<!-- Formulaire de recherche des offres d'emplois -->
<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array('action'=>Yii::app()->createUrl('offreEmploi/Search'),)
		);
	?>

	<div class="row">
		<!-- Recherche d'un poste (textfield + bouton submit) -->	
		<?php
			//On demande le nom du poste
			echo $form->textField(
				$offreEmploi,'poste_offre_emploi', array(	
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher un poste'
				)
			);
		?>

		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>


<!-- Fomulaire avec le bouton de l'ajout du CV -->
<div class="wide form">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/choixAjoutCV'),
			)
		);
	?>

	<div class="row buttons">
		<!-- Bouton d'ajout du CV -->
		<?php echo CHtml::submitButton('Ajouter mon CV'); ?>
	</div>

	<?php $this->endWidget(); ?>
		
</div>

<!-- Formulaire avec le bouton pour postuler en click -->
<div class="wide form">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/recherche') ,
			)
		);
	?>

	<div class="row buttons">
		<!-- Bouton pour postuler -->
		<?php echo CHtml::submitButton('Postuler à une annonce en un seul click !'); ?>
	</div>

	<?php $this->endWidget(); ?>
		
</div>