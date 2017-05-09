<?php
/* @var $this EntrepriseController */
/* @var $model Entreprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entreprise-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note"><span class="required">*</span> Champs à remplir obligatoirement.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom_entreprise'); ?>
		<?php echo $form->textField($model,'nom_entreprise',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nom_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recherche_employes'); ?>
		<?php echo $form->textField($model,'recherche_employes'); ?>
		<?php echo $form->error($model,'recherche_employes'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'telephone_entreprise'); ?>
		<?php echo $form->textField($model,'telephone_entreprise',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'telephone_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_adresse'); ?>
		<?php echo $form->textField($model,'id_adresse'); ?>
		<?php echo $form->error($model,'id_adresse'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->