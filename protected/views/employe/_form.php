<?php
/* @var $this EmployeController */
/* @var $model Employe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'employe-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_employe'); ?>
		<?php echo $form->textField($model,'nom_employe',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prenom_employe'); ?>
		<?php echo $form->textField($model,'prenom_employe',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'prenom_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_naissance_employe'); ?>
		<?php echo $form->textField($model,'date_naissance_employe'); ?>
		<?php echo $form->error($model,'date_naissance_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employe_travaille'); ?>
		<?php echo $form->textField($model,'employe_travaille'); ?>
		<?php echo $form->error($model,'employe_travaille'); ?>
	</div>
	

	



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Mettre à jour'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->