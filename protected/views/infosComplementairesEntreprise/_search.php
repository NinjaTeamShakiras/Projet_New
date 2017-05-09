<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $model InfosComplementairesEntreprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_info_entreprise'); ?>
		<?php echo $form->textField($model,'id_info_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_info'); ?>
		<?php echo $form->textField($model,'description_info',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_info_profil'); ?>
		<?php echo $form->textField($model,'id_info_profil'); ?>
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