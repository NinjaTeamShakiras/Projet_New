<?php
/* @var $this TravailleController */
/* @var $model Travaille */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_travaille'); ?>
		<?php echo $form->textField($model,'id_travaille'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_debut_contrat'); ?>
		<?php echo $form->textField($model,'date_debut_contrat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_fin_contrat'); ?>
		<?php echo $form->textField($model,'date_fin_contrat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duree_contrat'); ?>
		<?php echo $form->textField($model,'duree_contrat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->