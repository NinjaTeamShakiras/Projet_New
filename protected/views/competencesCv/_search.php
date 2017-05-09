<?php
/* @var $this CompetencesCvController */
/* @var $model CompetencesCv */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_competence'); ?>
		<?php echo $form->textField($model,'id_competence'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_competence'); ?>
		<?php echo $form->textField($model,'nom_competence',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->