<?php
/* @var $this CompetenceController */
/* @var $model Competence */
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
		<?php echo $form->label($model,'intitule_competence'); ?>
		<?php echo $form->textField($model,'intitule_competence',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'niveau_competence'); ?>
		<?php echo $form->textField($model,'niveau_competence',array('size'=>45,'maxlength'=>45)); ?>
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