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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->error($model,'date_creation_offre_emploi'); ?>
	</div>

	<div class="row">
		<select name="position_affaire">
			<option value="texte_position_affaire1">CDD</option>
			<option value="texte_position_affaire2">CDI</option>
			<option value="texte_position_affaire3">STAGE</option>
			<option value="texte_position_affaire2">ALTERNANCE</option>
			<option value="texte_position_affaire3">EXTRA</option>
		</select>
		<?php echo $form->labelEx($model,'poste_offre_emploi'); ?>
		<?php echo $form->textField($model,'poste_offre_emploi',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'poste_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_offre_emploi'); ?>
		<?php echo $form->textField($model,'type_offre_emploi',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'type_offre_emploi'); ?>
	</div>

	<div class="row">
		<input type="date" name="date_debut_offre_emploi" value="date_debut">
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

	<div class="row">
		<?php echo $form->labelEx($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
		<?php echo $form->error($model,'id_entreprise'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->