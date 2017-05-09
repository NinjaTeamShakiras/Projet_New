<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $model InfosComplementairesEmploye */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_info_employe'); ?>
		<?php echo $form->textField($model,'id_info_employe'); ?>
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
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->