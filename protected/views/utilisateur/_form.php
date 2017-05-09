<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utilisateur-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mot_de_passe'); ?>
		<?php echo $form->textField($model,'mot_de_passe',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_creation_utilisateur'); ?>
		<?php echo $form->textField($model,'date_creation_utilisateur'); ?>
		<?php echo $form->error($model,'date_creation_utilisateur'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_derniere_connexion'); ?>
		<?php echo $form->textField($model,'date_derniere_connexion'); ?>
		<?php echo $form->error($model,'date_derniere_connexion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail'); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
		<?php echo $form->error($model,'id_employe'); ?>
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