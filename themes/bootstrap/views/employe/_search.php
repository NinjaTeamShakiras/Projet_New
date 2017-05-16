<?php
/* @var $this EmployeController */
/* @var $model Employe */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_employe'); ?>
		<?php echo $form->textField($model,'nom_employe',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prenom_employe'); ?>
		<?php echo $form->textField($model,'prenom_employe',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_naissance_employe'); ?>
		<?php echo $form->textField($model,'date_naissance_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employe_travaille'); ?>
		<?php echo $form->textField($model,'employe_travaille'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->