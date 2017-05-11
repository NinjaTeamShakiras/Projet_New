<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offre-emploi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<?php
	/*
	<div class="row">
		<?php echo $form->labelEx($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->error($model,'date_creation_offre_emploi'); ?>
	</div>
	*/
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'poste_offre_emploi'); ?>
		<?php echo $form->textField($model,'poste_offre_emploi',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'poste_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_offre_emploi'); ?>
		<?php //echo $form->textField($model,'type_offre_emploi',array('size'=>30,'maxlength'=>30)); ?>
		<?php
			// Liste déroulante pour le choix du type d'offre
			echo $form->dropDownList($model, 'type_offre_emploi', array('CDD'=>'CDD', 'CDI'=>'CDI', 'STAGE'=>'STAGE', 'ALTERNANCE'=>'ALTERNANCE', 'EXTRA'=>'EXTRA'));
		?>
		<?php echo $form->error($model,'type_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_debut_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_debut_offre_emploi'); ?>
		<?php echo $form->error($model,'date_debut_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salaire_offre_emploi'); ?>
		<?php echo $form->textField($model,'salaire_offre_emploi'); ?>
		<?php echo $form->error($model,'salaire_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'experience_offre_emploi'); ?>
		<?php echo $form->textField($model,'experience_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'experience_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_offre_emploi'); ?>
		<?php echo $form->textField($model,'description_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description_offre_emploi'); ?>
	</div>

	<?php
	/*
	<div class="row">
		<?php echo $form->labelEx($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
		<?php echo $form->error($model,'id_entreprise'); ?>
	</div>
	*/
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Mettre à jour l\'offre'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->