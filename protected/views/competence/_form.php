<?php
/* @var $this CompetenceController */
/* @var $model Competence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competence-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'intitule_competence'); ?>
		<?php echo $form->textField($model,'intitule_competence',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'intitule_competence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'niveau_competence'); ?>
		<?php echo $form->textField($model,'niveau_competence',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'niveau_competence'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Mettre à jour'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->