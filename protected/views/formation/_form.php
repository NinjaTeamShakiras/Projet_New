<?php
/* @var $this FormationController */
/* @var $model Formation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formation-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date_debut_formation'); ?>
		<?php echo $form->textField($model,'date_debut_formation'); ?>
		<?php echo $form->error($model,'date_debut_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_fin_formation'); ?>
		<?php echo $form->textField($model,'date_fin_formation'); ?>
		<?php echo $form->error($model,'date_fin_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intitule_formation'); ?>
		<?php echo $form->textField($model,'intitule_formation',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'intitule_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'etablissement_formation'); ?>
		<?php echo $form->textField($model,'etablissement_formation',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'etablissement_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diplome_formation'); ?>
		<?php echo $form->textField($model,'diplome_formation',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'diplome_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_formation'); ?>
		<?php echo $form->textField($model,'description_formation',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description_formation'); ?>
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