<?php
/* @var $this UtilisateurController */
/* @var $model Utilisateur */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_utilisateur'); ?>
		<?php echo $form->textField($model,'id_utilisateur'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mot_de_passe'); ?>
		<?php echo $form->textField($model,'mot_de_passe',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation_utilisateur'); ?>
		<?php echo $form->textField($model,'date_creation_utilisateur'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_derniere_connexion'); ?>
		<?php echo $form->textField($model,'date_derniere_connexion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telephone2'); ?>
		<?php echo $form->textField($model,'telephone2',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site_web'); ?>
		<?php echo $form->textField($model,'site_web',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_adresse'); ?>
		<?php echo $form->textField($model,'id_adresse'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->