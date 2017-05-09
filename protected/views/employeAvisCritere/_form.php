<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employe-avis-critere-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'note_employe_avis'); ?>
		<?php echo $form->textField($model,'note_employe_avis'); ?>
		<?php echo $form->error($model,'note_employe_avis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
		<?php echo $form->error($model,'id_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_critere_notation_employe'); ?>
		<?php echo $form->textField($model,'id_critere_notation_employe'); ?>
		<?php echo $form->error($model,'id_critere_notation_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_avis_employe'); ?>
		<?php echo $form->textField($model,'id_avis_employe'); ?>
		<?php echo $form->error($model,'id_avis_employe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->