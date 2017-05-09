<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_experience'); ?>
		<?php echo $form->textField($model,'id_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_debut_experience'); ?>
		<?php echo $form->textField($model,'date_debut_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_fin_experience'); ?>
		<?php echo $form->textField($model,'date_fin_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'intitule_experience'); ?>
		<?php echo $form->textField($model,'intitule_experience',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entreprise_experience'); ?>
		<?php echo $form->textField($model,'entreprise_experience',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_experience'); ?>
		<?php echo $form->textField($model,'description_experience',array('size'=>60,'maxlength'=>255)); ?>
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