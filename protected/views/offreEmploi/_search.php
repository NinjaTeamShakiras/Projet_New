<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_offre_emploi'); ?>
		<?php echo $form->textField($model,'id_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation_offre_emploi'); ?>
		<?php echo $form->textField($model,'date_creation_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_offre_emploi'); ?>
		<?php echo $form->textField($model,'type_offre_emploi',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'salaire_offre_emploi'); ?>
		<?php echo $form->textField($model,'salaire_offre_emploi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'experience_offre_emploi'); ?>
		<?php echo $form->textField($model,'experience_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_offre_emploi'); ?>
		<?php echo $form->textField($model,'description_offre_emploi',array('size'=>60,'maxlength'=>500)); ?>
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