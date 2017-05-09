<?php
/* @var $this InfosComplementairesProfilController */
/* @var $model InfosComplementairesProfil */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'infos-complementaires-profil-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_info'); ?>
		<?php echo $form->textField($model,'nom_info',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'nom_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'personne_concernee'); ?>
		<?php echo $form->textField($model,'personne_concernee',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'personne_concernee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->