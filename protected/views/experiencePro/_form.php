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

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_debut_experience'); ?>
		<?php echo $form->textField($model,'date_debut_experience', array(
																	'value' => $this->changeDateNaissance($model->date_debut_experience),
																	'size' => 20,
																	'maxlength' => 10,
																	'placeholder' => 'JJ/MM/AAAA',
																	)
		); ?>
		<?php echo $form->error($model,'date_debut_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_fin_experience'); ?>
		<?php echo $form->textField($model,'date_fin_experience', array(
																	'value' => $this->changeDateNaissance($model->date_fin_experience),
																	'size' => 20,
																	'maxlength' => 10,
																	'placeholder' => 'JJ/MM/AAAA',
																)
		); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Mettre à jour'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->