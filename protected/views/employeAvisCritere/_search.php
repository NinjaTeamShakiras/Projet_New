<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_employe_avis'); ?>
		<?php echo $form->textField($model,'id_employe_avis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note_employe_avis'); ?>
		<?php echo $form->textField($model,'note_employe_avis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_critere_notation_employe'); ?>
		<?php echo $form->textField($model,'id_critere_notation_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_avis_employe'); ?>
		<?php echo $form->textField($model,'id_avis_employe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->