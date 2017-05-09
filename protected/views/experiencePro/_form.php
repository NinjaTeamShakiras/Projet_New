<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'experience-pro-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_debut_experience'); ?>
		<?php echo $form->textField($model,'date_debut_experience'); ?>
		<?php echo $form->error($model,'date_debut_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_fin_experience'); ?>
		<?php echo $form->textField($model,'date_fin_experience'); ?>
		<?php echo $form->error($model,'date_fin_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intitule_experience'); ?>
		<?php echo $form->textField($model,'intitule_experience',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'intitule_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'entreprise_experience'); ?>
		<?php echo $form->textField($model,'entreprise_experience',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'entreprise_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_experience'); ?>
		<?php echo $form->textField($model,'description_experience',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
		<?php echo $form->error($model,'id_employe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->