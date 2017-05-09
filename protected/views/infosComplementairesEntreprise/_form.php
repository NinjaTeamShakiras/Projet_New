<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $model InfosComplementairesEntreprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'infos-complementaires-entreprise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description_info'); ?>
		<?php echo $form->textField($model,'description_info',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'description_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_info_profil'); ?>
		<?php echo $form->textField($model,'id_info_profil'); ?>
		<?php echo $form->error($model,'id_info_profil'); ?>
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