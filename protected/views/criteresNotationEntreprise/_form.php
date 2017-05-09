<?php
/* @var $this CriteresNotationEntrepriseController */
/* @var $model CriteresNotationEntreprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'criteres-notation-entreprise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_critere_entreprise'); ?>
		<?php echo $form->textField($model,'nom_critere_entreprise',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nom_critere_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'critere_note'); ?>
		<?php echo $form->textField($model,'critere_note'); ?>
		<?php echo $form->error($model,'critere_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_critere'); ?>
		<?php echo $form->textField($model,'description_critere',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description_critere'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->